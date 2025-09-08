<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Day
 *
 * @property int $id
 * @property string $name
 * @property string|null $sRate
 *
 * @package App\Models
 */
class Day extends Model
{
	protected $table = 'days';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'name',
		'sRate'
	];
}
