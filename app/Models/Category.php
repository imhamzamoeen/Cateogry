<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'added_by',
        'image',

    ];

    public function setAddedByAttribute($value)
    {
        $this->attributes['added_by'] = auth()->user()->id;
    }

    public function SubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function AddedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
