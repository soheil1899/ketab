<template>
    <div>
        <h4 class="admin-title py-3 px-4"> لیست ناشران </h4>

        <input type="button" class="btn btn-success btn-sm my-2" @click="addnasher" data-toggle="modal"
               data-target="#Modal" value="افزودن ناشر جدید">
        <input type="button" @click="reloadPage" class="btn btn-dark btn-sm my-2 mr-1" value="بازخوانی">

        <a :href="'../dashboard'" class="back-btn btn btn-sm btn-dark my-2 mr-1">داشبورد</a>
        <input type="button" @click="deletenasher" class="back-btn btn btn-danger btn-sm my-2 mr-3" value="حذف">

        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">نام ناشر</th>
                <th scope="col" class="p-0">
                    <i class="fas fa-cogs fa-2x mb-2"></i>
                </th>
                <th scope="col" width="5%">حذف</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in nasherlist" :key="item.id">
                <th class="py-2" scope="row">{{index + 1}}</th>
                <td class="py-2">{{item.fullname}}</td>
                <td class="py-1 icons">
                    <i title="ویرایش" class="far fa-edit fa-lg mt-2 mx-1" data-toggle="modal" data-target="#Modal"
                       @click="editname(item.id, item.fullname)"></i>
                    <i title="توضیحات" class="far fa-file-alt fa-lg mt-2 mx-1" data-toggle="modal"
                       data-target="#naghdmodal"
                       @click="editnasher(item.id, item.fullname, item.description)"></i>
                <td class="py-1">
                    <input type="checkbox" v-model="deletemynasher[item.id]" class="form-check-input mx-auto">
                </td>
            </tr>

            </tbody>
        </table>


        <!-- Add & Edit Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" v-if="editflag"
                            v-text="'ویرایش ناشر'"></h5>
                        <h5 class="modal-title" v-else
                            v-text="'افزودن ناشر جدید'"></h5>
                    </div>

                    <div class="modal-body">
                        <error :error="error"></error>
                        <div class="form-group">
                            <input type="text" v-model="title" placeholder="عنوان ناشر"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" @click="savenasher" class="btn btn-primary btn-sm px-4">ذخیره</button>
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
                        <h5 class="modal-title">توضیحات مربوط به
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

    export default {
        name: "NasherComponent",
        data() {
            return {
                editflag: false,
                nasherlist: [],

                title: null,
                description: null,
                text: '',

                error: [],
                nasherid: null,

                filemanagerids: [],
                deletemynasher: [],
            }
        },
        components: {
            'editor': Editor
        },
        methods: {

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
                formData.append('nasherid', this.nasherid);
                axios.post('/dashboard/savefile'
                    , formData
                    , {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {
                        let newfile = [];
                        newfile['small'] = '/media/filemanager/nasher/' + that.nasherid + '/itemsmall_' + response.data + '.png';
                        newfile['original'] = '/media/filemanager/nasher/' + that.nasherid + '/item_' + response.data + '.png';
                        that.filemanagerids.push(newfile);
                    });
            },
            editnasher(id, title, des) {
                this.title = title;
                this.nasherid = id;
                this.text = des;
                if (des == null) {
                    this.text = '';
                }
                let that = this;
                let data = {
                    nasherid: id,
                };
                axios.post('/dashboard/getfilemanager', data)
                    .then(function (response) {
                        try {
                            that.filemanagerids = [];
                            for (var i = 0; i < response.data.length; i++) {
                                let newfile = [];
                                newfile['small'] = '/media/filemanager/nasher/' + id + '/itemsmall_' + response.data[i]['image'] + '.png';
                                newfile['original'] = '/media/filemanager/nasher/' + id + '/item_' + response.data[i]['image'] + '.png';
                                that.filemanagerids.push(newfile);
                            }
                        } catch (e) {

                        }
                    });
            },
            editname(id, title) {
                this.error = [];
                this.editflag = true;
                this.title = title;
                this.nasherid = id;
            },
            addnasher() {
                this.error = [];
                this.editflag = false;
                this.title = null;
                this.nasherid = null;
            },
            savedes() {
                let that = this;
                let data = {
                    nasherid: this.nasherid,
                    des: this.text,
                };
                axios.post('/dashboard/savenasherdes', data)
                    .then(function (response) {
                        $('#naghdmodal').modal('hide');
                        that.reloadPage();
                    });
            },
            savenasher() {
                let that = this;
                let data = {
                    edit: this.editflag,
                    nasherid: this.nasherid,
                    title: this.title,
                };
                axios.post('/dashboard/savenasher', data)
                    .then(function (response) {
                        $('#Modal').modal('hide');
                        that.reloadPage();
                    });
            },
            reloadPage() {
                let that = this;
                axios.post('/dashboard/nashers')
                    .then(function (response) {
                        that.nasherlist = response.data;
                    });
            },
            deletenasher() {
                let that = this;
                let data = {
                    nashers: this.deletemynasher,
                };
                axios.post('/dashboard/deletenasher', data)
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
