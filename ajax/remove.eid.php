<?php //TODO: provide correct feedback to user & sanitize input

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$identity = $_POST['identity'];

$l = OCP\Util::getL10N('beididp'); //$l=OC_L10N::get('beididp'); //$l = \OC::$server->getL10N('settings');
$user= OCP\USER::getUser();
$oldidentities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', array()));
$newidentities = array();
foreach ($oldidentities as $value) {
    if($identity !== $value){
        $newidentities[] = $value;
    }
}
OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($newidentities));

if(true){
    //OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    //OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    OCP\JSON::success(array('data' => array('message' => $l->t('eID removed') )));
    //OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
} else {
    //OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    //OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    OCP\JSON::error(array('data' => array( 'message' => $l->t('Could not remove eID') )));
    //OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
}
