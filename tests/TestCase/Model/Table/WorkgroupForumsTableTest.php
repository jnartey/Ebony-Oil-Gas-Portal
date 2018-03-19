<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkgroupForumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkgroupForumsTable Test Case
 */
class WorkgroupForumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkgroupForumsTable
     */
    public $WorkgroupForums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workgroup_forums',
        'app.workgroups',
        'app.workgroups_members',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.threads',
        'app.wiki',
        'app.library_permissions',
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
        $config = TableRegistry::exists('WorkgroupForums') ? [] : ['className' => WorkgroupForumsTable::class];
        $this->WorkgroupForums = TableRegistry::get('WorkgroupForums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkgroupForums);

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
