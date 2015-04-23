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

namespace OCA\Beididp\Controller;

use \OCP\IRequest;
use \OCP\AppFramework\Http\TemplateResponse;
use \OCP\AppFramework\Http\DataResponse;
use \OCP\AppFramework\Controller;

class PageController extends Controller {

    private $userId;

    public function __construct($AppName, IRequest $request, $UserId) {
        parent::__construct($AppName, $request);
        $this->userId = $UserId;
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * 
     * CAUTION: 
     * the @Stuff turns off security checks; for this page no admin is
     * required and no CSRF check. If you don't know what CSRF is, read
     * it up in the docs or you might create a security hole. This is
     * basically the only required method to add this exemption, don't
     * add it to any other method if you don't exactly know what it does
     */
    public function index() {
        $params = ['user' => $this->userId];
        return new TemplateResponse('beididp', 'main', $params);  // templates/main.php
    }

    /**
     * @NoAdminRequired
     * Simple method that posts back the payload of the request
     */
    public function doEcho($echo) {
        return new DataResponse(['echo' => $echo]);
    }

}
