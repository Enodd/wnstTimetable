<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeaturesGroup
 *
 * @property int|null $id
 * @property int|null $id_feature
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class FeaturesGroup extends Model
{
	protected $table = 'features_groups';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_feature' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'id',
		'id_feature',
		'dtLastModified',
		'bIsDeleted'
	];
}
