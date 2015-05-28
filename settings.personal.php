<?php
/*  */
OCP\App::checkAppEnabled('beididp');
OCP\User::checkLoggedIn();
script('beididp', 'settings.personal');
style('beididp', 'settings.personal');
$template = new OCP\Template('beididp', 'settings.personal');
return $template->fetchPage();
