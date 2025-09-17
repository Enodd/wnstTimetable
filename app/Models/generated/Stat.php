<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stat
 *
 * @property int $idStats
 * @property string|null $IP
 * @property Carbon|null $date
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Stat extends Model
{
	protected $table = 'stats';
	protected $primaryKey = 'idStats';
	public $timestamps = false;

	protected $casts = [
		'date' => 'datetime',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'IP',
		'date',
		'dtLastModified',
		'bIsDeleted'
	];
}
