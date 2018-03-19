<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CashRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CashRequestsTable Test Case
 */
class CashRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CashRequestsTable
     */
    public $CashRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cash_requests'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CashRequests') ? [] : ['className' => CashRequestsTable::class];
        $this->CashRequests = TableRegistry::get('CashRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CashRequests);

        parent::tearDown();
    }

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
