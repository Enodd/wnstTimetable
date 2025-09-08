<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Weekdef
 *
 * @property int $idWeekDef
 * @property string|null $sShortcut
 * @property string|null $sDescript
 * @property int|null $bShow
 * @property int|null $idWeekDefE
 * @property int|null $idWeekDefO
 *
 * @package App\Models
 */
class Weekdef extends Model
{
	protected $table = 'weekdefs';
	protected $primaryKey = 'idWeekDef';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idWeekDef' => 'int',
		'bShow' => 'int',
		'idWeekDefE' => 'int',
		'idWeekDefO' => 'int'
	];

	protected $fillable = [
		'sShortcut',
		'sDescript',
		'bShow',
		'idWeekDefE',
		'idWeekDefO'
	];
}
