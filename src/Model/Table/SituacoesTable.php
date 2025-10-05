<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Situacoes Model
 *
 * @method \App\Model\Entity\Situaco get($primaryKey, $options = [])
 * @method \App\Model\Entity\Situaco newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Situaco[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Situaco|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situaco saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Situaco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Situaco[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Situaco findOrCreate($search, callable $callback = null, $options = [])
 */
class SituacoesTable extends Table
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

        $this->setTable('situacoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('description')
            ->notEmptyString('description');

        $validator
            ->integer('id_item')
            ->requirePresence('id_item', 'create')
            ->notEmptyString('id_item');

        $validator
            ->scalar('table_item')
            ->maxLength('table_item', 255)
            ->requirePresence('table_item', 'create')
            ->notEmptyString('table_item');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
