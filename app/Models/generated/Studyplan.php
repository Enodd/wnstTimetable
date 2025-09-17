<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Studyplan
 *
 * @property int $idStudyPlan
 * @property string|null $sName
 * @property string|null $sSpecialization
 * @property string|null $sSpecShortcut
 * @property string|null $sStudyPlanType
 * @property string|null $sTypeShortcut
 * @property Carbon|null $dtAproved
 * @property string|null $sDescription
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Studyplan extends Model
{
	protected $table = 'studyplan';
	protected $primaryKey = 'idStudyPlan';
	public $timestamps = false;

	protected $casts = [
		'dtAproved' => 'datetime',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'sName',
		'sSpecialization',
		'sSpecShortcut',
		'sStudyPlanType',
		'sTypeShortcut',
		'dtAproved',
		'sDescription',
		'dtLastModified',
		'bIsDeleted'
	];
}
