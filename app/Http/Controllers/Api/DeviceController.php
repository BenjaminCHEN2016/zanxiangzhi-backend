<?php
/**
 * Created by PhpStorm.
 * User: Dizy
 * Date: 2018/5/17
 * Time: 22:23
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DeviceController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    public function getStatus(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);
        $id = $request->input("id");
        $device = $this->getDevice($id);
        return s("ok", [
            'status' => $device->status,
            'last_active' => $device->last_active
        ]);
    }

    public function getDevice(int $id)
    {
        $redis = Redis::connection('device');
        $device = $redis->get('device:' . $id);
        $device = json_decode($device);
        return $device;
    }

    public function getDevicesByLocationId(Request $request){
        $this->validate($request, [
            'location_id' => 'required|integer'
        ]);
        $location_id = $request->input("location_id");
        $devices = (new Device())->where('location_id','=', $location_id)->orderBy('floor')->get();
        return $devices;
    }
}