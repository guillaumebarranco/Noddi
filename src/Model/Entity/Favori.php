<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Favori Entity.
 */
class Favori extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'brand_id' => true,
        'modeuse_id' => true,
        'brand' => true,
        'modeus' => true,
    ];
}
