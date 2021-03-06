<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveRequestsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveRequestsTable Test Case
 */
class LeaveRequestsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveRequestsTable
     */
    public $LeaveRequests;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leave_requests',
        'app.users',
        'app.roles',
        'app.departments',
        'app.departments_forums',
        'app.departments_members',
        'app.documents',
        'app.media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.workgroups',
        'app.workgroups_members',
        'app.threads',
        'app.posts',
        'app.wiki',
        'app.library_permissions',
        'app.events',
        'app.news',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LeaveRequests') ? [] : ['className' => LeaveRequestsTable::class];
        $this->LeaveRequests = TableRegistry::get('LeaveRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveRequests);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
