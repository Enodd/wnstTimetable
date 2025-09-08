<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subjectstudyplan
 *
 * @property int $idSubject
 * @property int $idStudyPlan
 * @property int $iNumber
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Subjectstudyplan extends Model
{
	protected $table = 'subjectstudyplan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSubject' => 'int',
		'idStudyPlan' => 'int',
		'iNumber' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idSubject',
		'idStudyPlan',
		'iNumber',
		'dtLastModified',
		'bIsDeleted'
	];
}
