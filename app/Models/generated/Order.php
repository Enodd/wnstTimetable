<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 *
 * @property int $id
 * @property int $idCourse
 * @property int $idWeekDef
 * @property Carbon $dtSend
 * @property int $idSender
 * @property int $idCondTree
 * @property string $sComment
 * @property int $bConfirmed
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'idCourse' => 'int',
		'idWeekDef' => 'int',
		'dtSend' => 'datetime',
		'idSender' => 'int',
		'idCondTree' => 'int',
		'bConfirmed' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id',
		'idCourse',
		'idWeekDef',
		'dtSend',
		'idSender',
		'idCondTree',
		'sComment',
		'bConfirmed',
		'dtLastModified',
		'bIsDeleted'
	];
}
