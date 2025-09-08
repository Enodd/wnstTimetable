<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @property int $idEvent
 * @property float|null $fCostPerTimeSlot
 * @property int $idUserOwner
 * @property int $idUserClient
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Transaction extends Model
{
	protected $table = 'transactions';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idEvent' => 'int',
		'fCostPerTimeSlot' => 'float',
		'idUserOwner' => 'int',
		'idUserClient' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idEvent',
		'fCostPerTimeSlot',
		'idUserOwner',
		'idUserClient',
		'dtLastModified',
		'bIsDeleted'
	];
}
