<?php

namespace App\Http\Controllers\Admin;

use App\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChecksRequest;
use App\Http\Requests\Admin\UpdateChecksRequest;
use Illuminate\Support\Facades\Auth;

class ChecksController extends Controller
{
    function __construct() {

    }
    /**
     * Display a listing of Check.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('check_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (!Gate::allows('check_delete')) {
                return abort(401);
            }
            $checks = Check::onlyTrashed()->get();
        } else {
            $start_date = request("s_date");
            if (!empty($start_date)) {
                $checks = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('checks.check_date', '=', $start_date)
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);

            } else {
                $checks = Check::join('users', 'users.email', '=', 'checks.create_by')
                    ->where('checks.check_date', '=',date('Y-m-d'))
                    ->where('users.location_id', '=', Auth::user()->location->id)
                    ->orderBy('checks.id','desc')
                    ->get(['checks.*']);
            }
        }

        //echo($checks);

        return view('admin.checks.index', compact('checks'));
    }

    /**
     * Show the form for creating new Check.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('check_create')) {
            return abort(401);
        }

        $provinces = json_decode(file_get_contents(env('PROVINCE_API_URL')), true);
        return view('admin.checks.create',compact("provinces"));
    }

    /**
     * Store a newly created Check in storage.
     *
     * @param  \App\Http\Requests\StoreChecksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChecksRequest $request)
    {  
        if (! Gate::allows('check_create')) {
            return abort(401);
        }

        $input = $request->all();
        $input["legalEntity"] = isset($input["legalEntity"]) ? 1 : 0;
        $input["ngvcng"] = isset($input["ngvcng"]) ? 1 : 0;
        $input["hybrid"] = isset($input["hybrid"]) ? 1 : 0;
        $input["israte"] = isset($input["israte"]) ? 1 : 0;
        $input["ispercen_discount"] = isset($input["ispercen_discount"]) ? 1 : 0;
        $input["isinspection"] = isset($input["isinspection"]) ? 1 : 0;
        $input["ispercen_late"] = isset($input["ispercen_late"]) ? 1 : 0;
        //
        $input["istax_car_service"] = isset($input["istax_car_service"]) ? 1 : 0;
        $input["is_product_cmi"] = isset($input["is_product_cmi"]) ? 1 : 0;
        $input["is_product_vmi"] = isset($input["is_product_vmi"]) ? 1 : 0;
        $input["isother_service"] = isset($input["isother_service"]) ? 1 : 0;
        $input["isother_service2"] = isset($input["isother_service2"]) ? 1 : 0;
        $input["isother_service3"] = isset($input["isother_service3"]) ? 1 : 0;
        $input["isCopyBook"] = isset($input["isCopyBook"]) ? 1 : 0;

        $input["iscmi_service"] = isset($input["iscmi_service"]) ? 1 : 0;

        //dd($input);

        $check = Check::create($input);

        return redirect()->route('admin.checks.index');
    }

    /**
     * Show the form for editing Check.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('check_edit')) {
            return abort(401);
        }

        return view('admin.checks.edit');
    }

    /**
     * Update Check in storage.
     *
     * @param  \App\Http\Requests\UpdateChecksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChecksRequest $request, $id)
    {
        if (! Gate::allows('check_edit')) {
            return abort(401);
        }

        return redirect()->route('admin.checks.index');
    }

    /**
     * Display Check.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('check_view')) {
            return abort(401);
        }
        $check = Check::findOrFail($id);

        return view('admin.checks.show', compact('check'));
    }

    /**
     * Remove Check from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('check_delete')) {
            return abort(401);
        }
        $check = Check::findOrFail($id);
        $check->delete();

        return redirect()->route('admin.checks.index');
    }

    /**
     * Delete all selected Check at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('check_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Check::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Check from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('check_delete')) {
            return abort(401);
        }
        $check = Check::onlyTrashed()->findOrFail($id);
        $check->restore();

        return redirect()->route('admin.checks.index');
    }

    /**
     * Permanently delete Check from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('check_delete')) {
            return abort(401);
        }
        $check = Check::onlyTrashed()->findOrFail($id);
        $check->forceDelete();

        return redirect()->route('admin.checks.index');
    }
}
