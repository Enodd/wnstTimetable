<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AvailGr
 *
 * @property int $id_group
 * @property int $start_time
 * @property int $stop_time
 * @property int|null $idWeekDef
 * @property int|null $idWeek
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class AvailGr extends Model
{
	protected $table = 'avail_gr';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_group' => 'int',
		'start_time' => 'int',
		'stop_time' => 'int',
		'idWeekDef' => 'int',
		'idWeek' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id_group',
		'start_time',
		'stop_time',
		'idWeekDef',
		'idWeek',
		'dtLastModified',
		'bIsDeleted'
	];
}
