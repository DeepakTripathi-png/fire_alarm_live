<?php

namespace App\Http\Controllers\Admin\Alarm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarm;
use Carbon\Carbon;
use App\Models\Master\Role_privilege;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MediaTrait;
use App\Models\IOSlave;
use App\Models\AssignSiteToCustomer;
use App\Models\AssignDeviceToSite;


class AlarmController extends Controller
{

    public function getAlarmsTriggeredInLastMinute()
    {

       
        $user= Auth::guard('master_admins')->user();

        if($user->role_id == 1 || $user->role_id == 3){
            $oneMinuteAgo = Carbon::now()->subMinute();

            $alarms = Alarm::where('alarm_status', 'active')
                    ->where('last_triggered_at', '>=', $oneMinuteAgo)
                    ->get();
                    
            return response()->json($alarms);
        }elseif($user->role_id == 4 || $user->role_id == 5){

            $roleCheck = ($user->role_id == 4) ? $user->id : $user->created_by;

            $assignedSite = AssignSiteToCustomer::where('customer_id', $roleCheck)
                ->where('status', 'active')
                ->pluck('site_id')
                ->toArray();

            $assignedDevice = AssignDeviceToSite::where('status', 'active')
                ->whereIn('site_id', $assignedSite)
                ->pluck('device_id')
                ->toArray();

            $ioSlaves = IOSlave::where('status', 'active')
                ->whereIn('master_device_id', $assignedDevice)
                ->pluck('id')
                ->toArray();

            $oneMinuteAgo = Carbon::now()->subMinute();

            $alarms = Alarm::where('alarm_status', 'active')->whereIn('ioslave_id', $ioSlaves)
                    ->where('last_triggered_at', '>=', $oneMinuteAgo)
                    ->get();
                    
            return response()->json($alarms);

        }

      
    }
    


}
