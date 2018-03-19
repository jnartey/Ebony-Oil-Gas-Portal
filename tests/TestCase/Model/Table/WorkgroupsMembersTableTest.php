<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkgroupsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkgroupsMembersTable Test Case
 */
class WorkgroupsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkgroupsMembersTable
     */
    public $WorkgroupsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workgroups_members',
        'app.workgroups',
        'app.users',
        'app.departments_members',
        'app.departments',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.threads',
        'app.posts',
        'app.wiki',
        'app.library_permissions',
        'app.projects_members',
        'app.projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WorkgroupsMembers') ? [] : ['className' => 'App\Model\Table\WorkgroupsMembersTable'];
        $this->WorkgroupsMembers = TableRegistry::get('WorkgroupsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WorkgroupsMembers);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
