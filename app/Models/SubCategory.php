<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'added_by',
        'description',
        'category_id',
        'image',

    ];

    public function setAddedByAttribute($value)
    {
        $this->attributes['added_by'] = auth()->user()->id;
    }

    public function Unit()
    {
        return $this->hasMany(Unit::class, 'SubCategory_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function AddedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
