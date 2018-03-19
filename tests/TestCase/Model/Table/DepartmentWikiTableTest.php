<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentWikiTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentWikiTable Test Case
 */
class DepartmentWikiTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentWikiTable
     */
    public $DepartmentWiki;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.department_wiki',
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
        $config = TableRegistry::exists('DepartmentWiki') ? [] : ['className' => DepartmentWikiTable::class];
        $this->DepartmentWiki = TableRegistry::get('DepartmentWiki', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartmentWiki);

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
