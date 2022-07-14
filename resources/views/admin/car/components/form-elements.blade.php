<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_pilot'), 'has-success': fields.id_pilot && fields.id_pilot.valid }">
    <label for="id_pilot" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.car.columns.id_pilot') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_pilot" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_pilot'), 'form-control-success': fields.id_pilot && fields.id_pilot.valid}" id="id_pilot" name="id_pilot" placeholder="{{ trans('admin.car.columns.id_pilot') }}">
        <div v-if="errors.has('id_pilot')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_pilot') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('models'), 'has-success': fields.models && fields.models.valid }">
    <label for="models" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.car.columns.models') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.models" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('models'), 'form-control-success': fields.models && fields.models.valid}" id="models" name="models" placeholder="{{ trans('admin.car.columns.models') }}">
        <div v-if="errors.has('models')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('models') }}</div>
    </div>
</div>


