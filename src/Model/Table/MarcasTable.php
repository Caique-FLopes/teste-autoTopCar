<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Marcas Model
 *
 * @property \App\Model\Table\CarrosTable&\Cake\ORM\Association\HasMany $Carros
 *
 * @method \App\Model\Entity\Marca get($primaryKey, $options = [])
 * @method \App\Model\Entity\Marca newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Marca[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Marca|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Marca saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Marca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Marca[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Marca findOrCreate($search, callable $callback = null, $options = [])
 */
class MarcasTable extends Table
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

        $this->setTable('marcas');
        $this->setDisplayField('name');
        $this->setDisplayField('logo_file');
        $this->setPrimaryKey('id');

        $this->hasMany('Carros', [
            'foreignKey' => 'marca_id',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->dateTime('created_at')
            ->allowEmptyDateTime('created_at');

        $validator
            ->dateTime('updated_at')
            ->allowEmptyDateTime('updated_at');

        return $validator;
    }
}
