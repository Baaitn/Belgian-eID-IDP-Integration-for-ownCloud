<?php
/*  */
OCP\App::checkAppEnabled('beididp');
OCP\User::checkAdminUser();
script('beididp', 'settings.admin');
style('beididp', 'settings.admin');
$template = new OCP\Template('beididp', 'settings.admin');
$template->assign('beididp_url', OCP\Config::getAppValue('beididp', 'url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'));
//$template->assign('beididp_mail', OCP\Config::getAppValue('beididp', 'mail', 'true'));
//$template->assign('beididp_https', OCP\Config::getAppValue('beididp', 'https', 'true'));
//$template->assign('beididp_hash', OCP\Config::getAppValue('beididp', 'hash', 'true'));
$template->assign('beididp_hide', OCP\Config::getAppValue('beididp', 'hide', 'false'));
return $template->fetchPage();
