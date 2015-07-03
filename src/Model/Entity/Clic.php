<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clic Entity.
 */
class Clic extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'counter' => true,
    ];
}
