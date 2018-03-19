<?php
namespace App\Test\TestCase\Controller;

use App\Controller\EventsMembersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\EventsMembersController Test Case
 */
class EventsMembersControllerTest extends IntegrationTestCase
{

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
