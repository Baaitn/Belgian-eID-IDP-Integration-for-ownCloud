<?php
/**
 * ownCloud - Belgian eID IDP Integration
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */

namespace OCA\Beididp\AppInfo;

if (!\OCP\User::isLoggedIn()){
    \OCP\Util::addScript('beididp', 'login');
//    \OCP\Util::addStyle('beididp', 'login');
}

\OCP\App::registerAdmin('beididp', 'settings.admin');
\OCP\App::registerPersonal('beididp', 'settings.personal');
\OCP\App::addNavigationEntry([
	// the string under which your app will be referenced in owncloud
	'id' => 'beididp',
	// sorting weight for the navigation. The higher the number, the higher will it be listed in the navigation
	'order' => 10,
	// the route that will be shown on startup
	'href' => \OCP\Util::linkToRoute('beididp.page.index'),
	// the icon that will be shown in the navigation this file needs to exist in img/
	'icon' => \OCP\Util::imagePath('beididp', 'app.svg'),
	// the title of your application. This will be used in the navigation or on the settings page of your app
	'name' => \OC_L10N::get('beididp')->t('Belgian eID IDP Integration')
]);
