<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Conductor
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $shortcut
 * @property string $title
 * @property string $room
 * @property string $mail
 * @property string $phone
 * @property int $id_cond_tree
 * @property int $maxdays
 * @property int $owner
 * @property int $blockade
 * @property int $last_change
 * @property string $comment
 * @property string $comment2
 * @property int $cost
 * @property int $continuous
 * @property int $breaks
 * @property int $balanced
 * @property int $color
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Conductor extends Model
{
	protected $table = 'conductors';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_cond_tree' => 'int',
		'maxdays' => 'int',
		'owner' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'cost' => 'int',
		'continuous' => 'int',
		'breaks' => 'int',
		'balanced' => 'int',
		'color' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'name',
		'surname',
		'shortcut',
		'title',
		'room',
		'mail',
		'phone',
		'id_cond_tree',
		'maxdays',
		'owner',
		'blockade',
		'last_change',
		'comment',
		'comment2',
		'cost',
		'continuous',
		'breaks',
		'balanced',
		'color',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
