<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Loggable;

class CompanyPost extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'company_id',
        'content',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}