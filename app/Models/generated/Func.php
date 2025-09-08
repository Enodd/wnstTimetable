<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Func
 *
 * @property string $name
 * @property bool $ret
 * @property string $dl
 * @property string $type
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Func extends Model
{
	protected $table = 'func';
	protected $primaryKey = 'name';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'ret' => 'bool',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'ret',
		'dl',
		'type',
		'dtLastModified',
		'bIsDeleted'
	];
}
