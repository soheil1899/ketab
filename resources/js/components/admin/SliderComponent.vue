<template>
    <div>
        <h4 class="admin-title py-3 px-4"> مدیریت اسلایدر </h4>

        <error :error="error"></error>

        <div class="card">
            <div class="card-header row m-0 p-1 pt-2">
                <div class="col-8">
                    تصاویر مربوط به اسلایدر
                </div>
                <div class="col-4 icons">
                    <button type="button" @click="browsefile" class="btn btn-success btn-sm px-4">
                        افزودن تصویر
                    </button>
                </div>
                <input type="file" class="d-none" id="browse" ref="slider"
                       @change="selectslider" accept=".jpg, .png, .jpeg">
            </div>
            <div class="card-body p-2">
                <div v-for="image in imagelist" :key="image.id"
                     class="m-1 float-right position-relative">
                    <img :src="mysrc(image.image)">
                    <i @click="deletesliderimage(image.id)"
                       class="fas fa-trash position-absolute delete-filemanager"></i>
                </div>

            </div>
        </div>

    </div>
</template>




<script>
    export default {
        name: "SliderComponent",

        data() {
            return {
                error: [],
                editflag: false,
                imagelist: [],
            }
        },

        methods: {
            mysrc(image){
                return '/media/slider/small_' + image + '.png';
            },
            reloadpage() {
                let that = this;
                axios.post('/dashboard/getslider')
                    .then(function (response) {
                        that.imagelist = response.data;
                    });
            },

            browsefile() {
                document.getElementById("browse").click();
            },

            selectslider() {
                let that = this;
                let formData = new FormData();
                formData.append('image', this.$refs.slider.files[0]);

                axios.post('/dashboard/savesliderimage'
                    , formData
                    , {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }

                    })
                    .then(function (response) {
                        let newfile = [];
                        newfile['id'] = response.data[1];
                        newfile['image'] = response.data[0];

                        that.imagelist.push(newfile);
                    });
            },



            deletesliderimage(id) {
                let that = this;
                let data = {
                    id: id,
                };
                axios.post('/dashboard/deletesliderimage', data)
                    .then(function (response) {
                        for (var i = 0; i < that.imagelist.length; i++) {
                            if (that.imagelist[i]['id'] == id) {
                                that.imagelist.splice(i, 1);
                            }
                        }

                    });
            },
        },

        mounted() {
            this.reloadpage();
        }

    }
</script>

<style scoped>

</style>
