<template>
    <div>
        <h4 class="admin-title py-3 px-4"> لیست کتب </h4>

        <input type="button" class="btn btn-success btn-sm my-2" data-toggle="modal"
               data-target="#Modal" @click="addbook" value="افزودن کتاب جدید">
        <input type="button" @click="reloadPage" class="btn btn-dark btn-sm my-2 mr-1" value="بازخوانی">

        <a :href="'../dashboard'" class="back-btn btn btn-sm btn-dark my-2 mr-1">داشبورد</a>
        <input type="button" @click="deletebook" class="back-btn btn btn-danger btn-sm my-2 mr-3" value="حذف">


        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">عنوان کتاب</th>
                <th scope="col">موضوع</th>
                <th scope="col">دسته بندی</th>
                <th scope="col">نویسنده</th>
                <th scope="col">مترجم</th>
                <th scope="col">ناشر</th>
                <th scope="col">صفحه</th>
                <th scope="col">انتشار</th>
                <th scope="col" class="p-0">
                    <i class="fas fa-cogs fa-2x mb-2"></i>
                </th>
                <th scope="col" width="5%">حذف</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(item, index) in booklist" :key="item.id">
                <th class="py-2" scope="row">{{index + 1}}</th>
                <td class="py-2">{{item.title}}</td>
                <td class="py-2">{{item.subject}}</td>
                <td class="py-2">{{item.category['title']}}</td>
                <td class="py-2" v-if="item.writer">{{item.writer['fullname']}}</td>
                <td class="py-2" v-else>-</td>
                <td class="py-2" v-if="item.translator">{{item.translator['fullname']}}</td>
                <td class="py-2" v-else>-</td>
                <td class="py-2" v-if="item.nasher">{{item.nasher['title']}}</td>
                <td class="py-2" v-else>-</td>
                <td class="py-2">{{item.page}}</td>
                <td class="py-2">{{item.year}}</td>
                <td class="py-1 icons">
                    <i title="ویرایش" class="far fa-edit fa-lg mt-2 mx-1" data-toggle="modal" data-target="#Modal"
                       @click="editbook(item.id, item.title, item.subject, item.category, item.writer, item.translator, item.nasher, item.page, item.year)"></i>
                    <i title="توضیحات" class="far fa-file-alt fa-lg mt-2 mx-1" data-toggle="modal" data-target="#naghdmodal"
                       @click="editbookdes(item.id, item.title, item.description)"></i>
                    <i title="پوستر" class="far fa-image fa-lg mt-2 mx-1" @click="browsefile2(item.id)"></i>
                    <i title="فایل pdf" class="far fa-file-pdf fa-lg mt-2 mx-1" @click="browsepdf(item.id)"></i>
                </td>
                <td class="py-1">
                    <input type="checkbox" v-model="deletemybook[item.id]" class="form-check-input mx-auto">
                </td>
            </tr>
            </tbody>
        </table>

        <input type="file" class="d-none" id="browse2" ref="image2"
               @change="selectimage2" accept=".jpg, .png, .jpeg">
        <input type="file" class="d-none" id="browsepdf" ref="mypdf"
               @change="savepdf" accept=".pdf">


        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" v-if="editflag"
                            v-text="'ویرایش کتاب'"></h5>
                        <h5 class="modal-title" v-else
                            v-text="'افزودن کتاب جدید'"></h5>
                    </div>

                    <div class="modal-body">
                        <error :error="error"></error>
                        <div class="form-group">
                            <input type="text" v-model="title" placeholder="عنوان کتاب"
                                   class="form-control form-control-sm mb-2">
                            <input type="text" v-model="subject" placeholder="موضوع کتاب"
                                   class="form-control form-control-sm mb-2">
                            <v-select v-model="category" class="mb-2" dir="rtl" :options="categorylist" label="title"
                                      :clearable="false" placeholder="** انتخاب دسته بندی **"></v-select>
                            <v-select v-model="writer" class="mb-2" dir="rtl" :options="writerlist" label="fullname"
                                      :clearable="false" placeholder="** انتخاب نویسنده **"></v-select>
                            <v-select v-model="translator" class="mb-2" dir="rtl" :options="translatorlist"
                                      label="fullname"
                                      :clearable="false" placeholder="** انتخاب مترجم **"></v-select>
                            <v-select v-model="nasher" class="mb-2" dir="rtl" :options="nasherlist" label="title"
                                      :clearable="false" placeholder="** انتخاب ناشر **"></v-select>
                            <input type="text" v-model="year" placeholder="سال انتشار"
                                   class="form-control form-control-sm mb-2">
                            <input type="text" v-model="page" placeholder="تعداد صفحات کتاب"
                                   class="form-control form-control-sm mb-2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="savebook" class="btn btn-primary btn-sm px-4">ذخیره</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="naghdmodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title"> توضیحات مربوط به
                            {{title}}
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row mb-1">
                            <div class="col-12 col-lg-9" style="direction: ltr">
                                <editor v-model="text" ref="editor"
                                        api-key="qc1sdre33bdx4lkj24aw4ffoeyx1rvbohr9ow2hzhjgfu2mi"
                                        :init="{ height: 300 ,plugins: 'link fullscreen table','directionality' : 'rtl',toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect |  outdent indent | link | ltr rtl', }"></editor>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-header row m-0 p-1 pt-2">
                                        <div class="col-7">
                                            مدیریت فایل
                                        </div>
                                        <div class="col-4 icons">
                                            <i @click="browsefile" class="fas fa-plus-square fa-2x"
                                               style="color: #5BB760"></i>
                                        </div>
                                        <input type="file" style="display: none" id="browse" ref="imagetext"
                                               @change="selecttextimage">
                                    </div>
                                    <div class="card-body p-2">
                                        <div v-for="(file, index) in filemanagerids" :key="file.id"
                                             class="m-1 float-right position-relative icons">
                                            <img :src="file.small" @click="selectImage(file.original)">
                                            <i title="پاک کردن"
                                               class="fas fa-trash position-absolute delete-filemanager"
                                               @click="deletefilemanager(file.small, file.original, index)"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" @click="savedes" class="btn btn-primary btn-sm px-4">ذخیره</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>

    import Editor from '@tinymce/tinymce-vue';
    import vSelect from 'vue-select';

    Vue.component('v-select', vSelect);


    export default {
        name: "NasherComponent",
        data() {
            return {
                editflag: false,
                booklist: [],
                categorylist: [],
                translatorlist: [],
                writerlist: [],
                nasherlist: [],

                title: null,
                subject: null,
                nasher: null,
                category: null,
                writer: null,
                translator: null,
                year: null,
                page: null,

                image: null,
                description: null,
                text: '',

                error: [],
                bookid: null,

                filemanagerids: [],
                deletemybook: [],
            }
        },
        components: {
            'editor': Editor
        },
        methods: {
            browsepdf(id){
                this.bookid = id;
                document.getElementById("browsepdf").click();
            },
            savepdf() {
                let that = this;
                let formData = new FormData();
                formData.append('pdf', this.$refs.mypdf.files[0]);
                formData.append('bookid', this.bookid);
                axios.post('/dashboard/savebookpdf'
                    , formData
                    , {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {

                    });

            },
            browsefile2(id) {
                this.bookid = id;
                document.getElementById("browse2").click();
            },
            selectimage2() {
                let that = this;
                let formData = new FormData();
                formData.append('image', this.$refs.image2.files[0]);
                formData.append('bookid', this.bookid);

                axios.post('/dashboard/savebookimage'
                    , formData
                    , {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {
                        that.reloadPage();
                    });
            },
            browsefile() {
                document.getElementById("browse").click();
            },
            selectImage(original) {
                let Imagetag = '<img src="'+ original +'" data-mce-src="'+ original +'" width="200px">';
                this.text += Imagetag;
            },
            selecttextimage() {
                let that = this;
                let formData = new FormData();
                formData.append('image', this.$refs.imagetext.files[0]);
                formData.append('bookid', this.bookid);
                axios.post('/dashboard/savefile'
                    , formData
                    , {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }

                    })
                    .then(function (response) {
                        let newfile = [];
                        newfile['small'] = '/media/filemanager/book/' + that.bookid + '/itemsmall_' + response.data + '.png';
                        newfile['original'] = '/media/filemanager/book/' + that.bookid + '/item_' + response.data + '.png';
                        that.filemanagerids.push(newfile);
                    });
            },


            editbookdes(id, title, des) {
                this.title = title;
                this.bookid = id;
                this.text = des;
                if (des == null) {
                    this.text = '';
                }
                let that = this;
                let data = {
                    bookid: id,
                };
                axios.post('/dashboard/getfilemanager', data)
                    .then(function (response) {
                        try {
                            that.filemanagerids = [];
                            for (var i = 0; i < response.data.length; i++) {
                                let newfile = [];
                                newfile['small'] = '/media/filemanager/book/' + id + '/itemsmall_' + response.data[i]['image'] + '.png';
                                newfile['original'] = '/media/filemanager/book/' + id + '/item_' + response.data[i]['image'] + '.png';
                                that.filemanagerids.push(newfile);
                            }
                        } catch (e) {

                        }
                    });
            },

            editbook(id, title, subject, category, writer, translator, nasher, page, year) {
                this.bookid = id;
                this.error = [];
                this.editflag = true;
                this.title = title;
                this.subject = subject;
                this.category = category;
                this.writer = writer;
                this.translator = translator;
                this.nasher = nasher;
                this.page = page;
                this.nasher = nasher;
                this.year = year;
            },

            addbook() {
                this.error = [];
                this.editflag = false;
                this.title = null;
                this.subject = null;
                this.category = null;
                this.writer = null;
                this.translator = null;
                this.nasher = null;
                this.page = null;
                this.year = null;
            },


            savedes() {
                let that = this;
                let data = {
                    bookid: this.bookid,
                    des: this.text,
                };
                axios.post('/dashboard/savebookdescription', data)
                    .then(function (response) {
                        $('#naghdmodal').modal('hide');
                        that.reloadPage();
                    });
            },
            savebook() {
                let that = this;
                let data = {
                    edit: this.editflag,
                    bookid: this.bookid,
                    title: this.title,
                    subject: this.subject,
                    category: this.category,
                    writer: this.writer,
                    translator: this.translator,
                    nasher: this.nasher,
                    page: this.page,
                    year: this.year,
                };
                axios.post('/dashboard/savebook', data)
                    .then(function (response) {
                        $('#Modal').modal('hide');
                        that.reloadPage();
                    });
            },

            reloadPage() {
                let that = this;
                axios.post('/dashboard/books')
                    .then(function (response) {
                        that.booklist = response.data[0];
                        that.categorylist = response.data[1];
                        that.translatorlist = response.data[2];
                        that.writerlist = response.data[3];
                        that.nasherlist = response.data[4];
                    });
            },
            deletebook() {
                let that = this;
                let data = {
                    books: this.deletemybook,
                };
                axios.post('/dashboard/deletebook', data)
                    .then(function (response) {
                        that.reloadPage();
                    });
            },
        },
        mounted() {
            this.reloadPage();
        }
    }
</script>

<style scoped>

</style>
