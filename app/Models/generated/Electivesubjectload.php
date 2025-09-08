<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Electivesubjectload
 *
 * @property int $idSubjectLoad
 * @property int $idStudent
 * @property int $bSelected
 * @property Carbon $dtLastChange
 * @property int $bBlockade
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Electivesubjectload extends Model
{
	protected $table = 'electivesubjectload';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSubjectLoad' => 'int',
		'idStudent' => 'int',
		'bSelected' => 'int',
		'dtLastChange' => 'datetime',
		'bBlockade' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idSubjectLoad',
		'idStudent',
		'bSelected',
		'dtLastChange',
		'bBlockade',
		'dtLastModified',
		'bIsDeleted'
	];
}
