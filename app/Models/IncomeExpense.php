<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeExpense extends Model
{
    use HasFactory; use SoftDeletes;
    protected $fillable = [
        'description',
        'last_net_balance',
        'inflow',
        'outflow',
        'net_balance',
        'net_amount',
        'type',
        'SubCategory_id',
        'unit_id',
        'Category_id',
        'Entered_by',
        'Approved_by',
        'Signed_By',

    ];

    
    /**
     * Get the user that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Unit(): BelongsTo
    {
        return $this->belongsTo(User::class, 'unit_id');
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Category_id');
    }

    public function SubCategory(): BelongsTo
    {
        return $this->belongsTo(User::class, 'SubCategory_id');
    }

    public function Approved_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Approved_by');
    }

    public function Entered_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Entered_by');

    }

    public function Signed_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Signed_By');

    }

}
