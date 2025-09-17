<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Studyplancondtree
 *
 * @property int $idCondTree
 * @property int $idStudyPlan
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Studyplancondtree extends Model
{
	protected $table = 'studyplancondtree';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCondTree' => 'int',
		'idStudyPlan' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idCondTree',
		'idStudyPlan',
		'dtLastModified',
		'bIsDeleted'
	];
}
