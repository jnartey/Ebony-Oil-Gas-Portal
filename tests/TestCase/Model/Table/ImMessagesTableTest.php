<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImMessagesTable Test Case
 */
class ImMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImMessagesTable
     */
    public $ImMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.im_messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ImMessages') ? [] : ['className' => 'App\Model\Table\ImMessagesTable'];
        $this->ImMessages = TableRegistry::get('ImMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ImMessages);

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
}
