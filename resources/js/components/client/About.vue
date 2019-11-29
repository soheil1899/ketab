<template>
    <div class="row mx-0 mt-4 justify-content-center">
        <div class="col-12">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    درباره ما
                </strong>
            </h3>
        </div>
        <div class="col-8 mt-4">
            <img src="/media/slider/original_31912.png" width="100%">
        </div>
        <div class="col-12 mt-4">
            <p dir="rtl" class="text-right" v-html="setting.aboutus"></p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "About",
        props: ['setting'],
    }
</script>

<style scoped>

</style>
