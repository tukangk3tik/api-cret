<?php

namespace App\Http\Middleware;

use App\Services\DeviceService;
use Closure;
use Illuminate\Http\Request;

class DeviceRegisteredCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $macAddr = $request->mac_address;

        $device = DeviceService::getKodeUnitDevice($macAddr);
        if ($device == null) {
            return response()->json(['status' => 'fail', 'data' => [], 'message' => 'Device tidak terdaftar'], 200);
        }

        $request->kode_unit = $device->kodeunit;
        $request->id_device = $device->id;

        return $next($request);
    }
}
