<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkgroupEventsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkgroupEventsTable Test Case
 */
class WorkgroupEventsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkgroupEventsTable
     */
    public $WorkgroupEvents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workgroup_events',
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
        'app.events',
        'app.events_members',
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
        $config = TableRegistry::exists('WorkgroupEvents') ? [] : ['className' => WorkgroupEventsTable::class];
        $this->WorkgroupEvents = TableRegistry::get('WorkgroupEvents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkgroupEvents);

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
