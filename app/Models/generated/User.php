<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int|null $id_cond
 * @property int|null $id_stud
 * @property Carbon|null $data
 * @property int $bShowHelp
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	public $timestamps = false;

	protected $casts = [
		'id_cond' => 'int',
		'id_stud' => 'int',
		'data' => 'datetime',
		'bShowHelp' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'password',
		'id_cond',
		'id_stud',
		'data',
		'bShowHelp',
		'dtLastModified',
		'bIsDeleted'
	];
}
