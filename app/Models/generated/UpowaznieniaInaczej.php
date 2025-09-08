<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UpowaznieniaInaczej
 *
 * @property string $Imie_i_nazwisko
 * @property string|null $Nr_pokoju
 *
 * @package App\Models
 */
class UpowaznieniaInaczej extends Model
{
	protected $table = 'Upowaznienia_inaczej';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Imie_i_nazwisko',
		'Nr_pokoju'
	];
}
