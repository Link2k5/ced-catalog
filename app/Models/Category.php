<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, HasFactory, HasUuid;

    protected $fillable = ['name', 'is_active', 'description'];
    public $incrementing = false;
    protected $keyType = 'string';

}
