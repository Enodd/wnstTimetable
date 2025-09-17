<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coursecourse
 *
 * @property int|null $idCourseParent
 * @property int|null $idCourseChild
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Coursecourse extends Model
{
	protected $table = 'coursecourse';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCourseParent' => 'int',
		'idCourseChild' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idCourseParent',
		'idCourseChild',
		'dtLastModified',
		'bIsDeleted'
	];
}
