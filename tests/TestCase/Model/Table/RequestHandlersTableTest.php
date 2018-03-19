<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RequestHandlersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RequestHandlersTable Test Case
 */
class RequestHandlersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RequestHandlersTable
     */
    public $RequestHandlers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_handlers',
        'app.request_forms',
        'app.departments',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.users_log',
        'app.department_forums',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.workgroups',
        'app.workgroups_members',
        'app.forums',
        'app.events',
        'app.events_members',
        'app.news',
        'app.categories',
        'app.workgroup_forums',
        'app.department_media',
        'app.workgroup_media',
        'app.department_wiki'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RequestHandlers') ? [] : ['className' => RequestHandlersTable::class];
        $this->RequestHandlers = TableRegistry::get('RequestHandlers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RequestHandlers);

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
