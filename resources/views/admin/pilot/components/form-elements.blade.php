<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.pilot.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.pilot.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nickName'), 'has-success': fields.nickName && fields.nickName.valid }">
    <label for="nickName" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.pilot.columns.nickName') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nickName" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nickName'), 'form-control-success': fields.nickName && fields.nickName.valid}" id="nickName" name="nickName" placeholder="{{ trans('admin.pilot.columns.nickName') }}">
        <div v-if="errors.has('nickName')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nickName') }}</div>
    </div>
</div>


