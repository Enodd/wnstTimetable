<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 *
 * @property int $idUser
 * @property string|null $sName
 * @property string $sSurname
 * @property string $sMail
 * @property int|null $Phone
 * @property int $idOwner
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admins';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUser' => 'int',
		'Phone' => 'int',
		'idOwner' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idUser',
		'sName',
		'sSurname',
		'sMail',
		'Phone',
		'idOwner',
		'dtLastModified',
		'bIsDeleted'
	];
}
