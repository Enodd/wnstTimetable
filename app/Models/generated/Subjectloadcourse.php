<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subjectloadcourse
 *
 * @property int $idSubjectLoad
 * @property int $idCourse
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Subjectloadcourse extends Model
{
	protected $table = 'subjectloadcourse';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSubjectLoad' => 'int',
		'idCourse' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idSubjectLoad',
		'idCourse',
		'dtLastModified',
		'bIsDeleted'
	];
}
