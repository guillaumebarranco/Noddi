<?php
namespace App\Model\Table;

use App\Model\Entity\Offer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Brands
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\BelongsTo $Modeuses
 * @property \Cake\ORM\Association\HasMany $Applies
 * @property \Cake\ORM\Association\HasMany $Messages
 */
class OffersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('offers');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Modeuses', [
            'foreignKey' => 'modeuse_id'
        ]);
        $this->hasMany('Applies', [
            'foreignKey' => 'offer_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'offer_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->add('date_begin', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('date_begin');
            
        $validator
            ->add('date_end', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('date_end');
            
        $validator
            ->allowEmpty('title');
            
        $validator
            ->allowEmpty('description');
            
        $validator
            ->requirePresence('lifestyle', 'create')
            ->notEmpty('lifestyle');
            
        $validator
            ->requirePresence('personnality', 'create')
            ->notEmpty('personnality');
            
        $validator
            ->requirePresence('exchange', 'create')
            ->notEmpty('exchange');
            
        $validator
            ->add('finished', 'valid', ['rule' => 'numeric'])
            ->requirePresence('finished', 'create')
            ->notEmpty('finished');

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
        $rules->add($rules->existsIn(['brand_id'], 'Brands'));
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        $rules->add($rules->existsIn(['modeuse_id'], 'Modeuses'));
        return $rules;
    }
}
