<?php

namespace App\Http\Controllers\Admin;

use App\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreChecksRequest;
use App\Http\Requests\Admin\UpdateChecksRequest;

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
        }

        return view('admin.checks.index');
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

        $provinces = json_decode(file_get_contents("https://raw.githubusercontent.com/kongvut/thai-province-data/master/api_province.json"), true);
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
