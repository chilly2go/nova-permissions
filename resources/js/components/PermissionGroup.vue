<script>
import {getOptionClass} from "../functions";

export default {
    props: ['group', 'permissions', 'value'],
    data() {
        return {
            activeItem: null
        }
    },
    methods: {
        showItem(group) {
            Nova.$emit('toggleGroup', group)
        },
        optionClass(option) {
            return getOptionClass(this.value, option)
        },
    },
    mounted() {
        Nova.$on('activeItem', (value) => this.activeItem = value)
    }

}
</script>

<template>
    <div class="mb-2 pl-2">
        <div class="cursor-pointer flex items-center px-2 py-2 rounded-lg" @click="showItem(group)">
            <div class="w-full flex items-center">
                <h3 class="capitalize flex-1">{{ group }}</h3>
                <div class="flex flex-wrap">
                    <div
                        v-for="(permission, option) in permissions"
                        :key="permission.option"
                        class="pr-2"
                    >
                        <span class="inline-block rounded-full w-2 h-2" :class="optionClass(permission.option)"></span>
                    </div>
                </div>
            </div>
            <div class="ml-auto">
                <span class="font-bold text-xl" v-if="activeItem === group">&minus;</span>
                <span class="font-bold text-xl" v-else>&plus;</span>
            </div>
        </div>


    </div>
</template>

<style scoped>

</style>
