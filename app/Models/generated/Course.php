<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $shortcut
 * @property string|null $type
 * @property int|null $iPossCond
 * @property int|null $iPossRoom
 * @property int|null $iNumberOfHours
 * @property string|null $startfix
 * @property int|null $owner
 * @property int|null $blockade
 * @property int|null $last_change
 * @property string|null $comment
 * @property string|null $url
 * @property int|null $cost
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'iPossCond' => 'int',
		'iPossRoom' => 'int',
		'iNumberOfHours' => 'int',
		'owner' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'cost' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'name',
		'shortcut',
		'type',
		'iPossCond',
		'iPossRoom',
		'iNumberOfHours',
		'startfix',
		'owner',
		'blockade',
		'last_change',
		'comment',
		'url',
		'cost',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
