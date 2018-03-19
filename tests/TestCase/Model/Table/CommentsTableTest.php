<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsTable Test Case
 */
class CommentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsTable
     */
    public $Comments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comments',
        'app.projects',
        'app.projects_members',
        'app.users',
        'app.roles',
        'app.departments',
        'app.departments_forums',
        'app.departments_members',
        'app.documents',
        'app.media',
        'app.threads',
        'app.posts',
        'app.wiki',
        'app.library_permissions',
        'app.workgroups',
        'app.workgroups_members',
        'app.events',
        'app.news',
        'app.categories',
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
        $config = TableRegistry::exists('Comments') ? [] : ['className' => CommentsTable::class];
        $this->Comments = TableRegistry::get('Comments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comments);

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
