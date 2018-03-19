<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectsMembersTable Test Case
 */
class ProjectsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectsMembersTable
     */
    public $ProjectsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projects_members',
        'app.projects',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProjectsMembers') ? [] : ['className' => 'App\Model\Table\ProjectsMembersTable'];
        $this->ProjectsMembers = TableRegistry::get('ProjectsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProjectsMembers);

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
