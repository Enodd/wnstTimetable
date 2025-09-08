<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Electivecourse
 *
 * @property int $idCourse
 * @property int $idStudent
 * @property int $bSelected
 * @property Carbon $dtLastChange
 * @property int $bBlockade
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Electivecourse extends Model
{
	protected $table = 'electivecourses';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCourse' => 'int',
		'idStudent' => 'int',
		'bSelected' => 'int',
		'dtLastChange' => 'datetime',
		'bBlockade' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idCourse',
		'idStudent',
		'bSelected',
		'dtLastChange',
		'bBlockade',
		'dtLastModified',
		'bIsDeleted'
	];
}
