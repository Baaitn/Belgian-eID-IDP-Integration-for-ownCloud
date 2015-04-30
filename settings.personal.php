<?php
/* everything to connect eID identities to an owncloud account */
//require 'templates/openid.php';
//$openid = new LightOpenID($_SERVER['SERVER_NAME']); /* domain */
//if (!$openid->mode) { 
//    if (isset($_POST['submit'])) { /* redirect to the idp after submitting the form */
//        $openid->identity = OCP\Config::getAppValue('beididp', 'idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'); /* eindpoint */
//        /** use one of these as endpoint for $openid->identity to use eID with or without pincode
//         * https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident
//         * https://www.e-contract.be/eid-idp/endpoints/openid/auth
//         * https://www.e-contract.be/eid-idp/endpoints/openid/ident 
//         */
//        $openid->required = array( /* array of requested attributes */
//            'namePerson',
//            'namePerson/first',
//            'namePerson/last',
//            'contact/postalAddress/home',
//            'contact/postalCode/home',
//            'contact/city/home',
//            'person/gender',
//            'birthDate',
//            'eid/age',
//            'eid/pob',
//            'eid/nationality',
//            'eid/rrn',
//            'eid/card-number',
//            'eid/card-validity/begin',
//            'eid/card-validity/end',
//            'eid/photo',
//            'eid/cert/auth',
//        );
//        header('Location: ' . $openid->authUrl());
//    }
//} else { /* get a user's identities and a add the new one if it's not in identities already, then save the identities and change the password to something based on the eID */
//    $openid->validate();
//    $attributes = $openid->getAttributes();
//    //$encodedPhoto = $attributes['eid/photo'];
//    //$photo = base64url_decode($encodedPhoto);
//    //$_SESSION['photo'] = $photo;
//    //echo '<img src="templates/photo.php"/>';
//    //echo '<br/>';
//    //echo ($openid->__get("identity")); /* debug: show identity */
//    //echo '<pre>' . print_r($openid->getAttributes(), true) . '</pre>'; /* debug: show attributes */
//    $user = OCP\User::getUser(); /* deprecated in 8.0.0, use \OC::$server->getUserSession()->getUser()->getUID() instead */
//    $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'identities', array()));
//    $identity = $openid->__get("identity");
//    //TODO: add check to see if an identity is already linked to another account
//    if (!in_array($identity, $identities)) {
//        $identities[] = $identity; //TODO: provide feedback to user: identity added? duplicate identity? ...
//    }
//    OCP\Config::setUserValue($user, 'beididp', 'identities', json_encode($identities));
//    OC_User::setPassword($user, $attributes['eid/cert/auth'], null); //setPassword($uid, $password, $recoveryPassword);
//}
//function base64url_decode($base64url) {
//    $base64 = strtr($base64url, '-_', '+/');
//    $plainText = base64_decode($base64);
//    return ($plainText);
//}
/*  */
OCP\JSON::checkAppEnabled('beididp');
OCP\User::checkLoggedIn();
script('beididp', 'settings.personal');
$template = new OCP\Template('beididp', 'settings.personal');
return $template->fetchPage();
