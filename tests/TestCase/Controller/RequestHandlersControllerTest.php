<?php
namespace App\Test\TestCase\Controller;

use App\Controller\RequestHandlersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\RequestHandlersController Test Case
 */
class RequestHandlersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.request_handlers',
        'app.request_forms',
        'app.departments',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.users_log',
        'app.department_forums',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.workgroups',
        'app.workgroups_members',
        'app.forums',
        'app.events',
        'app.events_members',
        'app.news',
        'app.categories',
        'app.workgroup_forums',
        'app.department_media',
        'app.workgroup_media',
        'app.department_wiki'
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
