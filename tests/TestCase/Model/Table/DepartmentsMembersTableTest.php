<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsMembersTable Test Case
 */
class DepartmentsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsMembersTable
     */
    public $DepartmentsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departments_members',
        'app.departments',
        'app.users',
        'app.roles',
        'app.library_permissions',
        'app.projects_members',
        'app.projects',
        'app.workgroups_members',
        'app.workgroups',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.threads',
        'app.posts',
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
        $config = TableRegistry::exists('DepartmentsMembers') ? [] : ['className' => 'App\Model\Table\DepartmentsMembersTable'];
        $this->DepartmentsMembers = TableRegistry::get('DepartmentsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentsMembers);

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
