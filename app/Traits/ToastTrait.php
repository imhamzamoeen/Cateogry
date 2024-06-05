<?php

namespace App\Traits;

trait ToastTrait
{
    public function sendSuccess($message, $heading = "Success Notification")
    {
        $this->emit('toast', 'success', $heading, $message . " ✔️");
    }

    public function sendError($message, $heading = "Error Notification")
    {
        $this->emit('toast', 'error', $heading, $message . " ❌");
    }

    public function sendInfo($message, $heading = "Info Notification")
    {
        $this->emit('toast', 'info', $heading, $message . " ❕");
    }

    public function sendException($exception, $heading = "Exception Notification")
    {
        $this->emit('toast', 'error', $heading, $exception->errorInfo[2] ?? $exception->getMessage() .  " ❌");
    }
}
