<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Color
 *
 * @property int|null $idColor
 * @property string $name
 * @property int|null $color
 *
 * @package App\Models
 */
class Color extends Model
{
	protected $table = 'colors';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idColor' => 'int',
		'color' => 'int'
	];

	protected $fillable = [
		'idColor',
		'name',
		'color'
	];
}
