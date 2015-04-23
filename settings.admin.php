<?php

//Do things when the page is submitted - Obsolete, try to use ajax - Niet nuttig voor implementatie eID op ownCloud (?), wel nuttig om te leren getten en setten van instellingen >> opslaan identity url & deleten ervan zonder eerst url te moeten opvangen (applet :/)
if($_POST) {
    //p('<script type="text/javascript">alert("I am an alert box!");</script>');
    if(isset($_POST['beididp_idp_url'])) {
        p('url ' . $_POST['beididp_idp_url'] . vbcrlf);
        OCP\Config::setAppValue('beididp', 'beididp_idp_url', $_POST['beididp_idp_url']);
    }
    if(isset($_POST['beididp_no_mail_verify']) && $_POST['beididp_no_mail_verify'] == '1') {
        p('mail ' . $_POST['beididp_no_mail_verify'] . vbcrlf);
        OCP\Config::setAppValue('beididp', 'beididp_no_mail_verify', TRUE);
    } else {
        OCP\Config::setAppValue('beididp', 'beididp_no_mail_verify', FALSE);
    }
    if(isset($_POST['beididp_https_required']) && $_POST['beididp_https_required'] == '1') {
        p('https ' . $_POST['beididp_https_required'] . vbcrlf);
        OCP\Config::setAppValue('beididp', 'beididp_https_required', TRUE);
    } else {
        OCP\Config::setAppValue('beididp', 'beididp_https_required', FALSE);
    }
    if(isset($_POST['beididp_hash_claimed_id']) && $_POST['beididp_hash_claimed_id'] == '1') {
        p('hash ' . $_POST['beididp_hash_claimed_id'] . vbcrlf);
        OCP\Config::setAppValue('beididp', 'beididp_hash_claimed_id', TRUE);
    } else {
        OCP\Config::setAppValue('beididp', 'beididp_hash_claimed_id', FALSE);
    }
}

OCP\User::checkAdminUser();
script('beididp', 'settings.admin');
$template = new OCP\Template('beididp', 'settings.admin');
$template->assign('beididp_idp_url', OCP\Config::getAppValue('beididp', 'beididp_idp_url', 'https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident'));
$template->assign('beididp_no_mail_verify', OCP\Config::getAppValue('beididp', 'beididp_no_mail_verify', TRUE));
$template->assign('beididp_https_required', OCP\Config::getAppValue('beididp', 'beididp_https_required', TRUE));
$template->assign('beididp_hash_claimed_id', OCP\Config::getAppValue('beididp', 'beididp_hash_claimed_id', TRUE));
return $template->fetchPage();
