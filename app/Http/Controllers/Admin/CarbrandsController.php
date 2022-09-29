<?php

namespace App\Http\Controllers\Admin;

use App\Carbrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarbrandsRequest;
use App\Http\Requests\Admin\UpdateCarbrandsRequest;

class CarbrandsController extends Controller
{
    function __construct() {

    }
    /**
     * Display a listing of Carbrand.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('carbrand_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('carbrand_delete')) {
                return abort(401);
            }
            $carbrands = Carbrand::onlyTrashed()->get();
        } else {
            $carbrands = Carbrand::all();
        }

        return view('admin.carbrands.index', compact('carbrands'));
    }

    /**
     * Show the form for creating new Carbrand.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('carbrand_create')) {
            return abort(401);
        }
        return view('admin.carbrands.create');
    }

    /**
     * Store a newly created Carbrand in storage.
     *
     * @param  \App\Http\Requests\StoreCarbrandsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarbrandsRequest $request)
    {
        if (! Gate::allows('carbrand_create')) {
            return abort(401);
        }
        $carbrand = Carbrand::create($request->all());

        return redirect()->route('admin.carbrands.index');
    }

    /**
     * Show the form for editing Carbrand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('carbrand_edit')) {
            return abort(401);
        }
        $carbrand = Carbrand::findOrFail($id);

        return view('admin.carbrands.edit', compact('carbrand'));
    }

    /**
     * Update Carbrand in storage.
     *
     * @param  \App\Http\Requests\UpdateCarbrandsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarbrandsRequest $request, $id)
    {
        if (! Gate::allows('carbrand_edit')) {
            return abort(401);
        }
        $carbrand = Carbrand::findOrFail($id);
        $carbrand->update($request->all());

        return redirect()->route('admin.carbrands.index');
    }

    /**
     * Display Carbrand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('carbrand_view')) {
            return abort(401);
        }
        $carbrand = Carbrand::findOrFail($id);

        return view('admin.carbrands.show', compact('carbrand'));
    }

    /**
     * Remove Carbrand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('carbrand_delete')) {
            return abort(401);
        }
        $carbrand = Carbrand::findOrFail($id);
        $carbrand->delete();

        return redirect()->route('admin.carbrands.index');
    }

    /**
     * Delete all selected Carbrand at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('carbrand_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Carbrand::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Carbrand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('carbrand_delete')) {
            return abort(401);
        }
        $carbrand = Carbrand::onlyTrashed()->findOrFail($id);
        $carbrand->restore();

        return redirect()->route('admin.carbrands.index');
    }

    /**
     * Permanently delete Carbrand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('carbrand_delete')) {
            return abort(401);
        }
        $carbrand = Carbrand::onlyTrashed()->findOrFail($id);
        $carbrand->forceDelete();

        return redirect()->route('admin.carbrands.index');
    }
}
