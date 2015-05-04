<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$l = OCP\Util::getL10N('beididp'); //$l = OC::$server->getL10N('beididp'); //$l=OC_L10N::get('beididp');
$me = OCP\User::getUser();
for ($index = 0; $index < 1; $index++) {
    $identity = 'http://xxx.yyy.zzz/' . date("ymd") . '/eid?'. ($index + 1);
    /* check to see if the identity has already been linked to an account */
    $users = OCP\User::getUsers('', null, null);
    foreach ($users as $user) {
        $identities = json_decode(OCP\Config::getUserValue($user, 'beididp', 'identities', array()));
        if (in_array($identity, $identities)) {
            if ($user === $me){
                OCP\JSON::error(array('data' => array('message' => $l->t('%s has already been linked to this account', array($identity)))));
                return;
            } else {
                OCP\JSON::error(array('data' => array('message' => $l->t('%s has already been linked to %s', array($identity, $user)))));
                return;
            }
        }
    }
    /* if that was not the case ... */
    $identities = json_decode(OCP\Config::getUserValue($me, 'beididp', 'identities', array()));
    if (!in_array($identity, $identities)) {
        /* add the identity to my identities */
        $identities[] = $identity;
        /* try to save my identitites and notify the user */
        if (OCP\Config::setUserValue($me, 'beididp', 'identities', json_encode($identities))) {
            OCP\JSON::success(array('data' => array('message' => $l->t('eID added'))));
            return;
        } else {
            OCP\JSON::error(array('data' => array('message' => $l->t('Could not add eID'))));
            return;
        }
    }
}

//OCP\Util::writeLog('beididp','Success', OCP\Util::INFO);
//OCP\Util::writeLog('beididp','Error', OCP\Util::ERROR);
//OCP\JSON::success(array('data' => array( 'message' => $l->t('Success') )));
//OCP\JSON::error(array('data' => array( 'message' => $l->t('Error') )));
//OC_JSON::success(array('data' => array( 'message' => $l->t('Success') )));
//OC_JSON::error(array('data' => array( 'message' => $l->t('Error') )));
