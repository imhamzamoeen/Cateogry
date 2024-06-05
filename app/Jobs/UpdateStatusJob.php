<?php

namespace App\Jobs;

use App\Traits\StatusSigendTrait;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use StatusSigendTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $details;
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //
        try {


            $this->updateStatus($this->details);
        } catch (Exception $e) {    //
            Log::message($e->getMessage());
        }
    }
}
