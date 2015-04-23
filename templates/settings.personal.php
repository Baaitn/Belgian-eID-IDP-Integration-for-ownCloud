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
    <?php
    session_start();
    require 'openid.php';
    $openid = new LightOpenID($_SERVER['SERVER_NAME']); /* domain goes here */
    if (!$openid->mode) {
        if (isset($_POST['submit'])) {
            $openid->identity = OCP\Config::getAppValue('beididp', 'beididp_idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'); /* eindpoint goes here */
            /** use one of these as endpoint for $openid->identity to use eID with or without pincode
             * https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident
             * https://www.e-contract.be/eid-idp/endpoints/openid/auth
             * https://www.e-contract.be/eid-idp/endpoints/openid/ident 
             */
            $openid->required = array(
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
        //else {
        //    /* debug: add identiti without having to submit */
        //    $identities = array();
        //    $identities = json_decode(OCP\Config::getUserValue(OCP\User::getUser(), 'beididp', 'test', null));
        //    for ($index = 0; $index < 10; $index++) {
        //        $identities[] = "http://xxx.yyy.zzz/eid?" . $index;
        //    }
        //    OCP\Config::setUserValue(OCP\User::getUser(), 'beididp', 'test', json_encode($identities));
        //}
    } else {
        $openid->validate();
        
        //$attributes = $openid->getAttributes();
        //$encodedPhoto = $attributes['eid/photo'];
        //$photo = base64url_decode($encodedPhoto);
        //$_SESSION['photo'] = $photo;
        //echo '<img src="photo.php"/>';
        //echo '<br/>';
        //echo ($openid->__get("identity")); /* debug: show identity */
        //echo '<pre>' . print_r($openid->getAttributes(), true) . '</pre>'; /* debug: show requested attributes */
        
        /* get the user and his identities or an empty array, add the identiy to the array, save the array */
        $user = OCP\User::getUser(); /* deprecated, use \OC::$server->getUserSession()->getUser()->getUID() instead */
        $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', null));
        $identities[] = $openid->__get("identity");
        OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($identities));
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
                <th><?php p($l->t('BeID Identity')); ?></th>
                <th><?php p($l->t('Operations')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            /* get the user and his identities, display each identity in a table */
            $user = OCP\User::getUser();
            $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', null));
            
            //$identities = array("eID #1", "eID #2");
            //$identities = \OCA\beididp\beididp::getIdentities();
            //for ($i = 0; $i < sizeof($identities); $i++) {
            //    print_unescaped('<tr style="overflow:hidden; white-space:nowrap;">');
            //    print_unescaped('<td>' . $identities[$i] . '</a></td>');
            //    print_unescaped('<td class="remove"><img alt=' . p($l->t('Delete')) . ' title=' . p($l->t('Delete')) . ' class="svg action" src=' . image_path('core', 'actions/delete.svg') . '/></td>');
            //    print_unescaped('</tr>');
            //}
            
            foreach ($identities as $identity):?>
                <tr style="overflow:hidden; white-space:nowrap;">
                    <td><?php p($identity) ?></td>
                    <td class="remove"><img alt="<?php p($l->t('Delete')); ?>" title="<?php p($l->t('Delete')); ?>"class="svg action"src="<?php print_unescaped(image_path('core', 'actions/delete.svg')); ?>"/></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <form id="form" method="post" action="">
        <input type="submit" name="submit" value="<?php p($l->t('Add a BeID identity')); ?>" id="submit"></input>
        <span class="msg" id="output"></span>
    </form>
</div>
