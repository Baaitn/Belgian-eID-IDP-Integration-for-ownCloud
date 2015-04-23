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

use PHPUnit_Framework_TestCase;
use OCP\AppFramework\Http\TemplateResponse;

class PageControllerTest extends PHPUnit_Framework_TestCase {

    private $controller;
    private $userId = 'john';

    public function setUp() {
        $request = $this->getMockBuilder('OCP\IRequest')->getMock();

        $this->controller = new PageController(
                'beididp', $request, $this->userId
        );
    }

    public function testIndex() {
        $result = $this->controller->index();

        $this->assertEquals(['user' => 'john'], $result->getParams());
        $this->assertEquals('main', $result->getTemplateName());
        $this->assertTrue($result instanceof TemplateResponse);
    }

    public function testEcho() {
        $result = $this->controller->doEcho('hi');
        $this->assertEquals(['echo' => 'hi'], $result->getData());
    }

}
