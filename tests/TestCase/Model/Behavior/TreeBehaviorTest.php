<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\TreeBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\TreeBehavior Test Case
 */
class TreeBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\TreeBehavior
     */
    public $Tree;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Tree = new TreeBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tree);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
