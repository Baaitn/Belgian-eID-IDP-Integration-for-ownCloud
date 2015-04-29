<?php //TODO: provide correct feedback to user & sanitize input

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$user= OCP\USER::getUser();
$identities = $_POST['identities'];
OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($identities));

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
