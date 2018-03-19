<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkOutsideSchedulesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkOutsideSchedulesTable Test Case
 */
class WorkOutsideSchedulesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkOutsideSchedulesTable
     */
    public $WorkOutsideSchedules;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.work_outside_schedules',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.users_log',
        'app.department_forums',
        'app.workgroup_forums',
        'app.workgroups',
        'app.workgroups_members',
        'app.forums',
        'app.department_media',
        'app.workgroup_media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.department_wiki',
        'app.events',
        'app.events_members',
        'app.news',
        'app.categories',
        'app.request_handlers',
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
        $config = TableRegistry::exists('WorkOutsideSchedules') ? [] : ['className' => WorkOutsideSchedulesTable::class];
        $this->WorkOutsideSchedules = TableRegistry::get('WorkOutsideSchedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkOutsideSchedules);

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
