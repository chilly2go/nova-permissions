<script>
export default {
    props: {
        'permission': {type: Object, required: true},
        'modelValue': {type: Array, required: false, default: []}
    },
    computed: {
        isChecked() {
            console.log('isChecked', {
                modelValueIsArray: Array.isArray(this.modelValue),
                option: this.permission.option,
                included: this.modelValue.includes(this.permission.option)
            })
            return (this.modelValue && Array.isArray(this.modelValue)) ? this.modelValue.includes(this.permission.option) : false;
        }
    },
    methods: {
        toggleOption(option) {
            if (this.isChecked) {
                return this.uncheck();
            }
            this.check();
        },
        check() {
            this.$emit('update:modelValue', [...this.modelValue, this.permission.option]);
        },
        uncheck() {
            this.$emit('update:modelValue', this.modelValue.filter((item) => item !== this.permission.option));
        }
    }
}

</script>

<template>
    <div class="inline-flex w-full gap-2 items-center">
        <checkbox
            :value="permission.option"
            :checked="isChecked"
            @input="toggleOption()"
            class="pr-2"
        ></checkbox>
        <label
            :for="permission.option"
            class="w-full inline-block"
            @click="toggleOption()"
        >
            {{ permission.label }}
        </label>
    </div>
</template>

<style scoped>

</style>
