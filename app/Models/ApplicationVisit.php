<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplicationVisit extends Model
{
	protected $table = 'application_visits';

	protected $casts = [
		'application_id' => 'int',
		'visit_date' => 'datetime'
	];

	protected $fillable = [
		'application_id',
		'visit_date',
		'visit_time',
		'purpose',
		'location',
		'notes',
		'status'
	];

	public function application()
	{
		return $this->belongsTo(Application::class);
	}
}
