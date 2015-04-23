<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

//$l=OC_L10N::get('beididp');
$l = OCP\Util::getL10N('beididp');
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

if(true){ //TODO: add check to see if an eID got succesfully removed
    //OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    //OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    OCP\JSON::success(array('data' => array('message' => $l->t('eID successfully removed') )));
    //OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
} else {
    //OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    //OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    OCP\JSON::error(array('data' => array( 'message' => $l->t('Failed to remove eID') )));
    //OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
}
