<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicationMember extends Model
{
	protected $table = 'application_members';

	protected $casts = [
		'application_id' => 'int'
	];

	protected $fillable = [
		'application_id',
		'service_no',
		'name'
	];

	public function application()
	{
		return $this->belongsTo(Application::class);
	}
}
