<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Studentgroup
 *
 * @property int|null $idStudent
 * @property int|null $idGroup
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Studentgroup extends Model
{
	protected $table = 'studentgroup';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idStudent' => 'int',
		'idGroup' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idStudent',
		'idGroup',
		'dtLastModified',
		'bIsDeleted'
	];
}
