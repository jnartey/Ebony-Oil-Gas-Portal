<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CanteenTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CanteenTable Test Case
 */
class CanteenTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CanteenTable
     */
    public $Canteen;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.canteen'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Canteen') ? [] : ['className' => CanteenTable::class];
        $this->Canteen = TableRegistry::get('Canteen', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Canteen);

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
