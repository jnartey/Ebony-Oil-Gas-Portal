<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkgroupEventMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkgroupEventMembersTable Test Case
 */
class WorkgroupEventMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkgroupEventMembersTable
     */
    public $WorkgroupEventMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workgroup_event_members',
        'app.events',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.workgroups',
        'app.workgroups_members',
        'app.threads',
        'app.wiki',
        'app.library_permissions',
        'app.news',
        'app.categories',
        'app.events_members'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WorkgroupEventMembers') ? [] : ['className' => WorkgroupEventMembersTable::class];
        $this->WorkgroupEventMembers = TableRegistry::get('WorkgroupEventMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkgroupEventMembers);

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
