<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$url = filter_input(INPUT_POST, 'url');
$mail = filter_input(INPUT_POST, 'mail');
$https = filter_input(INPUT_POST, 'https');
$hash = filter_input(INPUT_POST, 'hash');
$hide = filter_input(INPUT_POST, 'hide');

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
if(OCP\Config::setAppValue('beididp', 'idp_url', $url) && OCP\Config::setAppValue('beididp', 'no_mail_verify', $mail) && OCP\Config::setAppValue('beididp', 'https_required', $https) && OCP\Config::setAppValue('beididp', 'hash_claimed_id', $hash) && OCP\Config::setAppValue('beididp', 'only_eid', $hide)) {
    OCP\JSON::success(array('data' => array('message' => $l->t('Settings saved'))));
} else {
    OCP\JSON::error(array('data' => array('message' => $l->t('Could not save settings'))));
}
