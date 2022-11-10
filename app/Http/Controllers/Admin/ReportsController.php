<?php

namespace App\Http\Controllers\Admin;

use App\Check;
use App\Http\Requests\Admin\StoreReportsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    function __construct() {

    }

    public function index()
    {
        if (! Gate::allows('check_access')) {
            return abort(401);
        }
        $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
            ->where('checks.check_date', '=',date('Y-m-d'))
            ->where('users.location_id', '=', Auth::user()->location->id)
            ->orderBy('checks.car_type_id','desc')
            ->get(['checks.*']);

        $typeId = request("type");
        $start_date = request("s_date");
        $end_date = request("e_date");

        return view('admin.reportChecks.index', compact('reports','typeId','start_date','end_date'));
    }

    public function store(StoreReportsRequest $request)
    {
        if (! Gate::allows('check_access')) {
            return abort(401);
        }
        $input = $request->all();

        $typeId = $input["type"];
        $start_date = request("s_date");
        $end_date = request("e_date");

        if(!empty($typeId)){
            $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                ->where('users.location_id', '=', Auth::user()->location->id)
                ->where('checks.car_type_id', '=',  $typeId)
                ->whereBetween('checks.check_date', [$start_date, $end_date])
                ->orderBy('checks.car_type_id','desc')
                ->get(['checks.*']);

        }else{
            $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                ->where('users.location_id', '=', Auth::user()->location->id)
                ->whereBetween('checks.check_date', [$start_date, $end_date])
                ->orderBy('checks.car_type_id','desc')
                ->get(['checks.*']);
        }

        return view('admin.reportChecks.index', compact('reports','typeId','start_date','end_date'));
    }

}
