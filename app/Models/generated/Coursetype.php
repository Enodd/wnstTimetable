<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coursetype
 *
 * @property int|null $idCoursetype
 * @property string $type
 *
 * @package App\Models
 */
class Coursetype extends Model
{
	protected $table = 'coursetypes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idCoursetype' => 'int'
	];

	protected $fillable = [
		'idCoursetype',
		'type'
	];
}
