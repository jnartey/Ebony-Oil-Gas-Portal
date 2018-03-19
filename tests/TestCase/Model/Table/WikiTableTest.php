<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WikiTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WikiTable Test Case
 */
class WikiTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WikiTable
     */
    public $Wiki;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.wiki',
        'app.departments',
        'app.departments_forums',
        'app.departments_members',
        'app.users',
        'app.library_permissions',
        'app.projects_members',
        'app.projects',
        'app.workgroups_members',
        'app.documents',
        'app.media',
        'app.threads',
        'app.posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Wiki') ? [] : ['className' => 'App\Model\Table\WikiTable'];
        $this->Wiki = TableRegistry::get('Wiki', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wiki);

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
