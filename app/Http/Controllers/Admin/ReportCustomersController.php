<?php

namespace App\Http\Controllers\Admin;

use App\Check;
use App\Http\Requests\Admin\StoreReportsRequest;
use App\Reportcustomer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class ReportCustomersController extends Controller
{
    function __construct() {

    }

    public function index()
    {
        if (! Gate::allows('check_access')) {
            return abort(401);
        }

        $txtSearch = request("txtSearch");
        $start_date = request("s_date");
        $end_date = request("e_date");

        $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
            ->where('checks.check_date', '=',date('Y-m-d'))
            ->where('users.location_id', '=', Auth::user()->location->id)
            ->whereNull('deleted_at')
            ->orderBy('checks.id','desc')
            ->get(['checks.*']);

        $checkids = join(",",$reports->sortByDesc('id')->pluck('id')->toArray());

        return view('admin.reportCustomers.index', compact('reports','txtSearch','start_date','end_date','checkids'));
    }

    public function store(StoreReportsRequest $request)
    {
        if (!Gate::allows('check_access')) {
            return abort(401);
        }

        $txtSearch = request("txtSearch");
        $start_date = request("s_date");
        $end_date = request("e_date");
        $allDate = request("allDate");

        if (!empty($txtSearch)) {
            if ($allDate === 'on') {
                $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->where('checks.customer_name', 'LIKE', "%$txtSearch%")
                    ->orWhere('checks.licence_no', 'LIKE', "%$txtSearch%")
                    ->orWhere('checks.customer_tel', 'LIKE', "%$txtSearch%")
                    ->whereNull('checks.deleted_at')
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);
            } else {
                $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->where('checks.customer_name', 'LIKE', "%$txtSearch%")
                    ->orWhere('checks.licence_no', 'LIKE', "%$txtSearch%")
                    ->orWhere('checks.customer_tel', 'LIKE', "%$txtSearch%")
                    ->whereBetween('checks.check_date', [$start_date, $end_date])
                    ->whereNull('checks.deleted_at')
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);
            }
        } else {
            if ($allDate === 'on') {
                $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->whereNull('checks.deleted_at')
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);
            } else {
                $reports = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->whereBetween('checks.check_date', [$start_date, $end_date])
                    ->whereNull('checks.deleted_at')
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);
            }
        }

        $checkids = join(",",$reports->sortByDesc('id')->pluck('id')->toArray());

        return view('admin.reportCustomers.index', compact('reports', 'txtSearch', 'start_date', 'end_date','checkids'));
    }

}
