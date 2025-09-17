<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Holiday
 *
 * @property int $idHoliday
 * @property string|null $sName
 * @property string|null $sDescript
 * @property int|null $idWeek
 * @property int|null $iDay
 * @property int|null $iStart
 * @property int|null $iDur
 * @property int|null $idGroupTree
 * @property int|null $idCondTree
 * @property int|null $idRoomTree
 * @property int|null $idOwner
 * @property int|null $idLastChange
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Holiday extends Model
{
	protected $table = 'holidays';
	protected $primaryKey = 'idHoliday';
	public $timestamps = false;

	protected $casts = [
		'idWeek' => 'int',
		'iDay' => 'int',
		'iStart' => 'int',
		'iDur' => 'int',
		'idGroupTree' => 'int',
		'idCondTree' => 'int',
		'idRoomTree' => 'int',
		'idOwner' => 'int',
		'idLastChange' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'sName',
		'sDescript',
		'idWeek',
		'iDay',
		'iStart',
		'iDur',
		'idGroupTree',
		'idCondTree',
		'idRoomTree',
		'idOwner',
		'idLastChange',
		'dtLastModified',
		'bIsDeleted'
	];
}
