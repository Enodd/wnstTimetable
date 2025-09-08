<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Upowaznienium
 *
 * @property string $nr_room
 * @property string|null $nazwisko
 *
 * @package App\Models
 */
class Upowaznienium extends Model
{
	protected $table = 'Upowaznienia';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'nr_room',
		'nazwisko'
	];
}
