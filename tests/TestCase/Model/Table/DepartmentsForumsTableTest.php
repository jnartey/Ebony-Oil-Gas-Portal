<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsForumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsForumsTable Test Case
 */
class DepartmentsForumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsForumsTable
     */
    public $DepartmentsForums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departments_forums',
        'app.departments',
        'app.users',
        'app.roles',
        'app.departments_members',
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
        $config = TableRegistry::exists('DepartmentsForums') ? [] : ['className' => 'App\Model\Table\DepartmentsForumsTable'];
        $this->DepartmentsForums = TableRegistry::get('DepartmentsForums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentsForums);

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
