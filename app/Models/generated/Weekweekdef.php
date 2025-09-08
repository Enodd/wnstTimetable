<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Weekweekdef
 *
 * @property int|null $idWeek
 * @property int|null $idWeekDef
 *
 * @package App\Models
 */
class Weekweekdef extends Model
{
	protected $table = 'weekweekdef';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idWeek' => 'int',
		'idWeekDef' => 'int'
	];

	protected $fillable = [
		'idWeek',
		'idWeekDef'
	];
}
