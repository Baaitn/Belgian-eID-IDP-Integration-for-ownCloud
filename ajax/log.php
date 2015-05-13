<?php

OCP\JSON::checkAppEnabled('beididp');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$data = filter_input(INPUT_POST, 'data');
OCP\Util::writeLog('beididp',$data, OCP\Util::INFO);
OCP\JSON::success();