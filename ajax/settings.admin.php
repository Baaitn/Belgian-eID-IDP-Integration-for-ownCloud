<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
if(OCP\Config::setAppValue('beididp', 'idp_url', filter_input(INPUT_POST, 'url')) && OCP\Config::setAppValue('beididp', 'no_mail_verify', filter_input(INPUT_POST, 'mail')) && OCP\Config::setAppValue('beididp', 'https_required', filter_input(INPUT_POST, 'https')) && OCP\Config::setAppValue('beididp', 'hash_claimed_id', filter_input(INPUT_POST, 'hash')) && OCP\Config::setAppValue('beididp', 'only_eid', filter_input(INPUT_POST, 'hide')) ){
    OCP\JSON::success(array('data' => array('message' => $l->t('Settings saved') )));
} else {
    OCP\JSON::error(array('data' => array( 'message' => $l->t('Could not save settings') )));
}
