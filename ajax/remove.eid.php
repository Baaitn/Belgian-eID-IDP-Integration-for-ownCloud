<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$me= OCP\User::getUser();
if(OCP\Config::setUserValue($me, 'beididp', 'identities', json_encode(filter_input(INPUT_POST, 'identities')))){
    OCP\JSON::success(array('data' => array('message' => $l->t('eID removed'))));
    return;
} else {
    OCP\JSON::error(array('data' => array('message' => $l->t('Could not remove eID'))));
    return;
}
