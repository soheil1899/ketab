<template>
    <div class="card">
        <div class="card-header text-center py-2 bg-dark text-white" v-if="flag == 'all'">
            آخرین کتب
        </div>
        <div class="card-header text-center py-2 bg-dark text-white" v-else-if="flag == 'download'">
            بیشترین دانلود کتب
        </div>
        <div class="card-header text-center py-2 bg-dark text-white" v-else-if="flag == 'likes'">
            محبوب ترین کتب
        </div>
        <div class="card-header text-center py-2 bg-dark text-white" v-else>
            کتب مربوط به دسته
            {{cat.title}}
        </div>
        <div class="card-body p-0">
            <div class="row mx-0 justify-content-center leftside px-2 py-3 text-right">


                <div :class="myclass(flag)" v-for="(book, index) in lastbook">
                    <div class="position-relative leftbook width100 height100">
                        <img :src="book.image" class="leftbookimg" width="100%" height="100%">
                        <div class="bookinfo position-absolute py-4 px-2">
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
                            <div class="text-center mt-3">
                                <a :href="mya(book.id, book.title)">
                                    <input type="button" class="btn btn-outline-primary btn-sm font10 mb-1" value="بیشتر">
                                </a>
                                <input type="button" @click="download(book.id, book.booklink)" class="mb-1 btn btn-outline-success btn-sm font10" v-if="book.booklink" value="دانلود">

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
        name: "Lastbook",
        props: ['flag', 'auth'],
        data() {
            return {
                lastbook: [],
                cat: null,
            }
        },
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
            myclass(flag) {
                if (flag == 'download' || flag == 'likes') {
                    return 'col-6 col-md-2 px-2 mb-4';
                } else {
                    return 'col-6 col-md-4 col-lg-3 px-2 mb-4';
                }
            }
        },
        mounted() {
            let that = this;
            let data = {
                flag: this.flag,
            };
            axios.post('/getlastbook', data)
                .then(function (response) {
                    if (that.flag == 'all' || that.flag == 'download' || that.flag == 'likes')
                        that.lastbook = response.data;
                    else {
                        that.cat = response.data[0];
                        that.lastbook = response.data[1];
                    }

                });
        }
    }
</script>

<style scoped>
    .booklist {
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 10px 3px #c0c0c0;
    }

</style>
