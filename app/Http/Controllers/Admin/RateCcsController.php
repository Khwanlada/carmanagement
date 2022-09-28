<?php

namespace App\Http\Controllers\Admin;

use App\RateCc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRateCcsRequest;
use App\Http\Requests\Admin\UpdateRateCcsRequest;

class RateCcsController extends Controller
{
    function __construct() {

    }
    /**
     * Display a listing of RateCc.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('rateCc_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('rateCc_delete')) {
                return abort(401);
            }
            $rateCcs = RateCc::onlyTrashed()->get();
        } else {
            $rateCcs = RateCc::all();
        }

        return view('admin.rateCcs.index', compact('rateCcs'));
    }

    /**
     * Show the form for creating new RateCc.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('rateCc_create')) {
            return abort(401);
        }
        return view('admin.rateCcs.create');
    }

    /**
     * Store a newly created RateCc in storage.
     *
     * @param  \App\Http\Requests\StoreRateCcsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRateCcsRequest $request)
    {
        if (! Gate::allows('rateCc_create')) {
            return abort(401);
        }
        $rateCc = RateCc::create($request->all());

        return redirect()->route('admin.rateCcs.index');
    }

    /**
     * Show the form for editing RateCc.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('rateCc_edit')) {
            return abort(401);
        }
        $rateCc = RateCc::findOrFail($id);

        return view('admin.rateCcs.edit', compact('rateCc'));
    }

    /**
     * Update RateCc in storage.
     *
     * @param  \App\Http\Requests\UpdateRateCcsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateCcsRequest $request, $id)
    {
        if (! Gate::allows('rateCc_edit')) {
            return abort(401);
        }
        $rateCc = RateCc::findOrFail($id);
        $rateCc->update($request->all());

        return redirect()->route('admin.rateCcs.index');
    }

    /**
     * Display RateCc.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('rateCc_view')) {
            return abort(401);
        }
        $rateCc = RateCc::findOrFail($id);

        return view('admin.rateCcs.show', compact('rateCc'));
    }


    /**
     * Remove RateCc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('rateCc_delete')) {
            return abort(401);
        }
        $rateCc = RateCc::findOrFail($id);
        $rateCc->delete();

        return redirect()->route('admin.rateCcs.index');
    }

    /**
     * Delete all selected RateCc at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('rateCc_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RateCc::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore RateCc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('rateCc_delete')) {
            return abort(401);
        }
        $rateCc = RateCc::onlyTrashed()->findOrFail($id);
        $rateCc->restore();

        return redirect()->route('admin.rateCcs.index');
    }

    /**
     * Permanently delete RateCc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('rateCc_delete')) {
            return abort(401);
        }
        $rateCc = RateCc::onlyTrashed()->findOrFail($id);
        $rateCc->forceDelete();

        return redirect()->route('admin.rateCcs.index');
    }
}
