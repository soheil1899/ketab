<template>
    <div class="card">
        <div class="card-header text-center py-2 bg-dark text-white" v-if="title == 'download'">
            بیشترین دانلود
        </div>
        <div class="card-header text-center py-2 bg-dark text-white" v-else>
            محبوب ترین کتب
        </div>
        <div class="card-body p-0">
            <div class="leftside px-2 py-3 text-right">
                <div class="row mx-0 px-1 mb-3" v-for="(book, index) in leftbook">
                    <div class="position-relative leftbook width100">
                        <img :src="book.image" class="leftbookimg" width="100%">
                        <div class="bookinfo position-absolute py-3 px-2">
                            <h2 class="leftbookname mb-3">
                                <strong>
                                    {{book.title}}
                                </strong>
                            </h2>
                            <div class="text-center">
                                <label class="text-white font10 mb-0">نویسنده:</label>
                                <label class="text-white font10 mb-0">{{book.writer.fullname}}</label>
                            </div>
                            <div class="text-center" v-if="book.translator">
                                <label class="text-white font10 mb-0">مترجم:</label>
                                <label class="text-white font10 mb-0">{{book.translator.fullname}}</label>
                            </div>
                            <div class="text-center">
                                <label class="text-white font10 mb-0">دسته:</label>
                                <label class="text-white font10 mb-0">{{book.category.title}}</label>
                            </div>
                            <div class="text-center mt-2">
                                <a :href="mya(book.id, book.title)">
                                    <input type="button" class="btn mb-1 btn-outline-primary btn-sm font10" value="بیشتر">
                                </a>
                                <input type="button" v-if="book.booklink" @click="download(book.id, book.booklink)"
                                       class="btn btn-outline-success btn-sm mb-1 font10" value="دانلود">

                                <input v-if="auth" type="button" @click="likebook(book.id)"
                                       class="btn btn-outline-danger btn-sm font10 mb-1" value="دوست داشتم">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Leftside",
        props: ['title', 'auth'],
        data() {
            return {
                leftbook: [],
            }
        },
        methods: {
            download(id, link){
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
        },
        mounted() {
            let that = this;
            let data = {
                flag: this.title,
            };
            axios.post('/getleftbook', data)
                .then(function (response) {
                    that.leftbook = response.data;
                });
        }
    }
</script>

<style scoped>

</style>
