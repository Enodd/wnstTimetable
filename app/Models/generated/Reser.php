<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reser
 *
 * @property int $id
 * @property int|null $idReserType
 * @property string|null $type
 * @property string|null $descript
 * @property int|null $active
 * @property int|null $blockade
 * @property int|null $last_change
 * @property int|null $owner
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Reser extends Model
{
	protected $table = 'resers';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'idReserType' => 'int',
		'active' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'owner' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idReserType',
		'type',
		'descript',
		'active',
		'blockade',
		'last_change',
		'owner',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
