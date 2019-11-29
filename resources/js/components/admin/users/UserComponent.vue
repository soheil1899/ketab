<template>

    <div>
        <h4 class="admin-title py-3 px-4"> لیست کاربران </h4>

        <input type="button" @click="adduser" class="btn btn-success btn-sm my-2" data-toggle="modal"
               data-target="#Modal" value="افزودن کاربر جدید">
        <input type="button" @click="reloadPage" class="btn btn-dark btn-sm my-2 mr-1" value="بازخوانی">

        <a :href="'../dashboard'" class="back-btn btn btn-sm btn-dark my-2 mr-1">داشبورد</a>
        <input type="button" class="back-btn btn btn-danger btn-sm my-2 mr-3" @click="deleteuser" value="حذف">


        <table class="table table-hover table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">ایمیل</th>
                <th scope="col" class="p-0">
                    <i class="fas fa-cogs fa-2x mb-2"></i>
                </th>
                <th scope="col" width="5%">حذف</th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in this.userlist" :key="item.id">
                <th class="py-2" scope="row">{{index +1}}</th>
                <td class="py-2">{{item.name}}</td>
                <td class="py-2">{{item.email}}</td>
                <td class="py-1 icons">
                    <i title="ویرایش" class="far fa-edit fa-lg mt-2 mx-1" data-toggle="modal" data-target="#Modal" @click="edituser(item.id, item.name, item.email)"></i>
                </td>
                <td class="py-1">
                    <input type="checkbox" v-model="deletemyuser[item.id]" class="form-check-input mx-auto">
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
                        <h5 class="modal-title" v-if="editflag == true" v-text="'ویرایش کاربر'"></h5>
                        <h5 class="modal-title" v-else v-text="'افزودن کاربر جدید'"></h5>
                    </div>

                    <div class="modal-body">
                        <error :error="error"></error>
                        <div v-if="passwordfalsediv" class="alert alert-danger" role="alert">
                            تکرار رمز عبور را صحیح وارد کنید.
                        </div>
                        <form>
                            <div class="form-group mb-1">
                                <input type="text" v-model="username" placeholder="نام کاربر" class="form-control" name="username">
                            </div>
                            <div class="form-group mb-1">
                                <input type="email" v-model="email" placeholder="ایمیل" class="form-control" name="email">

                            </div>
                            <div class="form-group mb-1" v-if="editflag">
                                <input type="checkbox" class="form-check-input publish-checkbox mr-2" @change="passwordchenge" v-model="passwordedit">
                                <label class="form-check-label pr-2 mt-1 mr-4">قصد تغییر رمزعبور را دارید؟</label>
                            </div>
                            <div class="form-group mb-1" v-if="passwordedit">
                                <input type="password" v-model="password" placeholder="رمز عبور" :class="{ 'border-green': passwordflag }"
                                       @keyup="checkpassword" class="form-control" name="password">
                            </div>
                            <div class="form-group mb-1" v-if="passwordedit">
                                <input type="password" :class="{ 'border-green': passwordflag }"
                                       v-model="confirmpassword" @keyup="checkpassword" class="form-control"
                                       name="confirmpassword" placeholder="تکرار رمز عبور">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button @click="saveuser" type="button" class="btn btn-primary btn-sm px-4">ذخیره</button>
                        <button type="button" class="btn btn-secondary btn-sm px-4" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>




    </div>


</template>

<script>

    export default {
        name: "UserComponent",
        data() {
            return {
                editflag: false,
                userlist: [],
                username: null,
                email: null,
                password: null,
                confirmpassword: null,
                passwordedit: false,
                error: [],
                userid: null,
                passwordflag: false,
                passwordfalsediv: false,

                deletemyuser: [],

            }
        },
        methods: {

            reloadPage() {
                let that = this;
                axios.post('/dashboard/users')
                    .then(function (response) {
                        that.userlist = response.data;
                    });
            },

            adduser() {
                this.error = [];
                this.editflag = false;
                this.username = null;
                this.email = null;
                this.password = null;
                this.confirmpassword = null;
                this.userid = null;
                this.passwordflag = false;
                this.passwordfalsediv = false;
                this.passwordedit = true;
            },

            edituser(id, name, email){
                this.error = [];
                this.editflag = true;
                this.userid = id;
                this.username = name;
                this.email = email;
                this.passwordedit = false;
                this.passwordfalsediv = false;
            },


            saveuser() {
                if (this.passwordedit == true){
                    if (this.passwordflag == true) {
                        let that = this;
                        let data = {
                            id: this.userid,
                            username: this.username,
                            email: this.email,
                            passwordedit: this.passwordedit,
                            password: this.password,
                            editflag: this.editflag,
                        };
                        axios.post('/dashboard/saveuser', data)
                            .then(function (response) {
                                $('#Modal').modal('hide');
                                that.reloadPage();
                            }).catch((error) => {
                            that.error = error.response.data.errors;
                        });
                    }
                    else{
                        this.passwordfalsediv = true;
                    }
                } else{
                    let that = this;
                    let data = {
                        id: this.userid,
                        username: this.username,
                        email: this.email,
                        password: this.password,
                        editflag: this.editflag,
                    };
                    axios.post('/dashboard/saveuser', data)
                        .then(function (response) {
                            $('#Modal').modal('hide');
                            that.reloadPage();
                        }).catch((error) => {
                        that.error = error.response.data.errors;
                    });
                }



            },

            deleteuser(){
                let that = this;
                let data = {
                    users: this.deletemyuser,
                };
                axios.post('/dashboard/deleteuser', data)
                    .then(function (response) {
                        that.reloadPage();
                    });
            },

            checkpassword() {
                if (this.password == this.confirmpassword) {
                    this.passwordflag = true;
                } else {
                    this.passwordflag = false;
                }
                this.passwordfalsediv = false;
            },
        }
        ,

        mounted() {
            this.reloadPage();
        }


    }

    // $('#Modal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget); // Button that triggered the modal
    //     var recipient = button.data('whatever'); // Extract info from data-* attributes
    // })
</script>

<style scoped>


</style>
