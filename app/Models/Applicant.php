<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Applicant
 * 
 * @property int $id
 * @property string|null $service_no
 * @property string $name
 * @property string|null $designation
 * @property string|null $faculty
 * @property string|null $department
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Application[] $applications
 *
 * @package App\Models
 */
class Applicant extends Model
{
	protected $table = 'applicants';
	protected $fillable = [
		'service_no',
		'name',
		'designation',
		'faculty',
		'department',
		'email'
	];

	public function applications()
	{
		return $this->hasMany(Application::class);
	}
}


// composer require reliese/laravel
// php artisan vendor:publish --provider="Reliese\Coders\CodersServiceProvider" --tag=config
// php artisan code:models
