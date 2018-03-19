<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WikiController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WikiController Test Case
 */
class WikiControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
