<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Week
 *
 * @property int $idWeek
 * @property Carbon|null $dtStart
 * @property string|null $sDescript
 *
 * @package App\Models
 */
class Week extends Model
{
	protected $table = 'weeks';
	protected $primaryKey = 'idWeek';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idWeek' => 'int',
		'dtStart' => 'datetime'
	];

	protected $fillable = [
		'dtStart',
		'sDescript'
	];
}
