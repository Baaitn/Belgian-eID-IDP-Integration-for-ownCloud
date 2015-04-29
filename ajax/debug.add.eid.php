<?php //TODO: provide correct feedback to user & sanitize input

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$user= OCP\USER::getUser();
$identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'test', array()));
for ($index = 0; $index < 1; $index++) {
    $identity = 'http://xxx.yyy.zzz/eid?' . date("ymd") . 'X' . sprintf("%02d", count($identities)) . 'X'. sprintf("%02d", $index);
    if(!in_array($identity, $identities)){
        $identities[] = $identity;
    }
}
OCP\Config::setUserValue($user, 'beididp', 'test', json_encode($identities));

if(true){
    //OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    //OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    OCP\JSON::success(array('data' => array('message' => $l->t('eID added') )));
    //OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
} else {
    //OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    //OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    OCP\JSON::error(array('data' => array( 'message' => $l->t('Could not add eID') )));
    //OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
}
