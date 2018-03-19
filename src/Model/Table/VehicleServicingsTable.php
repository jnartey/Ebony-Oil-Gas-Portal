<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VehicleServicings Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\VehiclesTable|\Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\VehicleServicing get($primaryKey, $options = [])
 * @method \App\Model\Entity\VehicleServicing newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VehicleServicing[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VehicleServicing|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VehicleServicing patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleServicing[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VehicleServicing findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VehicleServicingsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('vehicle_servicings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('mileage', 'create')
            ->notEmpty('mileage');

        $validator
            ->integer('general_servicing')
            ->requirePresence('general_servicing', 'create')
            ->notEmpty('general_servicing');
		
        $validator
            ->integer('vehicle_id')
            ->requirePresence('vehicle_id', 'create')
            ->notEmpty('vehicle_id');

        $validator
            //->requirePresence('other', 'create')
            ->allowEmpty('other');

        $validator
            ->date('service_date')
            //->requirePresence('service_date', 'create')
            ->allowEmpty('service_date');

        $validator
            ->date('next_service_date')
            //->requirePresence('next_service_date', 'create')
            ->allowEmpty('next_service_date');

        $validator
            ->integer('approved_by')
            //->requirePresence('approved_by', 'create')
            ->allowEmpty('approved_by');

        $validator
            ->date('approval_date')
            //->requirePresence('approval_date', 'create')
            ->allowEmpty('approval_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));

        return $rules;
    }
}
