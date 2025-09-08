<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SetCond
 *
 * @property int $id
 * @property int $id_cond
 * @property int $nr_hours
 * @property string $remarks
 * @property int $idRoom
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class SetCond extends Model
{
	protected $table = 'set_cond';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_cond' => 'int',
		'nr_hours' => 'int',
		'idRoom' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id',
		'id_cond',
		'nr_hours',
		'remarks',
		'idRoom',
		'dtLastModified',
		'bIsDeleted'
	];
}
