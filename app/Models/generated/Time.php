<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Time
 *
 * @property int|null $idEvent
 * @property int|null $start
 * @property int|null $dur
 * @property int|null $idWeek
 * @property int|null $idWeekDef
 * @property Carbon|null $dtStart
 * @property Carbon|null $dtStop
 * @property int $idRoom
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Time extends Model
{
	protected $table = 'times';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idEvent' => 'int',
		'start' => 'int',
		'dur' => 'int',
		'idWeek' => 'int',
		'idWeekDef' => 'int',
		'dtStart' => 'datetime',
		'dtStop' => 'datetime',
		'idRoom' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idEvent',
		'start',
		'dur',
		'idWeek',
		'idWeekDef',
		'dtStart',
		'dtStop',
		'idRoom',
		'dtLastModified',
		'bIsDeleted'
	];
}
