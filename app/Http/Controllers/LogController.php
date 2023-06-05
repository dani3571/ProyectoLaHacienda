<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function show()
    {
        $logFilePath = storage_path('logs/admin.log');
        $logContent = file_get_contents($logFilePath);

        return view('admin.logs.index', ['logContent' => $logContent]);
    }
}