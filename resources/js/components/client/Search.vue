<template>
    <div class="row mx-0 mb-1 position-relative">
        <input type="text" class="form-control form-control-sm mysearch" v-model="searchtext" placeholder="نام کتاب ، نویسنده ، مترجم و یا ناشر مورد نظر را جستجو کنید...">
        <a :href="'/search/'+ searchtext" class="searchbtn btn btn-primary btn-sm text-white">جستجو</a>
    </div>
</template>

<script>
    export default {
        name: "Search",
        data(){
            return{
                searchtext: null,
            }
        }
    }
</script>

<style scoped>
    .mysearch{
        background-color: #c8fff6a8;
    }
    .searchbtn{
        position: absolute;
        top: 1px;
        left: 1px;
        cursor: pointer;
    }

</style>
