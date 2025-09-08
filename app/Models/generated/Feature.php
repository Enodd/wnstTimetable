<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 *
 * @property int $id
 * @property string $feature
 *
 * @package App\Models
 */
class Feature extends Model
{
	protected $table = 'features';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'feature'
	];
}
