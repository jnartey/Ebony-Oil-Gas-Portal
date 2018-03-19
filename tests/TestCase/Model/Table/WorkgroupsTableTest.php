<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkgroupsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkgroupsTable Test Case
 */
class WorkgroupsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkgroupsTable
     */
    public $Workgroups;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workgroups',
        'app.workgroups_members'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Workgroups') ? [] : ['className' => 'App\Model\Table\WorkgroupsTable'];
        $this->Workgroups = TableRegistry::get('Workgroups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Workgroups);

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
