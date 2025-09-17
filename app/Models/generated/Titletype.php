<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Titletype
 *
 * @property int|null $idTitletype
 * @property string $titletype
 *
 * @package App\Models
 */
class Titletype extends Model
{
	protected $table = 'titletypes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTitletype' => 'int'
	];

	protected $fillable = [
		'idTitletype',
		'titletype'
	];
}
