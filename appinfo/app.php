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

\OC::$CLASSPATH['hooks'] = 'beididp/lib/hooks.php';
\OCP\Util::connectHook('OC_User', 'pre_login', 'hooks', 'pre_login');
\OCP\Util::connectHook('OC_User', 'post_login', 'hooks', 'post_login');
\OCP\Util::connectHook('OC_User', 'logout', 'hooks', 'logout');
\OCP\Util::connectHook('OC_Filesystem', 'touch', 'hooks', 'touch');
\OCP\Util::connectHook('OC_Filesystem', 'post_touch', 'hooks', 'post_touch');
\OCP\Util::connectHook('OC_Filesystem', 'create', 'hooks', 'create');
\OCP\Util::connectHook('OC_Filesystem', 'post_create', 'hooks', 'post_create');
\OCP\Util::connectHook('OC_Filesystem', 'read', 'hooks', 'read');
\OCP\Util::connectHook('OC_Filesystem', 'write', 'hooks', 'write');
\OCP\Util::connectHook('OC_Filesystem', 'post_write', 'hooks', 'post_write');
\OCP\Util::connectHook('OC_Filesystem', 'delete', 'hooks', 'delete');
\OCP\Util::connectHook('OC_Filesystem', 'post_delete', 'hooks', 'post_delete');
\OCP\Util::connectHook('OC_Filesystem', 'rename', 'hooks', 'rename');
\OCP\Util::connectHook('OC_Filesystem', 'post_rename', 'hooks', 'post_rename');
\OCP\Util::connectHook('OC_Filesystem', 'copy', 'hooks', 'copy');
\OCP\Util::connectHook('OC_Filesystem', 'post_copy', 'hooks', 'post_copy');
\OCP\Util::connectHook('OCP\Share', 'post_shared', 'hooks', 'post_share');
\OCP\Util::connectHook('OCP\Share', 'post_unshare', 'hooks', 'post_unshare');

\OCP\Util::connectHook('OC_Filesystem', 'update', 'hooks', 'test');

//string	$signalClass	class name of emitter
//string	$signalName	name of signal
//string	$slotClass	class name of slot
//string	$slotName	name of slot, in another word, this is the name of the method that will be called when registered signal is emitted. 

if (!\OCP\User::isLoggedIn()){
    \OCP\Util::addScript('beididp', 'login');
    \OCP\Util::addStyle('beididp', 'login');
}

\OCP\Util::addScript('beididp', 'log');
\OCP\Util::addStyle('beididp', 'log');

\OCP\App::registerAdmin('beididp', 'settings.admin');
\OCP\App::registerPersonal('beididp', 'settings.personal');
//\OCP\App::addNavigationEntry([
//	// the string under which your app will be referenced in owncloud
//	'id' => 'beididp',
//	// sorting weight for the navigation. The higher the number, the higher will it be listed in the navigation
//	'order' => 10,
//	// the route that will be shown on startup
//	'href' => \OCP\Util::linkToRoute('beididp.page.index'),
//	// the icon that will be shown in the navigation this file needs to exist in img/
//	'icon' => \OCP\Util::imagePath('beididp', 'app.svg'),
//	// the title of your application. This will be used in the navigation or on the settings page of your app
//	'name' => \OC_L10N::get('beididp')->t('Belgian eID IDP Integration')
//]);
