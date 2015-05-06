<?php
/*  */
OCP\JSON::checkAppEnabled('beididp');
OCP\User::checkAdminUser();
script('beididp', 'settings.admin');
$template = new OCP\Template('beididp', 'settings.admin');
$template->assign('beididp_idp_url', OCP\Config::getAppValue('beididp', 'idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'));
//$template->assign('beididp_no_mail_verify', OCP\Config::getAppValue('beididp', 'no_mail_verify', 'true'));
//$template->assign('beididp_https_required', OCP\Config::getAppValue('beididp', 'https_required', 'true'));
//$template->assign('beididp_hash_claimed_id', OCP\Config::getAppValue('beididp', 'hash_claimed_id', 'true'));
$template->assign('beididp_only_eid', OCP\Config::getAppValue('beididp', 'only_eid', 'false'));
return $template->fetchPage();
