<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UndesirStart
 *
 * @property int|null $id
 * @property int|null $start
 * @property int|null $stop
 * @property int|null $idWeekDef
 * @property int|null $idWeek
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class UndesirStart extends Model
{
	protected $table = 'undesir_starts';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'start' => 'int',
		'stop' => 'int',
		'idWeekDef' => 'int',
		'idWeek' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id',
		'start',
		'stop',
		'idWeekDef',
		'idWeek',
		'dtLastModified',
		'bIsDeleted'
	];
}
