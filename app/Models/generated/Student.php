<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property int $idStudent
 * @property int|null $idSOTS
 * @property int|null $idStudentTree
 * @property string|null $sName
 * @property string|null $sSurname
 * @property string|null $sMail
 * @property int|null $bBlockade
 * @property int|null $idUserModified
 * @property int|null $idUserOwner
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Student extends Model
{
	protected $table = 'students';
	protected $primaryKey = 'idStudent';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idStudent' => 'int',
		'idSOTS' => 'int',
		'idStudentTree' => 'int',
		'bBlockade' => 'int',
		'idUserModified' => 'int',
		'idUserOwner' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idSOTS',
		'idStudentTree',
		'sName',
		'sSurname',
		'sMail',
		'bBlockade',
		'idUserModified',
		'idUserOwner',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
