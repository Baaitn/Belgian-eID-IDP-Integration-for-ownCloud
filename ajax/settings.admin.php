<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$url = filter_input(INPUT_POST, 'url');
$hide = filter_input(INPUT_POST, 'hide');

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
if(OCP\Config::setAppValue('beididp', 'url', $url) && OCP\Config::setAppValue('beididp', 'hide', $hide)) {
    OCP\JSON::success(array('data' => array('message' => $l->t('Settings saved'))));
} else {
    OCP\JSON::error(array('data' => array('message' => $l->t('Could not save settings'))));
}
