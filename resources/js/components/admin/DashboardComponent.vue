<template>
    <div class="row" id="dashboard">
        <div class="col-12 mb-4 mb-lg-0">
            <div class="row mt-3 mt-md-0">
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/user'">
                            <i class="fas fa-users fa-3x mb-2 d-block"></i>
                            کاربران
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/category'">
                            <i class="fas fa-sitemap fa-3x mb-2 d-block"></i>
                            دسته بندی
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/book'">
                            <i class="fas fa-book fa-3x mb-2 d-block"></i>
                            مدیریت کتب
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/translate'">
                            <i class="fas fa-globe-americas fa-3x mb-2 d-block"></i>
مترجمان
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/writer'">
                            <i class="fas fa-feather-alt fa-3x mb-2 d-block"></i>
نویسندگان
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/nasher'">
                            <i class="far fa-newspaper fa-3x mb-2 d-block"></i>
ناشران
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/slider'">
                            <i class="far fa-image fa-3x mb-2 d-block"></i>
اسلایدر سایت
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-3 box-item py-3 px-4 text-center">
                    <div >
                        <a class="py-4" :href="'/dashboard/setting'">
                            <i class="fas fa-tools fa-3x mb-2 d-block"></i>
تنظیمات سایت
                        </a>
                    </div>
                </div>


            </div>

        </div>


    </div>
</template>

<script>
    export default {
        name: "DashboardComponent",


        data() {
            return {
                userflag: false,
                storeflag: false,
                writeflag: false,
            }
        },

        methods: {},

        mounted() {
        }
    }
</script>

<style scoped>

    #dashboard .box-item > div {
        border-radius: 5px;
        box-shadow: 0 0 10px 2px #ccc;
        background-color: #fcfcfc;
    }
    #dashboard .box-item > div:hover {
        box-shadow: 0 0 10px 2px #e76e73;
        background-color: #fc787e;
    }
    #dashboard .box-item > div:hover a{
        color: #fff;
    }
    #dashboard .box-item a {
        text-decoration: none;
        display: block;
    }

</style>
