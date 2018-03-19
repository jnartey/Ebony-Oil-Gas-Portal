<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Canteen Model
 *
 * @method \App\Model\Entity\Canteen get($primaryKey, $options = [])
 * @method \App\Model\Entity\Canteen newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Canteen[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Canteen|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Canteen patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Canteen[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Canteen findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CanteenTable extends Table
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

        $this->setTable('canteen');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('menu', 'create');
			

        $validator
            //->boolean('week')
			->integer('week')
            ->allowEmpty('week', 'create');

        $validator
            //->boolean('day')
			->integer('day')
            ->allowEmpty('day', 'create');

        $validator
            ->allowEmpty('morning_meal', 'create');

        $validator
            ->allowEmpty('morning_meal_description', 'create');

        $validator
            ->allowEmpty('afternoon_meal', 'create');

        $validator
            ->allowEmpty('afternoon_meal_description', 'create');

        $validator
            ->allowEmpty('evening_meal', 'create');

        $validator
            ->allowEmpty('evening_meal_description', 'create');

        $validator
            ->integer('status')
            ->allowEmpty('status', 'create');

        return $validator;
    }
}
