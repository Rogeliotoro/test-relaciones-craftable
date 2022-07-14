<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pilot\BulkDestroyPilot;
use App\Http\Requests\Admin\Pilot\DestroyPilot;
use App\Http\Requests\Admin\Pilot\IndexPilot;
use App\Http\Requests\Admin\Pilot\StorePilot;
use App\Http\Requests\Admin\Pilot\UpdatePilot;
use App\Models\Pilot;
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

class PilotsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPilot $request
     * @return array|Factory|View
     */
    public function index(IndexPilot $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Pilot::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'nickName'],

            // set columns to searchIn
            ['id', 'name', 'nickName']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.pilot.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.pilot.create');

        return view('admin.pilot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePilot $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePilot $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Pilot
        $pilot = Pilot::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/pilots'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/pilots');
    }

    /**
     * Display the specified resource.
     *
     * @param Pilot $pilot
     * @throws AuthorizationException
     * @return void
     */
    public function show(Pilot $pilot)
    {
        $this->authorize('admin.pilot.show', $pilot);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pilot $pilot
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Pilot $pilot)
    {
        $this->authorize('admin.pilot.edit', $pilot);


        return view('admin.pilot.edit', [
            'pilot' => $pilot,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePilot $request
     * @param Pilot $pilot
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePilot $request, Pilot $pilot)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Pilot
        $pilot->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/pilots'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/pilots');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPilot $request
     * @param Pilot $pilot
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPilot $request, Pilot $pilot)
    {
        $pilot->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPilot $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPilot $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Pilot::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
