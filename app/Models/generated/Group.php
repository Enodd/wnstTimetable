<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 *
 * @property int $id
 * @property string $name
 * @property int $id_group_tree
 * @property int $semester
 * @property string $shortcut
 * @property int $nr_stud
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
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Group extends Model
{
	protected $table = 'groups';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_group_tree' => 'int',
		'semester' => 'int',
		'nr_stud' => 'int',
		'owner' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'cost' => 'int',
		'continuous' => 'int',
		'breaks' => 'int',
		'maxdays' => 'int',
		'balanced' => 'int',
		'color' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'name',
		'id_group_tree',
		'semester',
		'shortcut',
		'nr_stud',
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
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
