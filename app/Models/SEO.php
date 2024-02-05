<?php

namespace App\Models;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SEO extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
