<!-- Vue component -->
<template>
    <div>
        <multiselect
                class="multiselect"
                v-model="value"
                :options="options"
                :multiple="true"
                id="username"
                autofocus
                placeholder="نام ها را وارد کنید"
                selectLabel="برای انتخاب کلیک کنید"
                deselectLabel="برای حذف کلیک کنید"
                optionsLimit="10"
        ></multiselect>
        <input type="hidden" name="username" :value="value">
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'


    export default {
        // OR register locally
        components: { Multiselect },
        props: ['options'],
        data () {
            return {
                value: null,
                options: this.options
            }
        }
    }
</script>

<style>
    .multiselect__placeholder {
        float: right;
    }
    .multiselect__select {
        position: relative;
        float: left;
        direction: ltr;
    }
    .multiselect__option {
        text-align: right;
    }
    .multiselect__tags {
        padding: 8px 8px 0 40px;
    }
</style>