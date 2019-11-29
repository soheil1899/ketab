<template>
    <div class="row mx-0 mt-4">
        <div class="col-12">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    {{book.title}}
                </strong>
            </h3>
        </div>
        <div class="row col-12 mx-0 mt-4">
            <div class="col-12 col-lg-4 order-0 order-lg-1">
                <img :src="book.image" class="mybookstyle">
            </div>
            <div class="col-12 col-lg-8 order-1 order-lg-0">
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            دسته بندی :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            <a :href="mya('books', '', book.category.id, book.category.title)">
                                {{book.category.title}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            موضوع کتاب :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            {{book.subject}}
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            نویسنده :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            <a :href="mya('person', 'writer', book.writer.id, book.writer.fullname)">
                            {{book.writer.fullname}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mx-0" v-if="book.translator != ''">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            مترجم :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            <a :href="mya('person', 'translator', book.translator.id, book.translator.fullname)">
                            {{book.translator.fullname}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            ناشر :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            <a :href="mya('person', 'nasher', book.nasher.id, book.nasher.fullname)">
                            {{book.nasher.fullname}}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            سال انتشار :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13" v-if="book.year">
                            {{book.year}}
                        </div>
                        <div class="width100 bookitem px-2 py-1 text-right font13" v-else>
                            -
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-4 py-1 pl-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13">
                            تعداد صفحات :
                        </div>
                    </div>
                    <div class="col-8 py-1 pr-1">
                        <div class="width100 bookitem px-2 py-1 text-right font13" v-if="book.page">
                            {{book.page}}
                        </div>
                        <div class="width100 bookitem px-2 py-1 text-right font13" v-else>
                            -
                        </div>
                    </div>
                </div>
                <div class="row mx-0 mt-3 pr-3">
                    <input type="button" @click="download(book.id, book.booklink)" v-if="book.booklink" class="btn btn-success px-5 py-1" value="دانلود کتاب">
                    <input v-if="auth" type="button" @click="likebook(book.id)" class="btn btn-danger px-3 mx-2 py-1" value="دوست داشتم">

                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <p dir="rtl" class="text-right" v-html="book.description"></p>
        </div>
        <div class="col-12 mt-3" v-if="book.description">
            <input type="button" @click="download(book.id, book.booklink)" v-if="book.booklink" class="btn btn-success px-5 py-1" value="دانلود کتاب">
            <input v-if="auth" type="button" @click="likebook(book.id)" class="btn btn-danger mx-2 px-3 py-1" value="دوست داشتم">
        </div>
    </div>
</template>

<script>
    export default {
        name: "Bookinfo",
        props: ['book', 'auth'],
        methods:{
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
            likebook(id){
                let data = {
                    bookid: id,
                };
                axios.post('/likebook', data)
                    .then(function (response) {
                    });
            },
            mya(first, flag, id, title) {
                var mytitle = title.replace(/\s+|\//g, '-').toLowerCase();
                if (flag == ''){
                    return '/'+ first +'/' + id + '/'+ mytitle;
                }else {
                    return '/'+ first +'/'+ flag +'/' + id + '/'+ mytitle;
                }
            },
        }
    }
</script>

<style scoped>
    .bookitem {
        background-color: #e2e2e2;
        border-radius: 4px;
    }

    .font13 {
        font-size: 13px;
    }

    .mybookstyle {
        box-shadow: 0 0 15px 5px #616161;
        border-radius: 7px;
        width: 190px;
        transition: width 1s;
        max-width: 100%;
    }

    .mybookstyle:hover {
        width: 200px;
    }

</style>
