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

/**
 * Routing for AJAX calls
 * 
 * NOTE: This is important, without it ajax calls will fail. 
 * You'll get '302 Found' instead of '200 OK' as status and the returned data will not be what you'd expect it to be. 
 */
$this->create('beididp_ajax_add_eid_debug', 'ajax/add.eid.debug.php')->actionInclude('beididp/ajax/add.eid.debug.php');
$this->create('beididp_ajax_remove_eid', 'ajax/remove.eid.php')->actionInclude('beididp/ajax/remove.eid.php');
$this->create('beididp_ajax_settings_admin', 'ajax/settings.admin.php')->actionInclude('beididp/ajax/settings.admin.php');

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Beididp\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
        ['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
    ]
];
