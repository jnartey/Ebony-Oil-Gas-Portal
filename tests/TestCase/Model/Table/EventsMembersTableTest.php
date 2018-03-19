<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EventsMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EventsMembersTable Test Case
 */
class EventsMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EventsMembersTable
     */
    public $EventsMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.events_members',
        'app.events',
        'app.users',
        'app.roles',
        'app.departments',
        'app.departments_forums',
        'app.departments_members',
        'app.documents',
        'app.media',
        'app.projects',
        'app.projects_members',
        'app.threads',
        'app.posts',
        'app.wiki',
        'app.library_permissions',
        'app.workgroups',
        'app.workgroups_members',
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
        $config = TableRegistry::exists('EventsMembers') ? [] : ['className' => EventsMembersTable::class];
        $this->EventsMembers = TableRegistry::get('EventsMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EventsMembers);

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
