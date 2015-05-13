<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$cardnumber = filter_input(INPUT_POST, 'cardnumber');

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$me = OCP\User::getUser();
$oldidentities = json_decode(OCP\Config::getUserValue($me, 'beididp', 'identities', null));
foreach ($oldidentities as $identity) {
    if($cardnumber !== $identity->cardnumber){
        $newidentities[] = $identity;
    }
}
if(OCP\Config::setUserValue($me, 'beididp', 'identities', json_encode($newidentities))) {
    OCP\Util::writeLog('beididp', $me . ' removed an identity.', OCP\Util::INFO);
    OCP\JSON::success(array('data' => array('message' => $l->t('eID removed'))));
} else {
    OCP\JSON::error(array('data' => array('message' => $l->t('Could not remove eID'))));
}