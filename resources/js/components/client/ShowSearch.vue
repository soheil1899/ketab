<template>
    <div>
        <div class="mt-3" v-if="book.length > 0">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    کتب :
                </strong>
            </h3>
            <div class="row mx-0 mt-3">
                <div class="col-6 col-md-4 col-lg-3 px-2 mb-4" v-for="(mybook, index) in book">
                    <div class="position-relative leftbook width100 height100">
                        <img :src="mybook.image" class="leftbookimg" width="100%" height="100%">
                        <div class="bookinfo position-absolute py-4 px-2">
                            <h2 class="leftbookname mb-3">
                                <strong>
                                    {{mybook.title}}
                                </strong>
                            </h2>
                            <div class="text-center">
                                <label class="text-white font10 mb-0">نویسنده:</label>
                                <label class="text-white font10 mb-0">{{mybook.writer.fullname}}</label>
                            </div>
                            <div class="text-center" v-if="mybook.translator">
                                <label class="text-white font10 mb-0">مترجم:</label>
                                <label class="text-white font10 mb-0">{{mybook.translator.fullname}}</label>
                            </div>
                            <div class="text-center">
                                <label class="text-white font10 mb-0">دسته:</label>
                                <label class="text-white font10 mb-0">{{mybook.category.title}}</label>
                            </div>
                            <div class="text-center mt-3">
                                <a :href="mya(mybook.id, mybook.title)">
                                    <input type="button" class="btn btn-outline-primary btn-sm font10 mb-1" value="بیشتر">
                                </a>
                                <input type="button" @click="download(mybook.id, mybook.booklink)" class="mb-1 btn btn-outline-success btn-sm font10"  v-if="mybook.booklink"  value="دانلود">

                                <input v-if="auth" type="button" @click="likebook(mybook.id)"
                                       class="btn btn-outline-danger btn-sm font10 mb-1" value="دوست داشتم">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3" v-if="nasher.length > 0">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    ناشر :
                </strong>
            </h3>
            <div class="row mx-0 mt-3">
                <ul>
                    <li v-for="(item, index) in nasher" class="text-right">
                        <a :href="mya2('person','nasher',item.id,item.fullname)">
                            {{item.fullname}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-3" v-if="writer.length > 0">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    نویسنده :
                </strong>
            </h3>
            <div class="row mx-0 mt-3">
                <ul>
                    <li v-for="(item, index) in writer" class="text-right">
                        <a :href="mya2('person','writer',item.id,item.fullname)">
                            {{item.fullname}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-3" v-if="translator.length > 0">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    مترجم :
                </strong>
            </h3>
            <div class="row mx-0 mt-3">
                <ul>
                    <li v-for="(item, index) in translator" class="text-right">
                        <a :href="mya2('person','translator',item.id,item.fullname)">
                            {{item.fullname}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowSearch",
        props: ['book', 'nasher', 'writer', 'translator', 'auth'],
        methods: {
            download(id, link) {
                let data = {
                    bookid: id,
                    link: link,
                };
                axios.post('/downloadbook', data)
                    .then(function (response) {
                        window.location = response.data;
                    });
            },
            likebook(id) {
                let data = {
                    bookid: id,
                };
                axios.post('/likebook', data)
                    .then(function (response) {
                    });
            },
            mya(id, title) {
                var mytitle = title.replace(/\s+|\//g, '-').toLowerCase();
                return '/book/' + id + '/' + mytitle;
            },
            mya2(first, flag, id, title) {
                var mytitle = title.replace(/\s+|\//g, '-').toLowerCase();
                if (flag == '') {
                    return '/' + first + '/' + id + '/' + mytitle;
                } else {
                    return '/' + first + '/' + flag + '/' + id + '/' + mytitle;
                }
            },
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
