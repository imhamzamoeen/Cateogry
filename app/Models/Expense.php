<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'total_amount',
        'share_amount',
        'net_expense',
        'share_by',
        'last_balance',
        'balance',
        'SubCategory_id',
        'unit_id',
        'Category_id',
        'added_by',
        'description',
        'status',

    ];

    protected static function boot()
    {
        parent::boot();
        Expense::creating(function ($model) {
            $last_record = Expense::where('status', '!=', 'hold')->latest()->first();        //get last status that is not at hold and belongs to logged in user
            $model->net_expense = $model->total_amount + $model->share_amount;         //net income = total amount - any shared amount
            if (is_null($last_record)) {
                $model->last_balance = 0;         //if it's first record set it zero
            } else {
                $model->last_balance = $last_record->balance;         //if it's first record set it zero
            }
            $model->balance = $model->net_expense + $model->last_balance;         //total balance = net income + last balance 

            $model->added_by = Auth::user()->id;
            
        });
    }

    /**
     * Get the user that owns the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'Category_id');
    }

    public function SubCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'SubCategory_id');
    }

    public function AddedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
