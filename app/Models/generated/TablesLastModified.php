<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TablesLastModified
 *
 * @property string $sTableName
 * @property Carbon|null $dtLastModified
 *
 * @package App\Models
 */
class TablesLastModified extends Model
{
	protected $table = 'tables_last_modified';
	protected $primaryKey = 'sTableName';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'dtLastModified' => 'datetime'
	];

	protected $fillable = [
		'dtLastModified'
	];
}
