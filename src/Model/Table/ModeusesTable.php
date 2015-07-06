<?php
namespace App\Model\Table;

use App\Model\Entity\Modeus;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Modeuses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ModeusesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('modeuses');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');
            
        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');
            
        $validator
            ->requirePresence('instagram', 'create')
            ->notEmpty('instagram');
            
        $validator
            ->requirePresence('twitter', 'create')
            ->notEmpty('twitter');
            
        $validator
            ->requirePresence('facebook', 'create')
            ->notEmpty('facebook');
            
        $validator
            ->requirePresence('pinterest', 'create')
            ->notEmpty('pinterest');
            
        $validator
            ->requirePresence('activity_searched', 'create')
            ->notEmpty('activity_searched');
            
        $validator
            ->add('insta_followers', 'valid', ['rule' => 'numeric'])
            ->requirePresence('insta_followers', 'create')
            ->notEmpty('insta_followers');
            
        $validator
            ->add('noddi_rank', 'valid', ['rule' => 'numeric'])
            ->requirePresence('noddi_rank', 'create')
            ->notEmpty('noddi_rank');
            
        $validator
            ->add('offers_attempted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('offers_attempted', 'create')
            ->notEmpty('offers_attempted');
            
        $validator
            ->add('offers_accepted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('offers_accepted', 'create')
            ->notEmpty('offers_accepted');
            
        $validator
            ->requirePresence('hobbies', 'create')
            ->notEmpty('hobbies');
            
        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');
            
        $validator
            ->add('age', 'valid', ['rule' => 'numeric'])
            ->requirePresence('age', 'create')
            ->notEmpty('age');

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
        return $rules;
    }
}
