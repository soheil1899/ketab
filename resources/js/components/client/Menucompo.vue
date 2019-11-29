<template>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-lg-5">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto pr-lg-5 text-right pr-2 pt-2 pt-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link" href="/">خانه</a>
                </li>
                <li class="nav-item px-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        دسته بندی
                    </a>
                    <div class="dropdown-menu bg-dark text-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white font12" :href="mya('books','',cat.id,cat.title)" v-for="cat in category">{{cat.title}}</a>
                    </div>
                </li>
                <li class="nav-item px-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ناشران
                    </a>
                    <div class="dropdown-menu bg-dark text-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white font12" :href="mya('person','nasher',nash.id,nash.fullname)" v-for="nash in nasher">{{nash.fullname}}</a>
                    </div>
                </li>
                <li class="nav-item px-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        نویسندگان
                    </a>
                    <div class="dropdown-menu bg-dark text-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white font12" :href="mya('person','writer',writ.id,writ.fullname)" v-for="writ in writer">{{writ.fullname}}</a>
                    </div>
                </li>
                <li class="nav-item px-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        مترجمان
                    </a>
                    <div class="dropdown-menu bg-dark text-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-white font12" :href="mya('person','translator',trans.id,trans.fullname)" v-for="trans in translator">{{trans.fullname}}</a>
                    </div>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/moredownload">
                        بیشترین دانلود
                    </a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/fawerit">
                        محبوب ترین کتب
                    </a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/contact">
                        تماس با ما
                    </a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/about">درباره ما</a>
                </li>
            </ul>
        </div>
    </nav>

</template>

<script>
    export default {
        name: "Menucompo",
        data(){
            return{
                category: [],
                nasher: [],
                writer: [],
                translator: [],
            }
        },
        methods:{
            mya(first, flag, id, title) {
                var mytitle = title.replace(/\s+|\//g, '-').toLowerCase();
                if (flag == ''){
                    return '/'+ first +'/' + id + '/'+ mytitle;
                }else {
                    return '/'+ first +'/'+ flag +'/' + id + '/'+ mytitle;
                }
            },
        },
        mounted() {
            let that = this;

            axios.post('/getmenu')
                .then(function (response) {

                    that.category = response.data[0];
                    that.nasher = response.data[1];
                    that.writer = response.data[2];
                    that.translator = response.data[3];
                });
        }
    }
</script>

<style scoped>

</style>
