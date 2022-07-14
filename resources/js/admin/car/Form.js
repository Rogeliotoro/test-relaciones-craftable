import AppForm from '../app-components/Form/AppForm';

Vue.component('car-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                id_pilot:  '' ,
                models:  '' ,
                
            }
        }
    }

});