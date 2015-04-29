<?php //TODO: provide correct feedback to user & sanitize input

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$url = $_POST['url'];
$mail = $_POST['mail'];
$https = $_POST['https'];
$hash = $_POST['hash'];
OCP\Config::setAppValue('beididp', 'beididp_idp_url', $url);
OCP\Config::setAppValue('beididp', 'beididp_no_mail_verify', $mail);
OCP\Config::setAppValue('beididp', 'beididp_https_required', $https);
OCP\Config::setAppValue('beididp', 'beididp_hash_claimed_id', $hash);

if(true){
    //OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    //OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
    OCP\JSON::success(array('data' => array('message' => $l->t('Settings saved') )));
    //OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
} else {
    //OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    //OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
    OCP\JSON::error(array('data' => array( 'message' => $l->t('Could not save settings') )));
    //OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
}
