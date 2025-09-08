<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Undesirable
 *
 * @property int $id_cond
 * @property int|null $start_time
 * @property int|null $stop_time
 * @property int|null $idWeekDef
 * @property int|null $idWeek
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Undesirable extends Model
{
	protected $table = 'undesirable';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_cond' => 'int',
		'start_time' => 'int',
		'stop_time' => 'int',
		'idWeekDef' => 'int',
		'idWeek' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id_cond',
		'start_time',
		'stop_time',
		'idWeekDef',
		'idWeek',
		'dtLastModified',
		'bIsDeleted'
	];
}
