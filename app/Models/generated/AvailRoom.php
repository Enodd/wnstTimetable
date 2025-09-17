<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AvailRoom
 *
 * @property int $id_room
 * @property int $start_time
 * @property int $stop_time
 * @property int|null $idWeekDef
 * @property int|null $idWeek
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class AvailRoom extends Model
{
	protected $table = 'avail_room';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_room' => 'int',
		'start_time' => 'int',
		'stop_time' => 'int',
		'idWeekDef' => 'int',
		'idWeek' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id_room',
		'start_time',
		'stop_time',
		'idWeekDef',
		'idWeek',
		'dtLastModified',
		'bIsDeleted'
	];
}
