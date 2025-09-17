<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subjectcondtree
 *
 * @property int $idCondTree
 * @property int $idSubject
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Subjectcondtree extends Model
{
	protected $table = 'subjectcondtree';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCondTree' => 'int',
		'idSubject' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idCondTree',
		'idSubject',
		'dtLastModified',
		'bIsDeleted'
	];
}
