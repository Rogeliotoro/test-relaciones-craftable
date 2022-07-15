<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Mechanic\BulkDestroyMechanic;
use App\Http\Requests\Admin\Mechanic\DestroyMechanic;
use App\Http\Requests\Admin\Mechanic\IndexMechanic;
use App\Http\Requests\Admin\Mechanic\StoreMechanic;
use App\Http\Requests\Admin\Mechanic\UpdateMechanic;
use App\Models\Mechanic;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MechanicsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexMechanic $request
     * @return array|Factory|View
     */
    public function index(IndexMechanic $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Mechanic::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'number', 'id_cars'],

            // set columns to searchIn
            ['id', 'name', 'number']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.mechanic.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.mechanic.create');

        return view('admin.mechanic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMechanic $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMechanic $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Mechanic
        $mechanic = Mechanic::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/mechanics'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/mechanics');
    }

    /**
     * Display the specified resource.
     *
     * @param Mechanic $mechanic
     * @throws AuthorizationException
     * @return void
     */
    public function show(Mechanic $mechanic)
    {
        $this->authorize('admin.mechanic.show', $mechanic);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mechanic $mechanic
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Mechanic $mechanic)
    {
        $this->authorize('admin.mechanic.edit', $mechanic);


        return view('admin.mechanic.edit', [
            'mechanic' => $mechanic,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMechanic $request
     * @param Mechanic $mechanic
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMechanic $request, Mechanic $mechanic)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Mechanic
        $mechanic->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/mechanics'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/mechanics');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyMechanic $request
     * @param Mechanic $mechanic
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMechanic $request, Mechanic $mechanic)
    {
        $mechanic->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyMechanic $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMechanic $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Mechanic::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
