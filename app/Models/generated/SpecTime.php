<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SpecTime
 *
 * @property int $id
 * @property string $description
 *
 * @package App\Models
 */
class SpecTime extends Model
{
	protected $table = 'spec_times';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'id',
		'description'
	];
}
