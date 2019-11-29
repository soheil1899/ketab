<template>
    <div class="row mx-0 mt-4">
        <div class="col-12">
            <h3 class="persontitle mb-0 pr-2 py-2 text-right">
                <strong>
                    تماس با ما
                </strong>
            </h3>
        </div>
        <div class="col-10 mt-4 pr-5 text-right">
            <div class="col-12">
                <label class="pl-3 w-25">شماره تماس :</label>
                <label>{{setting.tellphone}}</label>
            </div>
            <div class="col-12">
                <label class="pl-3 w-25">شماره موبایل :</label>
                <label>{{setting.mobile}}</label>
            </div>
            <div class="col-12">
                <label class="pl-3 w-25">شماره فکس :</label>
                <label>{{setting.fax}}</label>
            </div>
            <div class="col-12">
                <label class="pl-3 w-25">آدرس ایمیل :</label>
                <label>{{setting.email}}</label>
            </div>
            <div class="col-12">
                <label class="pl-3 w-25">آدرس دفتر :</label>
                <label>{{setting.address}}</label>
            </div>
        </div>
        <div class="col-2 px-1">
            <div class="px-2 my-2 mx-auto pt-2 pb-1 widthfit socialfooter pointer">
                <a :href="setting.instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </div>
            <div class="px-2 my-2 mx-auto pt-2 pb-1 widthfit socialfooter pointer">
                <a :href="setting.telegram">
                    <i class="fab fa-telegram-plane fa-lg"></i>
                </a>
            </div>
            <div class="px-2 my-2 mx-auto pt-2 pb-1 widthfit socialfooter pointer">
                <a :href="setting.twitter">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
            </div>
            <div class="px-2 my-2 mx-auto pt-2 pb-1 widthfit socialfooter pointer">
                <a :href="setting.whatsup">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Contact",
        props: ['setting']
    }
</script>

<style scoped>
    .widthfit {
        width: fit-content;
    }

</style>
