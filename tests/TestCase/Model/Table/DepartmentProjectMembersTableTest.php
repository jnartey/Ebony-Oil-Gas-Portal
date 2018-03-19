<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentProjectMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentProjectMembersTable Test Case
 */
class DepartmentProjectMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentProjectMembersTable
     */
    public $DepartmentProjectMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.department_project_members',
        'app.projects',
        'app.projects_members',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.threads',
        'app.wiki',
        'app.library_permissions',
        'app.workgroups',
        'app.workgroups_members',
        'app.events',
        'app.events_members',
        'app.news',
        'app.categories',
        'app.tasks',
        'app.comments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DepartmentProjectMembers') ? [] : ['className' => DepartmentProjectMembersTable::class];
        $this->DepartmentProjectMembers = TableRegistry::get('DepartmentProjectMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentProjectMembers);

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
