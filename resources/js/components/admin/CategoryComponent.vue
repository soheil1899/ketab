<template>

    <div>
        <h4 class="admin-title py-3 px-4"> مدیریت دسته ها </h4>

        <input type="button" @click="addcategory" class="btn btn-success btn-sm my-2" data-toggle="modal"
               data-target="#Modal" value="افزودن دسته جدید">
        <input type="button" @click="getsubcategorys(parentid)" class="btn btn-dark btn-sm my-2 mr-1" value="بازخوانی">
        <a :href="'../dashboard'" class="back-btn btn btn-sm btn-dark my-2 mr-1">داشبورد</a>

        <input v-if="this.backbtn" @click="goback" type="button" class="back-btn btn btn-sm btn-dark my-2 mr-1" value="برگشت">

        <input type="button" class="back-btn btn btn-danger btn-sm my-2 mr-3" @click="deletecategory" value="حذف">


        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">عنوان دسته</th>
                <th scope="col">توضیحات</th>
                <th scope="col" class="p-0">
                    <i class="fas fa-cogs fa-2x mb-2"></i>
                </th>
                <th scope="col" width="10%">حذف</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in this.categorylist" :key="item.id">
                <th class="py-2" scope="row">{{item.id}}</th>
                <td class="py-2">{{item.title}}</td>
                <td class="py-2">{{item.description}}</td>
                <td class="icons py-1">
                    <i v-if="backarray.length == 0" title="زیردسته" class="fas fa-sitemap fa-lg mx-1 mt-2" @click="getsubcategorys(item.id)"></i>
                    <i title="ویرایش" class="far fa-edit fa-lg mx-1 mt-2" @click="editcategory(item.id, item.title, item.description)" data-toggle="modal" data-target="#Modal"></i>

                </td>
                <td class="py-1 text-center">
                    <input v-if="item.last == 1" type="checkbox" v-model="deletecat[item.id]" class="form-check-input mx-auto">
                    <small v-else>
                        شامل زیردسته
                    </small>
                </td>
            </tr>
            </tbody>
        </table>


        <!-- Add & Edit Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" v-if="editflag == true" v-text="'ویرایش دسته'"></h5>
                        <h5 class="modal-title" v-else v-text="'افزودن دسته جدید'"></h5>
                    </div>

                    <div class="modal-body">
                        <error :error="error"></error>

                        <form>
                            <div class="form-group mb-1">
                                <input type="text" v-model="category" class="form-control" placeholder="عنوان دسته بندی" name="title">
                            </div>
                            <div class="form-group mb-1">
                                <textarea name="description" placeholder="توضیحات..." v-model="description" class="form-control" cols="30"
                                          rows="3"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" @click="savecategory" class="btn btn-primary btn-sm px-4">ذخیره</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>



    </div>


</template>

<script>
    import vSelect from 'vue-select';

    Vue.component('v-select', vSelect);

    export default {
        name: "CategoryComponent",
        data() {
            return {
                categorylist: [],
                error: [],
                editflag: false,
                categoryid: null,
                category: null,
                description: null,
                backbtn: false,
                backarray: [],
                parentid: null,

                deletecat: [],
            }
        },
        methods: {



            loadPage() {
                this.allowdelete = false;
                let that = this;
                this.backarray = [];
                axios.post('/dashboard/categories')
                    .then(function (response) {
                        that.categorylist = response.data;
                        that.backbtn = false;
                        that.parentid = 0;
                    });
            },

            addcategory() {
                this.error = [];
                this.editflag = false;
                this.categoryid = null;
                this.category = null;
                this.description = null;
            },

            editcategory(id, name, description) {
                this.error = [];
                this.editflag = true;
                this.categoryid = id;
                this.category = name;
                this.description = description;
            },

            savecategory() {
                let that = this;
                let data = {
                    id: this.categoryid,
                    category: this.category,
                    description: this.description,
                    editflag: this.editflag,
                    parentid: this.parentid,
                };
                axios.post('/dashboard/savecategory', data)
                    .then(function (response) {
                        $('#Modal').modal('toggle');
                        that.getsubcategorys(that.parentid, 'reload');
                    }).catch((error) => {
                    that.error = error.response.data.errors;
                });
            },

            deletecategory(){
                let that = this;
                let data = {
                    cats: this.deletecat,
                    parentid: this.parentid,
                };
                axios.post('/dashboard/deletecategory', data)
                    .then(function (response) {
                        that.loadPage();
                    });
            },

            getsubcategorys(id, back = '') {
                this.allowdelete = false;
                let that = this;
                if (back == '') {
                    this.backarray.push(this.parentid);
                    this.parentid = id;
                }
                let data = {
                    parentid: id,
                };
                axios.post('/dashboard/getsubcategorys', data)
                    .then(function (response) {
                        that.categorylist = response.data;
                        that.parentid == 0 ? that.backbtn = false : that.backbtn = true;
                    });
            },

            goback() {
                if (this.backarray.length == 1) {
                    this.loadPage();
                    this.parentid = 0;
                } else {
                    let last = this.backarray[this.backarray.length-1];
                    this.backarray.pop();
                    this.parentid = last;
                    this.getsubcategorys(last, 'back');
                }
            },


        }
        ,

        mounted() {
            this.loadPage();

        }


    }


</script>

<style scoped>

</style>
