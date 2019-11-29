<template>
    <div class="row mx-0 mt-4">
        <div class="col-12">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                {{person.fullname}}
                </strong>
            </h3>
        </div>
        <div class="col-12 mt-4">
            <p dir="rtl" class="text-right" v-html="person.description"></p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Personinfo",
        props:['person'],
    }
</script>

<style scoped>
    .persontitle{
        font-size: 16px;
        border-right: 10px solid #00e6f1;
    }

</style>
