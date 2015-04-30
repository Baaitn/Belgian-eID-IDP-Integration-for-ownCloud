<?php
/*  */
OCP\JSON::checkAppEnabled('beididp');
OCP\User::checkAdminUser();
script('beididp', 'settings.admin');
$template = new OCP\Template('beididp', 'settings.admin');
$template->assign('beididp_idp_url', OCP\Config::getAppValue('beididp', 'idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'));
$template->assign('beididp_no_mail_verify', OCP\Config::getAppValue('beididp', 'no_mail_verify', TRUE));
$template->assign('beididp_https_required', OCP\Config::getAppValue('beididp', 'https_required', TRUE));
$template->assign('beididp_hash_claimed_id', OCP\Config::getAppValue('beididp', 'hash_claimed_id', TRUE));
//TODO: add ability to hide/display 'login with username & password' button
return $template->fetchPage();
