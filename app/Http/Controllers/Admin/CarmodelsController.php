<?php

namespace App\Http\Controllers\Admin;

use App\Carbrand;
use App\Carmodel;
use App\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarmodelsRequest;
use App\Http\Requests\Admin\UpdateCarmodelsRequest;

class CarmodelsController extends Controller
{
    function __construct() {

    }
    /**
     * Display a listing of Carmodel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('carmodel_access')) {
            return abort(401);
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('carmodel_delete')) {
                return abort(401);
            }
            $carmodels = Carmodel::onlyTrashed()->get();
        } else {
            $carmodels = Carmodel::all()->sortByDesc("id")->take(100);
        }

        return view('admin.carmodels.index', compact('carmodels'));
    }

    /**
     * Show the form for creating new Carmodel.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('carmodel_create')) {
            return abort(401);
        }
        $carbrands = Carbrand::all()->sortBy('name')->pluck('name', 'id');

        return view('admin.carmodels.create', compact('carbrands'));
    }

    /**
     * Store a newly created Carmodel in storage.
     *
     * @param  \App\Http\Requests\StoreCarmodelsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarmodelsRequest $request)
    {
        if (! Gate::allows('carmodel_create')) {
            return abort(401);
        }
        $carmodel = Carmodel::create($request->all());

        return redirect()->route('admin.carmodels.index');
    }

    /**
     * Show the form for editing Carmodel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('carmodel_edit')) {
            return abort(401);
        }
        $carmodel = Carmodel::findOrFail($id);
        $carbrands = Carbrand::all()->sortBy('name')->pluck('name', 'id');

        return view('admin.carmodels.edit', compact('carmodel','carbrands'));
    }

    /**
     * Update Carmodel in storage.
     *
     * @param  \App\Http\Requests\UpdateCarmodelsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarmodelsRequest $request, $id)
    {
        if (! Gate::allows('carmodel_edit')) {
            return abort(401);
        }
        $carmodel = Carmodel::findOrFail($id);
        $carmodel->update($request->all());

        return redirect()->route('admin.carmodels.index');
    }

    /**
     * Display Carmodel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('carmodel_view')) {
            return abort(401);
        }
        $carmodel = Carmodel::findOrFail($id);

        return view('admin.carmodels.show', compact('carmodel'));
    }

    /**
     * Remove Carmodel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('carmodel_delete')) {
            return abort(401);
        }
        $carmodel = Carmodel::findOrFail($id);
        $carmodel->delete();

        return redirect()->route('admin.carmodels.index');
    }

    /**
     * Delete all selected Carmodel at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('carmodel_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Carmodel::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Carmodel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('carmodel_delete')) {
            return abort(401);
        }
        $carmodel = Carmodel::onlyTrashed()->findOrFail($id);
        $carmodel->restore();

        return redirect()->route('admin.carmodels.index');
    }

    /**
     * Permanently delete Carmodel from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('carmodel_delete')) {
            return abort(401);
        }
        $carmodel = Carmodel::onlyTrashed()->findOrFail($id);
        $carmodel->forceDelete();

        return redirect()->route('admin.carmodels.index');
    }
}
