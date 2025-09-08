<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PossCond
 *
 * @property int $idCourse
 * @property int $idCond
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class PossCond extends Model
{
	protected $table = 'poss_conds';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCourse' => 'int',
		'idCond' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idCourse',
		'idCond',
		'dtLastModified',
		'bIsDeleted'
	];
}
