@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.pilot.actions.edit', ['name' => $pilot->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <pilot-form
                :action="'{{ $pilot->resource_url }}'"
                :data="{{ $pilot->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.pilot.actions.edit', ['name' => $pilot->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.pilot.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </pilot-form>

        </div>
    
</div>

@endsection