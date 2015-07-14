<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 */
class Post extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'modeuse_id' => true,
        'social' => true,
        'title' => true,
        'content' => true,
        'picture' => true,
        'likes' => true,
        'number' => true,
        'shares' => true,
        'comments' => true,
        'nb_tweets' => true,
        'modeus' => true,
    ];
}
