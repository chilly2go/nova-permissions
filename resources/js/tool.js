import Tool from './components/Tool'
import IndexField from "./components/IndexField.vue";
import DetailField from "./components/DetailField.vue";
import FormField from "./components/FormField.vue";

Nova.booting((Vue, router, store) => {
    Nova.inertia('nova-permissions', Tool)

    Vue.component('index-permission-checkboxes', IndexField)
    Vue.component('detail-permission-checkboxes', DetailField)
    Vue.component('form-permission-checkboxes', FormField)
})
