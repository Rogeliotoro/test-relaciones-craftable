<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.mechanic.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.mechanic.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('number'), 'has-success': fields.number && fields.number.valid }">
    <label for="number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.mechanic.columns.number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('number'), 'form-control-success': fields.number && fields.number.valid}" id="number" name="number" placeholder="{{ trans('admin.mechanic.columns.number') }}">
        <div v-if="errors.has('number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_cars'), 'has-success': fields.id_cars && fields.id_cars.valid }">
    <label for="id_cars" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.mechanic.columns.id_cars') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_cars" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_cars'), 'form-control-success': fields.id_cars && fields.id_cars.valid}" id="id_cars" name="id_cars" placeholder="{{ trans('admin.mechanic.columns.id_cars') }}">
        <div v-if="errors.has('id_cars')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_cars') }}</div>
    </div>
</div>


