<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DepartmentsMembersController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\DepartmentsMembersController Test Case
 */
class DepartmentsMembersControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departments_members',
        'app.departments',
        'app.users',
        'app.roles',
        'app.library_permissions',
        'app.projects',
        'app.projects_members',
        'app.workgroups',
        'app.workgroups_members',
        'app.departments_forums',
        'app.documents',
        'app.media',
        'app.threads',
        'app.posts',
        'app.wiki'
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
