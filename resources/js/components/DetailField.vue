<template>
    <PanelItem :field="field" :index="index">
        <template #value>
            <div class="flex flex-wrap">
                <div
                    v-for="(permissions, group) in field.options"
                    :key="group"
                    class="mb-2 pl-2 w-1/2"
                >
                    <div class="cursor-pointer flex items-center px-2 py-2 bg-40 rounded-lg" @click="showItem(group)">
                        <div class="w-full flex items-center">
                            <h3 class="capitalize flex-1">{{ group }}</h3>
                            <div class="flex flex-wrap">
                                <div
                                    v-for="(permission, option) in permissions"
                                    :key="option"
                                    class="pr-2"
                                >
                                    <span class="inline-block rounded-full w-2 h-2"
                                          :class="optionClass(permission.option)"></span>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <span class="font-bold text-xl" v-if="activeItem === group">&minus;</span>
                            <span class="font-bold text-xl" v-else>&plus;</span>
                        </div>
                    </div>

                    <div v-if="activeItem === group"
                         class="w-1/3 bg-white shadow dark:bg-gray-800 px-2 py-2 border-l border-r border-b border-50 rounded-b-lg absolute z-50">
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
                    </div>
                </div>
                <!--                                <PermissionGroup-->
                <!--                                    v-for="(permissions, group) in field.options"-->
                <!--                                    :key="group" :activeItem="activeItem"-->
                <!--                                    :group="group" :permissions="[permissions]"-->
                <!--                                >-->
                <!--                </PermissionGroup>-->

            </div>
        </template>
    </PanelItem>
</template>

<script>

import {getOptionClass} from "../functions";

export default {
    props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
    data() {
        return {
            activeItem: null,
        }
    },
    methods: {
        showItem(group) {
            if (!this.activeItem) {
                this.activeItem = group
            } else if (this.activeItem !== group) {
                this.activeItem = group
            } else {
                this.activeItem = null
            }
            // eslint-disable-next-line no-console
            console.log('showItem: ', this.activeItem);
        },
        optionClass(option) {
            return getOptionClass(this.field.value, option);
        },
        fixNaming (name) {
            if (!name) return 'fixNaming-empty';
            if (name.includes("_") === true) {
                name = name.replace('_', ' ')
            }
            if (name.includes("-") === true) {
                name = name.replace('-', ' ')
            }
            return name
        }
    },
    mounted() {
        // eslint-disable-next-line no-console
        console.log('Mounted DetailField component', this.field, this.index);
    }
}
</script>
