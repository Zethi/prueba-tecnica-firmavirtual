<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class HealthCheckController extends Controller
{
    public function check(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
            $dbStatus = 'OK';
        } catch (\Exception $exception) {
            $dbStatus = 'FAIL';
        }

        $status = [
            'database' => $dbStatus,
        ];

        $httpStatusCode = ($dbStatus === 'OK') ? 200 : 500;

        return response()->json($status, $httpStatusCode);
    }
}
