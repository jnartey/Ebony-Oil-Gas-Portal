<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentMessagesTable Test Case
 */
class DepartmentMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentMessagesTable
     */
    public $DepartmentMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.department_messages',
        'app.departments',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments_forums',
        'app.library_permissions',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.workgroups',
        'app.workgroups_members',
        'app.events',
        'app.events_members',
        'app.news',
        'app.categories',
        'app.documents',
        'app.media',
        'app.threads',
        'app.wiki'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DepartmentMessages') ? [] : ['className' => DepartmentMessagesTable::class];
        $this->DepartmentMessages = TableRegistry::get('DepartmentMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentMessages);

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
