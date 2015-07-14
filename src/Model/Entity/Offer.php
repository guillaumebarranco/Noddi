<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Offer Entity.
 */
class Offer extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'brand_id' => true,
        'type_id' => true,
        'date_begin' => true,
        'date_end' => true,
        'multiple_targets' => true,
        'expected_targets' => true,
        'title' => true,
        'description' => true,
        'lifestyle' => true,
        'personnality' => true,
        'exchange' => true,
        'finished' => true,
        'brand' => true,
        'type' => true,
    ];
}
