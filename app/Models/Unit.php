<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'added_by',
        'quantity',
        'price',
        'SubCategory_id',
        'image'
    ];

    public function setAddedByAttribute($value)
    {
        $this->attributes['added_by'] = auth()->user()->id;
    }


    /**
     * Get the user that owns the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SubCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'SubCategory_id');
    }

    public function AddedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
