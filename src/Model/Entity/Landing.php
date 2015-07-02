<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Landing Entity.
 */
class Landing extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
    ];
}
