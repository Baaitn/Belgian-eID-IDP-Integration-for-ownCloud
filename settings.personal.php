<?php
/* everything to connect eID identities to an owncloud account */
//session_start();
//require 'openid.php';
//$openid = new LightOpenID($_SERVER['SERVER_NAME']); /* domain goes here */
//if (!$openid->mode) { /* redirect to the idp after clicking on the button */
//    if (isset($_POST['submit'])) {
//        $openid->identity = OCP\Config::getAppValue('beididp', 'beididp_idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'); /* eindpoint goes here */
//        /** use one of these as endpoint for $openid->identity to use eID with or without pincode
//         * https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident
//         * https://www.e-contract.be/eid-idp/endpoints/openid/auth
//         * https://www.e-contract.be/eid-idp/endpoints/openid/ident 
//         */
//        $openid->required = array(
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
//} else { /* get the user and his existing identities (or an empty array if there are none), add the new identiy to the array and save the array */
//    $openid->validate();
////    echo 'Validating ' . ($openid->validate() ? $openid->identity . ' was succesfull ' : 'has failed ') . '!';
////    $attributes = $openid->getAttributes();
////    $encodedPhoto = $attributes['eid/photo'];
////    $photo = base64url_decode($encodedPhoto);
////    $_SESSION['photo'] = $photo;
////    echo '<img src="photo.php"/>';
////    echo '<br/>';
////    echo ($openid->__get("identity")); /* debug: show identity */
////    echo '<pre>' . print_r($openid->getAttributes(), true) . '</pre>'; /* debug: show requested attributes */
//    $user = OCP\User::getUser(); /* deprecated, use \OC::$server->getUserSession()->getUser()->getUID() instead */
//    $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', array()));
//    $identity = $openid->__get("identity");
//    if (!in_array($identity, $identities)) {
//        $identities[] = $identity; //TODO: provide feedback to user: identity added? duplicate identity? ...
//    }
//    OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($identities));
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
