<template>
    <span class="w-full">
        <span
            v-for="(permission, option) in availableOptions"
            :key="permission.option"
            :class="optionClass(permission.option)"
            :title="__(field.translation_prefix + permission.option)"
            class="inline-block rounded-full w-2 h-2 mr-1"></span>
    </span>
</template>

<script>
import {getOptionClass} from "../functions";

export default {
    props: ['resourceName', 'field'],
    computed: {
        availableOptions() {
            // eslint-disable-next-line no-console
            console.log('IndexField: availableOptions: need to replace lodash.flatmap', {options_orig: this.field.options, options_flattened: Object.values(this.field.options).flat()})
            return Array.isArray(this.field.options) ? this.field.options : Object.values(this.field.options).flat();;
        },
    },
    methods: {
        optionClass(option) {
            return getOptionClass(this.field.value, option);
        },
    },
}
</script>

<style>
</style>
