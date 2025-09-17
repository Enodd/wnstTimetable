<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 *
 * @property int $idSubject
 * @property string|null $sName
 * @property string|null $sFaculty
 * @property string|null $sDescription
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subject';
	protected $primaryKey = 'idSubject';
	public $timestamps = false;

	protected $casts = [
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'sName',
		'sFaculty',
		'sDescription',
		'dtLastModified',
		'bIsDeleted'
	];
}
