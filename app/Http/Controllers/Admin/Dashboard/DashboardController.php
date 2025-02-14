<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMaster;
use App\Models\Device;
use App\Models\Master\Role_privilege;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MediaTrait;
use Storage;
use Crypt;
use Arr;
use Str;
use DB;
use Session;

class DashboardController extends Controller
{
    public function index(){

        $role_id = Auth::guard('master_admins')->user()->role_id;

       if($role_id=="1"||$role_id=="3"){
            $totalSiteCount=SiteMaster::where('status','active')->count();
            $totalDeviceCount=Device::where('status','!=','delete')->count();
            return view('Admin.Dashboard.index',compact('totalSiteCount','totalDeviceCount'));
       }else{
          return view('Admin.Dashboard.client_dashboard');
       }
        
       
    }
}
