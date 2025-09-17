<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupTree
 *
 * @property int $id_group_tree
 * @property string $name
 * @property int $parent
 * @property int $owner
 * @property int $blockade
 * @property int $last_change
 * @property int $iTimeRangeStart
 * @property int $iTimeRangeStop
 * @property int $bTimeRangeActive
 * @property int $bShowPlan
 * @property int $idStudyPlan
 * @property string|null $sHash
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class GroupTree extends Model
{
	protected $table = 'group_tree';
	protected $primaryKey = 'id_group_tree';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_group_tree' => 'int',
		'parent' => 'int',
		'owner' => 'int',
		'blockade' => 'int',
		'last_change' => 'int',
		'iTimeRangeStart' => 'int',
		'iTimeRangeStop' => 'int',
		'bTimeRangeActive' => 'int',
		'bShowPlan' => 'int',
		'idStudyPlan' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'name',
		'parent',
		'owner',
		'blockade',
		'last_change',
		'iTimeRangeStart',
		'iTimeRangeStop',
		'bTimeRangeActive',
		'bShowPlan',
		'idStudyPlan',
		'sHash',
		'dtLastModified',
		'bIsDeleted'
	];
}
