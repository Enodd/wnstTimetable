<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Right
 *
 * @property int $idUser
 * @property int $idResource
 * @property int|null $bRights
 * @property int|null $iType
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Right extends Model
{
	protected $table = 'rights';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int',
		'idResource' => 'int',
		'bRights' => 'int',
		'iType' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idUser',
		'idResource',
		'bRights',
		'iType',
		'dtLastModified',
		'bIsDeleted'
	];
}
