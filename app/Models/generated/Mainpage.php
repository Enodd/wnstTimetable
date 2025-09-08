<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mainpage
 *
 * @property int $id
 * @property string $sTag
 * @property string $sHtml
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Mainpage extends Model
{
	protected $table = 'mainpage';
	public $timestamps = false;

	protected $casts = [
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'sTag',
		'sHtml',
		'dtLastModified',
		'bIsDeleted'
	];
}
