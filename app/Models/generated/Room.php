<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 *
 * @property int $id
 * @property int $id_room_tree
 * @property string $nr_room
 * @property int $capacity
 * @property int $owner
 * @property int $blockade
 * @property int $last_change
 * @property string $comment
 * @property int $cost
 * @property int $continuous
 * @property int $breaks
 * @property int $maxdays
 * @property int $balanced
 * @property int $color
 * @property string $type
 * @property int $capacity_lab
 * @property int $idUserResp
 * @property int $charge
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Room extends Model
{
	protected $table = 'rooms';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_room_tree' => 'int',
		'capacity' => 'int',
		'owner' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'cost' => 'int',
		'continuous' => 'int',
		'breaks' => 'int',
		'maxdays' => 'int',
		'balanced' => 'int',
		'color' => 'int',
		'capacity_lab' => 'int',
		'idUserResp' => 'int',
		'charge' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id_room_tree',
		'nr_room',
		'capacity',
		'owner',
		'blockade',
		'last_change',
		'comment',
		'cost',
		'continuous',
		'breaks',
		'maxdays',
		'balanced',
		'color',
		'type',
		'capacity_lab',
		'idUserResp',
		'charge',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
