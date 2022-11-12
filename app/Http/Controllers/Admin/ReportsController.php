<?php

namespace App\Http\Controllers\Admin;

use App\Check;
use App\Http\Requests\Admin\StoreReportsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $expireDay = "";
        return view('admin.reportChecks.index', compact('reports','typeId','start_date','end_date','expireDay'));
    }

    public function store(StoreReportsRequest $request)
    {
        if (! Gate::allows('check_access')) {
            return abort(401);
        }
        $input = $request->all();

        $typeId = $input["type"];
        $expireDay = request("expireDay");
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

        return view('admin.reportChecks.index', compact('reports','typeId','start_date','end_date','expireDay'));
    }

    public function ajaxRequestPost(Request $request)
    {
        $sms = $request->json()->get('sms');
        $tel = $request->json()->get('tel');

        $client = new \GuzzleHttp\Client();
        
        $response = $client->request('POST', 'https://api-v2.thaibulksms.com/sms', [
          'form_params' => [
            'msisdn' =>  $tel,
            'message' => $sms ,
            'sender' => 'Demo'
          ],
          'headers' => [
            'accept' => 'application/json',
            'authorization' => 'Basic S1FBWFVxLWxRZFBlcDY5MmJKaU9mcVk3WU1mdzFYOnpSMkt0aTdDNUVrSTFKUFJ5ZTlEREMxdjhxVFhJZA==',
            'content-type' => 'application/x-www-form-urlencoded',
          ],
        ]);
        
        return $response->getBody();

    }

}
