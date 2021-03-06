<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity.
 */
class Activity extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'counter' => true,
        'brands' => true,
        'offers' => true,
    ];
}
