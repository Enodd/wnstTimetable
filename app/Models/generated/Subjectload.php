<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subjectload
 *
 * @property int $idSubjectLoad
 * @property int $iLecture
 * @property int $iExercise
 * @property int $iLaboratory
 * @property int $iProject
 * @property int $iSeminar
 * @property int $bExam
 * @property int $iECTS
 * @property int $iSemester
 * @property int $idSubject
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Subjectload extends Model
{
	protected $table = 'subjectload';
	protected $primaryKey = 'idSubjectLoad';
	public $timestamps = false;

	protected $casts = [
		'iLecture' => 'int',
		'iExercise' => 'int',
		'iLaboratory' => 'int',
		'iProject' => 'int',
		'iSeminar' => 'int',
		'bExam' => 'int',
		'iECTS' => 'int',
		'iSemester' => 'int',
		'idSubject' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'iLecture',
		'iExercise',
		'iLaboratory',
		'iProject',
		'iSeminar',
		'bExam',
		'iECTS',
		'iSemester',
		'idSubject',
		'dtLastModified',
		'bIsDeleted'
	];
}
