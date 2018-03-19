<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WorkgroupsFixture
 *
 */
class WorkgroupsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'description' => ['type' => 'text', 'length' => 16777215, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_on' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'approve_members' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => 'ALL', 'collate' => 'latin1_swedish_ci', 'comment' => 'Approved members. Data can be stored include ALL (Any site member can join), ANY(Only approved members can join), APPR(Only approved members can join except for invited members)', 'precision' => null, 'fixed' => null],
        'content_access' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => 'GROUP', 'collate' => 'latin1_swedish_ci', 'comment' => 'The content access, ALL (anybody can view the content), SITE(Site members), GROUP (Group members). Defaults to only group members', 'precision' => null, 'fixed' => null],
        'is_approved' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'Whether a workgroup created is approved by the portal adminsitrator or not. Defaults to FALSE', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_workgroup_user1_idx' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_workgroup_user1' => ['type' => 'foreign', 'columns' => ['created_by'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created_by' => 1,
            'created_on' => '2017-04-11 09:32:07',
            'approve_members' => 'Lorem ip',
            'content_access' => 'Lorem ipsum dolor sit amet',
            'is_approved' => 1,
            'created' => '2017-04-11 09:32:07',
            'modified' => '2017-04-11 09:32:07'
        ],
    ];
}
