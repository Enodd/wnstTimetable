<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ReserType
 *
 * @property int $idReserType
 * @property string $sDescript
 * @property int|null $bBlockResource
 * @property int|null $bShowCondRoom
 *
 * @package App\Models
 */
class ReserType extends Model
{
	protected $table = 'reser_type';
	protected $primaryKey = 'idReserType';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idReserType' => 'int',
		'bBlockResource' => 'int',
		'bShowCondRoom' => 'int'
	];

	protected $fillable = [
		'sDescript',
		'bBlockResource',
		'bShowCondRoom'
	];
}
