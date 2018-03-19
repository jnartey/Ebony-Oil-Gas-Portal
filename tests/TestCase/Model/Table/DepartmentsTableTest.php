<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsTable Test Case
 */
class DepartmentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsTable
     */
    public $Departments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departments',
        'app.departments_forums',
        'app.departments_members',
        'app.users',
        'app.roles',
        'app.library_permissions',
        'app.projects_members',
        'app.projects',
        'app.workgroups_members',
        'app.workgroups',
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
        $config = TableRegistry::exists('Departments') ? [] : ['className' => 'App\Model\Table\DepartmentsTable'];
        $this->Departments = TableRegistry::get('Departments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Departments);

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
}
