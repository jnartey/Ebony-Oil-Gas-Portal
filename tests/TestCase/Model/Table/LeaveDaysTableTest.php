<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeaveDaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeaveDaysTable Test Case
 */
class LeaveDaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeaveDaysTable
     */
    public $LeaveDays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leave_days',
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
        $config = TableRegistry::exists('LeaveDays') ? [] : ['className' => LeaveDaysTable::class];
        $this->LeaveDays = TableRegistry::get('LeaveDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LeaveDays);

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
