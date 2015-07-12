<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Modeus Entity.
 */
class Modeus extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'firstname' => true,
        'lastname' => true,
        'instagram' => true,
        'twitter' => true,
        'facebook' => true,
        'pinterest' => true,
        'activity_searched' => true,
        'insta_followers' => true,
        'twitter_followers' => true,
        'noddi_rank' => true,
        'offers_attempted' => true,
        'offers_accepted' => true,
        'hobbies' => true,
        'city' => true,
        'age' => true,
        'user' => true,
    ];
}
