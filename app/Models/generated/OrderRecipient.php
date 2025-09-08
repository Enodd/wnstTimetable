<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\generated;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderRecipient
 *
 * @property int $idOrderRecipient
 * @property string|null $sDescript
 * @property string|null $sMail
 * @property int $idSOTS
 * @property Carbon|null $dtLastModified
 * @property int $bIsDeleted
 *
 * @package App\Models
 */
class OrderRecipient extends Model
{
	protected $table = 'order_recipient';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idOrderRecipient' => 'int',
		'idSOTS' => 'int',
		'dtLastModified' => 'datetime',
		'bIsDeleted' => 'int'
	];

	protected $fillable = [
		'idOrderRecipient',
		'sDescript',
		'sMail',
		'idSOTS',
		'dtLastModified',
		'bIsDeleted'
	];
}
