<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Description
 *
 * @property string $name
 * @property string $year
 * @property string $semes
 * @property int $nr_timeslots
 * @property Carbon $start_time
 * @property Carbon $stop_time
 * @property int $group_slots
 * @property string $spec_times
 * @property int|null $hourcorrect
 * @property int $localidcounter
 * @property string $plan_version
 * @property int $counter
 * @property int $default_weekdef
 * @property Carbon $dtExportAll
 * @property Carbon|null $dtConservation
 * @property string $sEncoding
 *
 * @package App\Models
 */
class Description extends Model
{
	protected $table = 'description';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'nr_timeslots' => 'int',
		'start_time' => 'datetime',
		'stop_time' => 'datetime',
		'group_slots' => 'int',
		'hourcorrect' => 'int',
		'localidcounter' => 'int',
		'counter' => 'int',
		'default_weekdef' => 'int',
		'dtExportAll' => 'datetime',
		'dtConservation' => 'datetime'
	];

	protected $fillable = [
		'name',
		'year',
		'semes',
		'nr_timeslots',
		'start_time',
		'stop_time',
		'group_slots',
		'spec_times',
		'hourcorrect',
		'localidcounter',
		'plan_version',
		'counter',
		'default_weekdef',
		'dtExportAll',
		'dtConservation',
		'sEncoding'
	];
}
