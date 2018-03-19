<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersLogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersLogTable Test Case
 */
class UsersLogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersLogTable
     */
    public $UsersLog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_log',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.department_forums',
        'app.workgroup_forums',
        'app.workgroups',
        'app.workgroups_members',
        'app.forums',
        'app.media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.wiki',
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
        $config = TableRegistry::exists('UsersLog') ? [] : ['className' => UsersLogTable::class];
        $this->UsersLog = TableRegistry::get('UsersLog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersLog);

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
