<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Studentcourse
 *
 * @property int|null $idStudent
 * @property int|null $idCourse
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Studentcourse extends Model
{
	protected $table = 'studentcourse';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idStudent' => 'int',
		'idCourse' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idStudent',
		'idCourse',
		'dtLastModified',
		'bIsDeleted'
	];
}
