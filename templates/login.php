<?php /** @var $l OC_L10N */ ?>

<?php
vendor_script('jsTimezoneDetect/jstz');
script('core', ['visitortimezone', 'lostpassword']);
$l10n = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
?>

<?php
require 'openid.php';
$openid = new LightOpenID($_SERVER['SERVER_NAME']); /* domain */
if (!$openid->mode) { 
    if (isset($_POST['redirect'])) { /* redirect to the idp after submitting the form */
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
    $identity = new stdClass(); /* must be the same as in settings.personal.php */
    $identity->cardnumber = $attributes['eid/card-number'];
    $identity->expiredate = $attributes['eid/card-validity/end'];
    /* get all users and see which identities they have, if a match with the new identity is found, try to log the user in */
    $users = OCP\User::getUsers('', null, null); //getUsers($search, $limit, $offset); /* deprecated in 8.1.0, use method search() of \OCP\IUserManager - \OC::$server->getUserManager() instead */
    foreach ($users as $user) {
        $identities = (array) json_decode(OCP\Config::getUserValue($user, 'beididp', 'identities', null));
        if (in_array($identity, $identities)) {
            OC::$server->getUserSession()->login($user, $attributes['eid/cert/auth']); //TODO: provide feedback to user: match found? password incorrect? ...
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }
    }
}
function base64url_decode($base64url) {
    $base64 = strtr($base64url, '-_', '+/');
    $plainText = base64_decode($base64);
    return ($plainText);
}
?>

<!--[if IE 8]><style>input[type="checkbox"]{padding:0;}</style><![endif]-->
<form method="post" name="login">
    <fieldset>
        <?php
        if (!empty($_['redirect_url'])) {
            print_unescaped('<input type="hidden" name="redirect_url" value="' . OC_Util::sanitizeHTML($_['redirect_url']) . '" />');
        }
        ?>
        <?php if (isset($_['apacheauthfailed']) && ($_['apacheauthfailed'])): ?>
            <div class="warning">
                <?php p($l->t('Server side authentication failed!')); ?><br>
                <small><?php p($l->t('Please contact your administrator.')); ?></small>
            </div>
        <?php endif; ?>
        <?php foreach ($_['messages'] as $message): ?>
            <div class="warning">
                <?php p($message); ?><br>
            </div>
        <?php endforeach; ?>
        <p id="message" class="hidden">
            <img class="float-spinner" alt="" src="<?php p(\OCP\Util::imagePath('core', 'loading-dark.gif')); ?>" />
            <span id="messageText"></span>
            <!-- the following div ensures that the spinner is always inside the #message div -->
            <div style="clear: both;"></div>
        </p>
        <?php if (OCP\Config::getAppValue('beididp', 'hide', 'false') === 'false'): ?>
            <p class="grouptop">
                <input type="text" name="user" id="user" placeholder="<?php p($l->t('Username')); ?>" value="<?php p($_['username']); ?>" <?php p($_['user_autofocus'] ? 'autofocus' : ''); ?> autocomplete="on" autocapitalize="off" autocorrect="off" /> <!--required-->
                <label for="user" class="infield"><?php p($l->t('Username')); ?></label>
                <img class="svg" src="<?php print_unescaped(image_path('', 'actions/user.svg')); ?>" alt=""/>
            </p>
            <p class="groupbottom">
                <input type="password" name="password" id="password" value="" placeholder="<?php p($l->t('Password')); ?>" <?php p($_['user_autofocus'] ? '' : 'autofocus'); ?> autocomplete="on" autocapitalize="off" autocorrect="off" /> <!--required-->
                <label for="password" class="infield"><?php p($l->t('Password')); ?></label>
                <img class="svg" id="password-icon" src="<?php print_unescaped(image_path('', 'actions/password.svg')); ?>" alt=""/>
            </p>
            <?php if (isset($_['invalidpassword']) && ($_['invalidpassword'])): ?>
                <a id="lost-password" class="warning" href=""><?php p($l->t('Forgot your password? Reset it!')); ?></a>
            <?php endif; ?>
            <?php if ($_['rememberLoginAllowed'] === true): ?>
                <input type="checkbox" name="remember_login" value="1" id="remember_login" />
                <label for="remember_login"><?php p($l->t('remember')); ?></label>
            <?php endif; ?>
            <input id="submit" type="submit" value="<?php p($l10n->t('Log in')); ?>" class="login primary" disabled="disabled"/>
        <?php endif; ?>
        <input id="submit" name="redirect" type="submit" value="<?php p($l10n->t('Log in using eID')); ?>" class="login primary" disabled="disabled"/>
        <input type="hidden" name="timezone-offset" id="timezone-offset"/>
        <input type="hidden" name="timezone" id="timezone"/>
        <input type="hidden" name="requesttoken" value="<?php p($_['requesttoken']) ?>" />
    </fieldset>
</form>
<?php if (!empty($_['alt_login'])) { ?>
    <form id="alternative-logins">
        <fieldset>
            <legend><?php p($l->t('Alternative Logins')) ?></legend>
            <ul>
            <?php foreach ($_['alt_login'] as $login): ?>
                <li><a class="button" href="<?php print_unescaped($login['href']); ?>" ><?php p($login['name']); ?></a></li>
            <?php endforeach; ?>
            </ul>
        </fieldset>
    </form>
<?php
}
