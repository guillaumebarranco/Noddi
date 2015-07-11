<?php
namespace App\Model\Table;

use App\Model\Entity\Brand;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Brands Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Activities
 * @property \Cake\ORM\Association\HasMany $Favoris
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Offers
 */
class BrandsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('brands');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Activities', [
            'foreignKey' => 'activity_id'
        ]);
        $this->hasMany('Favoris', [
            'foreignKey' => 'brand_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'brand_id'
        ]);
        $this->hasMany('Offers', [
            'foreignKey' => 'brand_id'
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
            ->allowEmpty('name');
            
        $validator
            ->add('offers_created', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('offers_created');
            
        $validator
            ->allowEmpty('type_commerce');
            
        $validator
            ->allowEmpty('city');

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
        $rules->add($rules->existsIn(['activity_id'], 'Activities'));
        return $rules;
    }
}
