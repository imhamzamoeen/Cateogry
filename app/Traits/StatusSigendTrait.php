<?php

namespace App\Traits;

use App\Models\Expense;
use App\Models\Income;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait StatusSigendTrait
{



    public function updateStatus($details)
    {

        try {
            DB::beginTransaction();
            if ($details['type'] == 'income') {
                $income = Income::find($details['id']);
                //    $previous_record=Income::where('id','<',$income->id)->first(); 
                $income->update([
                    'status' => 'signed',
                ]);
                //hmari hold wala record b theek calculate hua hota bus uska status change krna and next saron ki re calculation
                $last_balance = $income->balance;

                $next_records = income::where('id', '>', $income->id)->cursor();
                foreach ($next_records as $record) {

                    $record->update([
                        'last_balance' => $last_balance,
                        'balance' => $last_balance + $record->balance,
                    ]);

                    $last_balance = $record->balance;
                }
            } elseif ($details['type'] == 'expense') {
                $expense = Expense::find($details['id']);
                // $previous_record = Expense::where('id', '<', $expense->id)->first(); 
                $expense->update([
                    'status' => 'signed',
                ]);
                //hmari hold wala record b theek calculate hua hota bus uska status change krna and next saron ki re calculation
                $last_balance = $expense->balance;

                $next_records = Expense::where('id', '>', $expense->id)->cursor();
                foreach ($next_records as $record) {

                    $record->update([
                        'last_balance' => $last_balance,
                        'balance' => $last_balance + $record->balance,
                    ]);

                    $last_balance = $record->balance;
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            Log::message($exception->getMessage());
        }
    }
}
