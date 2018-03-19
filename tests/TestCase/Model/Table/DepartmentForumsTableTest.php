<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentForumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentForumsTable Test Case
 */
class DepartmentForumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentForumsTable
     */
    public $DepartmentForums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.department_forums',
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
        $config = TableRegistry::exists('DepartmentForums') ? [] : ['className' => DepartmentForumsTable::class];
        $this->DepartmentForums = TableRegistry::get('DepartmentForums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentForums);

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
