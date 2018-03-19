<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestFormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestFormsTable Test Case
 */
class RequestFormsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestFormsTable
     */
    public $RequestForms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_forms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestForms') ? [] : ['className' => RequestFormsTable::class];
        $this->RequestForms = TableRegistry::get('RequestForms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestForms);

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
