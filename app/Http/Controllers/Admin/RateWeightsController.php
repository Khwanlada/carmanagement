<?php

namespace App\Http\Controllers\Admin;

use App\RateWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRateWeightsRequest;
use App\Http\Requests\Admin\UpdateRateWeightsRequest;

class RateWeightsController extends Controller
{
    function __construct() {

    }
    /**
     * Display a listing of RateWeight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('rateWeight_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('rateWeight_delete')) {
                return abort(401);
            }
            $rateWeights = RateWeight::onlyTrashed()->get();
        } else {
            $rateWeights = RateWeight::all();
        }

        return view('admin.rateWeights.index', compact('rateWeights'));
    }

    /**
     * Show the form for creating new RateWeight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('rateWeight_create')) {
            return abort(401);
        }
        return view('admin.rateWeights.create');
    }

    /**
     * Store a newly created RateWeight in storage.
     *
     * @param  \App\Http\Requests\StoreRateWeightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRateWeightsRequest $request)
    {
        if (! Gate::allows('rateWeight_create')) {
            return abort(401);
        }
        $rateWeight = RateWeight::create($request->all());

        return redirect()->route('admin.rateWeights.index');
    }

    /**
     * Show the form for editing RateWeight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('rateWeight_edit')) {
            return abort(401);
        }
        $rateWeight = RateWeight::findOrFail($id);

        return view('admin.rateWeights.edit', compact('rateWeight'));
    }

    /**
     * Update RateWeight in storage.
     *
     * @param  \App\Http\Requests\UpdateRateWeightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateWeightsRequest $request, $id)
    {
        if (! Gate::allows('rateWeight_edit')) {
            return abort(401);
        }
        $rateWeight = RateWeight::findOrFail($id);
        $rateWeight->update($request->all());

        return redirect()->route('admin.rateWeights.index');
    }

    /**
     * Display RateWeight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('rateWeight_view')) {
            return abort(401);
        }
        $rateWeight = RateWeight::findOrFail($id);

        return view('admin.rateWeights.show', compact('rateWeight'));
    }

    /**
     * Remove RateWeight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('rateWeight_delete')) {
            return abort(401);
        }
        $rateWeight = RateWeight::findOrFail($id);
        $rateWeight->delete();

        return redirect()->route('admin.rateWeights.index');
    }

    /**
     * Delete all selected RateWeight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('rateWeight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RateWeight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore RateWeight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('rateWeight_delete')) {
            return abort(401);
        }
        $rateWeight = RateWeight::onlyTrashed()->findOrFail($id);
        $rateWeight->restore();

        return redirect()->route('admin.rateWeights.index');
    }

    /**
     * Permanently delete RateWeight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('rateWeight_delete')) {
            return abort(401);
        }
        $rateWeight = RateWeight::onlyTrashed()->findOrFail($id);
        $rateWeight->forceDelete();

        return redirect()->route('admin.rateWeights.index');
    }
}
