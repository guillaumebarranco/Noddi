<?php
namespace App\Model\Table;

use App\Model\Entity\Apply;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Applies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Modeuses
 * @property \Cake\ORM\Association\BelongsTo $Offers
 */
class AppliesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('applies');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Modeuses', [
            'foreignKey' => 'modeuse_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Offers', [
            'foreignKey' => 'offer_id',
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('from_who', 'create')
            ->notEmpty('from_who');
            
        $validator
            ->allowEmpty('message');
            
        $validator
            ->add('viewed', 'valid', ['rule' => 'numeric'])
            ->requirePresence('viewed', 'create')
            ->notEmpty('viewed');
            
        $validator
            ->add('accepted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('accepted', 'create')
            ->notEmpty('accepted');

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
        $rules->add($rules->existsIn(['modeuse_id'], 'Modeuses'));
        $rules->add($rules->existsIn(['offer_id'], 'Offers'));
        return $rules;
    }
}
