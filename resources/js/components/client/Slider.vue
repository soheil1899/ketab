<template>
    <div class="width100 slidertop mb-3">
        <div id="carouselExampleCaptions" class="carousel slide height100" data-ride="carousel">
            <ol class="carousel-indicators pr-0">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner height100">
                <div :class="myclass(index)" v-for="(item, index) in slider">
                    <img :src="'/media/slider/original_' + item.image + '.png'" class="d-block w-100 height100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Slider",
        data(){
            return{
                slider: [],
            }
        },
        methods:{
            myclass(index){
                if (index == 0){
                    return 'carousel-item height100 active';
                }else{
                    return 'carousel-item height100';
                }
            }
        },
        mounted() {
            let that = this;

            axios.post('/getslider')
                .then(function (response) {
                    that.slider = response.data;
                });
        }
    }
</script>

<style scoped>

</style>
