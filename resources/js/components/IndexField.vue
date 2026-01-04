<template>
    <span class="w-full">
        <span
            v-for="(permission, option) in availableOptions"
            :key="permission.option"
            :class="optionClass(permission.option)"
            :title="permission.label"
            class="inline-block rounded-full w-2 h-2 mr-1"></span>
    </span>
</template>

<script>
import {getOptionClass} from "../functions";

export default {
    props: ['resourceName', 'field'],
    computed: {
        availableOptions() {
            return Array.isArray(this.field.options) ? this.field.options : Object.values(this.field.options).flat();
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
