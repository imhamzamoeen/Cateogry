<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{ 
    use HasFactory; use SoftDeletes;
    protected $fillable = [

        'quantity',
        'type',
        'unit_id',
        'last_performer',
        'user_id',
        'status'
    ];
    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id',);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id',);
    }
}
