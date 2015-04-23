<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$user= \OCP\USER::getUser();
$oldidentities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', null));
$newidentities = array();
$identity = $_POST['identity'];
foreach ($oldidentities as $value) {
    if($identity !== $value){
        $newidentities[] = $value;
    }
}
OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($newidentities));

if(true){
    //OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    //OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    OCP\JSON::success(array('data' => array('message' => 'Success' )));
    //OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
} else {
    //OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    //OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    OCP\JSON::error(array('data' => array( 'message' => 'Error' )));
    //OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
}




//OC_JSON::success(array("data" => array( "message" => t("eIDrm'd") )));

//$l = OC_L10N::get('beididp');
//$identities = $_POST['identities'];
//if(true){
//    $return = $identities;
//    $return["json"] = json_encode($return);
//} else {
//    
//}
//
//


////
