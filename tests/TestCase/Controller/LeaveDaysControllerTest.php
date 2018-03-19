<?php
namespace App\Test\TestCase\Controller;

use App\Controller\LeaveDaysController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\LeaveDaysController Test Case
 */
class LeaveDaysControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leave_days',
        'app.users',
        'app.roles',
        'app.departments_members',
        'app.departments',
        'app.users_log',
        'app.department_forums',
        'app.workgroup_forums',
        'app.workgroups',
        'app.workgroups_members',
        'app.forums',
        'app.department_media',
        'app.workgroup_media',
        'app.projects',
        'app.projects_members',
        'app.tasks',
        'app.comments',
        'app.department_wiki',
        'app.events',
        'app.events_members',
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
