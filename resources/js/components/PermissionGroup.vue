<script>
import {getOptionClass} from "../functions";

export default {
    props: ['group', 'permissions', 'activeItem'],
    emits: ['update:activeItem'],
    data() {
    },
    methods: {
        showItem(group) {
            let res = null;
            if(!this.activeItem || this.activeItem !== group) {
                this.$emit('update:activeItem', group)
                res = group;
            }
            else {
                this.$emit('update:activeItem', null)
            }
            // eslint-disable-next-line no-console
            console.log('updated activeItem', res, this.group)
        },
        optionClass(option) {
            return getOptionClass(this.field.value, option)
        },
        fixNaming: (name) => {
            if(!name) return 'fixNaming-empty';
            if(name.includes("_") === true) {
                name = name.replace('_', ' ')
            }
            if(name.includes("-") === true) {
                name = name.replace('-', ' ')
            }
            return name
        }
    },
    watch: {
        activeItem(oldVal, newVal){
            // eslint-disable-next-line no-console
            console.log('active item changed', {oldVal, newVal})
        }
    },
    mounted() {
        // eslint-disable-next-line no-console
        console.log('PermissionGroup mounted', this.group, this.permissions)
    }

}
</script>

<template>
    <div class="mb-2 pl-2 w-1/2">
        <div class="cursor-pointer flex items-center px-2 py-2 bg-40 rounded-lg" @click="showItem(group)">
            <div class="w-full flex items-center">
                <h3 class="capitalize flex-1">{{ fixNaming(group) }}</h3>
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

        <div v-show="activeItem === group"
             class="w-1/3 bg-20 px-2 py-2 border-l border-r border-b border-50 rounded-b-lg absolute z-50">
            <div
                v-for="(permission, option) in permissions"
                :key="option"
                class="flex-auto"
            >
                <span
                    class="inline-block rounded-full w-2 h-2"
                    :class="optionClass(permission.option)"></span>
                <span>{{ fixNaming(permission.label) }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
