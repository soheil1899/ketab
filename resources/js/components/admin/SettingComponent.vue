<template>

    <div>
        <h4 class="admin-title py-3 px-4"> تنظیمات وب سایت </h4>


        <div class="col-12 col-lg-10 mr-auto ml-auto">


            <div class="row pt-2 mt-5">
                <div class="col-3 text-left">عنوان سایت :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['site_title']">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">توضیحات سایت :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['header_description']">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-3 text-left">کلیدواژه سایت :</div>
                <div class="col-9">
                    <v-select :multiple="true" v-model="setting['keywords']" :taggable="true" :no-drop="true"
                              :clearable="false" dir="rtl"></v-select>
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">موبایل :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['mobile']">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">تلفن :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['tellphone']">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">فکس :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['fax']">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-3 text-left">ایمیل :</div>
                <div class="col-9">
                    <input class="form-control text-left" type="text" v-model="setting['email']">
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-3 text-left">آدرس :</div>
                <div class="col-9">
                    <textarea class="form-control" rows="3" v-model="setting['address']"></textarea>
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">اینستاگرام :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['instagram']">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">تلگرام :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['telegram']">
                </div>
            </div>

            <div class="row pt-2">
                <div class="col-3 text-left">واتساپ :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['whatsup']">
                </div>
            </div>


            <div class="row pt-2">
                <div class="col-3 text-left">توییتر :</div>
                <div class="col-9">
                    <input class="form-control" type="text" v-model="setting['twitter']">
                </div>
            </div>


            <div class="row pt-2">
                <div class="col-3 text-left">درباره ما :</div>
                <div class="col-9">
                    <editor v-model="setting['aboutus']" ref="editor"
                            api-key="qc1sdre33bdx4lkj24aw4ffoeyx1rvbohr9ow2hzhjgfu2mi"
                            :init="{ height: 300 ,plugins: 'link fullscreen table','directionality' : 'rtl',toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect |  outdent indent | link | ltr rtl', }"></editor>
                </div>
            </div>
        </div>


        <div class="col-8 mx-auto my-5">
            <input type="button" class="btn btn-primary btn-block btn-lg" @click="savesetting" value="ذخیره تنظیمات">
        </div>
    </div>


</template>

<script>


    import Editor from '@tinymce/tinymce-vue';
    import Swal from 'sweetalert2';


    export default {
        name: "SettingComponent",
        components: {
            'editor': Editor
        },
        data() {
            return {
                setting: {
                    'mobile': null,
                    'tellphone': null,
                    'fax': null,
                    'email': null,
                    'address': null,
                    'aboutus': null,
                    'header_description': null,
                    'site_title': null,
                    'instagram': null,
                    'telegram': null,
                    'whatsup': null,
                    'twitter': null,
                    'keywords': null,
                },
                error: [],

            }
        },
        comments: {
            Swal,
        },
        methods: {

            savesetting() {
                let that = this;
                let data = {
                    setting: this.setting,
                };
                axios.post('/dashboard/savesetting', data)
                    .then(function (response) {
                        Swal.fire({
                            text: 'اطلاعات شما با موفقیت ثبت شد!',
                            type: 'success',
                            confirmButtonText: 'بستن'
                        });
                        that.reloadPage();
                    });

            },


            reloadPage() {
                let that = this;
                axios.post('/dashboard/getsetting')
                    .then(function (response) {
                        if (response.data != ''){
                            that.setting = response.data;
                        }
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
