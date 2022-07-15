import AppForm from '../app-components/Form/AppForm';

Vue.component('mechanic-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                number:  '' ,
                id_cars:  '' ,
                
            }
        }
    }

});