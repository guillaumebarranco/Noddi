<?php
namespace App\Test\TestCase\Controller;

use App\Controller\OffersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\OffersController Test Case
 */
class OffersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.offers',
        'app.brands',
        'app.users',
        'app.modeuses',
        'app.activities'
    ];

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test Jsonification method
     *
     * @return void
     */
    public function testJsonification()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
