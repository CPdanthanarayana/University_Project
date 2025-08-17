<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
	protected $table = 'applications';

	protected $casts = [
		'user_id' => 'int',
		'applicant_id' => 'int',
		'documents_attached' => 'bool',
		'departure_date' => 'datetime',
		'return_date' => 'datetime',
		'applicant_signed_date' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'applicant_id',
		'purpose',
		'documents_attached',
		'supporting_docs',
		'program',
		'from_location',
		'to_location',
		'departure_date',
		'return_date',
		'applicant_signature_path',
		'applicant_signed_date',
		'status'
	];

	public function applicant()
	{
		return $this->belongsTo(Applicant::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function application_members()
	{
		return $this->hasMany(ApplicationMember::class);
	}

	public function application_visits()
	{
		return $this->hasMany(ApplicationVisit::class);
	}
}
