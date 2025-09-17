<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentTree
 *
 * @property int $idStudentTree
 * @property string $sName
 * @property int $idParent
 * @property int $idUserOwner
 * @property int $bBlockadeType
 * @property int $idUserModified
 * @property int $iTimeRangeStart
 * @property int $iTimeRangeStop
 * @property int $bTimeRangeActive
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class StudentTree extends Model
{
	protected $table = 'student_tree';
	protected $primaryKey = 'idStudentTree';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idStudentTree' => 'int',
		'idParent' => 'int',
		'idUserOwner' => 'int',
		'bBlockadeType' => 'int',
		'idUserModified' => 'int',
		'iTimeRangeStart' => 'int',
		'iTimeRangeStop' => 'int',
		'bTimeRangeActive' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'sName',
		'idParent',
		'idUserOwner',
		'bBlockadeType',
		'idUserModified',
		'iTimeRangeStart',
		'iTimeRangeStop',
		'bTimeRangeActive',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
