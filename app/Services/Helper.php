<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

trait Helper
{
    public function errorLogger($message, $file, $line)
    {
        Log::error("Error: {$message} in {$file} on line {$line}");
    }

    public function getUser()
    {
        return auth()->user();
    }

}

