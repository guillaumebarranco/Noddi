<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Brand Entity.
 */
class Brand extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'name' => true,
        'activity_id' => true,
        'offers_created' => true,
        'user' => true,
        'activity' => true,
        'offers' => true,
    ];
}
