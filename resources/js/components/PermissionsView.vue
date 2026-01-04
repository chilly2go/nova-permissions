<script>
import {getOptionClass} from "../functions";
import PermissionCheckbox from "./PermissionCheckbox.vue";

export default {
    components: {PermissionCheckbox},
    props: {
        'field': {type: Object, required: true},
        'edit': {type: Boolean, required: false, default: false},
        'modelValue': {type: Array, required: false, default: []}
    },
    emits: ['update:modelValue'],
    data() {
        return {
            activeItem: null,
        }
    },
    computed: {
        permissions() {
            return this.field.options[this.activeItem] ?? [];
        }
    },
    methods: {
        optionClass(option) {
            return getOptionClass(this.field.value, option)
        },
        handleGroupToggle(group) {
            let res = null;
            if (!this.activeItem || this.activeItem !== group) {
                res = group;
            }
            this.activeItem = res;
            Nova.$emit('activeItem', this.activeItem)
        },
        isChecked(option) {
            console.log('isChecked', {
                modelValueIsArray: Array.isArray(this.modelValue),
                option,
                included: this.modelValue.includes(option)
            })
            return (this.modelValue && Array.isArray(this.modelValue)) ? this.modelValue.includes(option) : false;
        },
        permissionChanged(evt){
            console.log('permissionChanged', evt);
            this.$emit('update:model-value', evt);
        },
    },
    mounted() {
        Nova.$on('toggleGroup', this.handleGroupToggle)
        console.log('PermissionsView mounted', this.modelValue)
    }
}
</script>

<template>
    <div
        class="px-2 py-2 border-l">
        <template v-if="edit">
            <div class="">
                <div
                    v-for="(permission, option) in permissions"
                    :key="permission.option"
                    class="px-1 py-1 items-center flex gap-2"
                >
                    <PermissionCheckbox :permission="permission" :modelValue="modelValue" @update:modelValue="permissionChanged"/>
                </div>
            </div>
        </template>
        <template v-else>
            <div
                v-for="(permission, option) in permissions"
                :key="option"
                class="flex-auto"
            >
            <span
                class="inline-block rounded-full w-2 h-2"
                :class="optionClass(permission.option)"></span>
                <span>&nbsp;{{ permission.label }}</span>
            </div>
        </template>
    </div>
</template>

<style scoped>

</style>
