<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentCommentsTable Test Case
 */
class DepartmentCommentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentCommentsTable
     */
    public $DepartmentComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.department_comments',
        'app.sources',
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
        'app.comments',
        'app.forums'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DepartmentComments') ? [] : ['className' => DepartmentCommentsTable::class];
        $this->DepartmentComments = TableRegistry::get('DepartmentComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentComments);

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
