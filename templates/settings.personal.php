<?php
/**
 * ownCloud - Belgian eID IDP Integration
 *
 * This file is licensed under the Affero General Public License version 3 or 
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */
?>

<div class="section">
    <h2><?php p($l->t('Belgian eID Identities')); ?></h2>
    <?php /* everything to connect an eID to an owncloud account */
    $status = $message = ''; /* init $status & $message, prevents 'Undefined variable: * at /templates/settings.personal.php#126' */
    require 'openid.php';
    $openid = new LightOpenID($_SERVER['SERVER_NAME']); /* domain */
    if (!$openid->mode) { 
        if (isset($_POST['submit'])) { /* redirect to the idp after submitting the form */
            $openid->identity = OCP\Config::getAppValue('beididp', 'idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'); /* eindpoint */
            /** use one of these as endpoint for $openid->identity to use eID with or without pincode
             * https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident
             * https://www.e-contract.be/eid-idp/endpoints/openid/auth
             * https://www.e-contract.be/eid-idp/endpoints/openid/ident 
             */
            $openid->required = array( /* array of requested attributes */
                'namePerson',
                'namePerson/first',
                'namePerson/last',
                'contact/postalAddress/home',
                'contact/postalCode/home',
                'contact/city/home',
                'person/gender',
                'birthDate',
                'eid/age',
                'eid/pob',
                'eid/nationality',
                'eid/rrn',
                'eid/card-number',
                'eid/card-validity/begin',
                'eid/card-validity/end',
                'eid/photo',
                'eid/cert/auth',
            );
            header('Location: ' . $openid->authUrl());
        }
    } else {
        $openid->validate();
        $attributes = $openid->getAttributes();
        //$encodedPhoto = $attributes['eid/photo'];
        //$photo = base64url_decode($encodedPhoto);
        //$_SESSION['photo'] = $photo;
        //echo '<img src="photo.php"/>';
        //echo '<br/>';
        //echo ($openid->__get("identity")); /* debug: show identity url */
        //echo '<pre>' . print_r($openid->getAttributes(), true) . '</pre>'; /* debug: show attributes */
        $identity = new stdClass(); /* must be the same as in login.php */
        $identity->cardnumber = $attributes['eid/card-number'];
        $identity->expiredate = $attributes['eid/card-validity/end'];
        $me = OCP\User::getUser(); /* deprecated in 8.0.0, use OC::$server->getUserSession()->getUser()->getUID() instead */
        /* check to see if the identity has already been linked to an account */
        $users = OCP\User::getUsers('', null, null);
        foreach ($users as $user) {
            $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'identities', null));
            if (in_array($identity, $identities)) {
                if ($user === $me){
                    $status = 'error'; $message = $l->t('Identity has already been linked to this account'); $skip = true;
                } else {
                    $status = 'error'; $message = $l->t('Identity has already been linked to %1$s', array($user)); $skip = true;
                }
            }
        }
        /* if that was not the case ... */
        if(!$skip) {
            $identities = json_decode(OCP\Config::getUserValue($me, 'beididp', 'identities', null));
            if (!in_array($identity, $identities)) { 
                /* add the identity to my identities */
                $identities[] = $identity;
                /* save my identitites and notify the user, change my passsword where applicable */
                if (OCP\Config::setUserValue($me, 'beididp', 'identities', json_encode($identities))) {
                    OC_User::setPassword($me, $attributes['eid/cert/auth'], null); //setPassword($uid, $password, $recoveryPassword);
                    OCP\Util::writeLog('beididp', $me . ' added an identity. His password has been changed.', OCP\Util::INFO);
                    $status = 'success'; $message = $l->t('eID added');
                } else {
                    $status = 'error'; $message = $l->t('Could not add eID');
                }
            }
        }
    }
    function base64url_decode($base64url) {
        $base64 = strtr($base64url, '-_', '+/');
        $plainText = base64_decode($base64);
        return ($plainText);
    }
    ?>
    <table id="identities" class="grid activitysettings">
        <thead>
            <tr>
                <th><?php p($l->t('Card number')); ?></th>
                <th><?php p($l->t('Valid until')); ?></th>
                <th><?php p($l->t('Operations')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php /* get a user's identities and display each one in a table */
            $identities = json_decode(OCP\Config::getUserValue(OCP\User::getUser(), 'beididp', 'identities', null));
            //for ($i = 0; $i < sizeof($identities); $i++) {
            //    print_unescaped('<tr style="overflow:hidden; white-space:nowrap;">');
            //    print_unescaped('<td>' . $identities[$i] . '</td>');
            //    print_unescaped('<td class="remove"><img class="svg action" alt=' . p($l->t('Delete')) . ' title=' . p($l->t('Delete')) . ' src=' . image_path('core', 'actions/delete.svg') . '/></td>');
            //    print_unescaped('</tr>');
            //}
            foreach ($identities as $identity):?>
                <tr style="overflow:hidden; white-space:nowrap;">
                    <td><?php p($identity->cardnumber) ?></td>
                    <td><?php p($identity->expiredate) ?></td>
                    <td class="remove"><img class="svg action" alt="<?php p($l->t('Remove')); ?>" title="<?php p($l->t('Remove')); ?>" src="<?php print_unescaped(image_path('core', 'actions/delete.svg')); ?>"/></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <form id="form" method="post">
        <input id="submit" name="submit" type="submit" value="<?php p($l->t('Add')); ?>"></input>
        <span class="msg <?php if ($status == 'success') { print_unescaped('success'); } if ($status == 'error') { print_unescaped('error'); } ?>"><?php p($message); ?></span>
    </form>
</div>
