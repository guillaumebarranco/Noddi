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
            ->allowEmpty('firstname');
            
        $validator
            ->allowEmpty('lastname');
            
        $validator
            ->allowEmpty('instagram');
            
        $validator
            ->allowEmpty('twitter');
            
        $validator
            ->allowEmpty('facebook');
            
        $validator
            ->allowEmpty('pinterest');
            
        $validator
            ->allowEmpty('activity_searched');
            
        $validator
            ->add('insta_followers', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('insta_followers');
            
        $validator
            ->add('twitter_followers', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('twitter_followers');
            
        $validator
            ->add('noddi_rank', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('noddi_rank');
            
        $validator
            ->add('offers_attempted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('offers_attempted', 'create')
            ->notEmpty('offers_attempted');
            
        $validator
            ->add('offers_accepted', 'valid', ['rule' => 'numeric'])
            ->requirePresence('offers_accepted', 'create')
            ->notEmpty('offers_accepted');
            
        $validator
            ->allowEmpty('hobbies');
            
        $validator
            ->allowEmpty('city');
            
        $validator
            ->add('age', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('age');

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
