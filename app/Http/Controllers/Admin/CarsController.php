<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Car\BulkDestroyCar;
use App\Http\Requests\Admin\Car\DestroyCar;
use App\Http\Requests\Admin\Car\IndexCar;
use App\Http\Requests\Admin\Car\StoreCar;
use App\Http\Requests\Admin\Car\UpdateCar;
use App\Models\Car;
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

class CarsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCar $request
     * @return array|Factory|View
     */
    public function index(IndexCar $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Car::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'id_pilot', 'models'],

            // set columns to searchIn
            ['id', 'models']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.car.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.car.create');

        return view('admin.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCar $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCar $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Car
        $car = Car::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/cars'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param Car $car
     * @throws AuthorizationException
     * @return void
     */
    public function show(Car $car)
    {
        $this->authorize('admin.car.show', $car);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Car $car
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Car $car)
    {
        $this->authorize('admin.car.edit', $car);


        return view('admin.car.edit', [
            'car' => $car,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCar $request
     * @param Car $car
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCar $request, Car $car)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Car
        $car->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/cars'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCar $request
     * @param Car $car
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCar $request, Car $car)
    {
        $car->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCar $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCar $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Car::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
