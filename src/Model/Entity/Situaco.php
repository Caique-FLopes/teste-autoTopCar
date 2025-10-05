<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Situaco Entity
 *
 * @property int $id
 * @property string $description
 * @property int $id_item
 * @property string $table_item
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 */
class Situaco extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'description' => true,
        'id_item' => true,
        'table_item' => true,
        'created_at' => true,
        'updated_at' => true,
    ];
}
