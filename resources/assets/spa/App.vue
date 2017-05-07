<template>
    <section class="hero is-fullheight" :class="{ 'is-black': lightsOff }">
        <arr-header></arr-header>
        <!-- Hero content: will be in the middle -->
        <div class="hero-body is-paddingless">
            <div class="container has-text-centered is-fluid">
                <div v-if="!error404">
                    <transition name="slide" mode="out-in">
                        <router-view></router-view>
                    </transition>
                </div>
                <h2 v-else>{{ i18n.notrespond }}</h2>
            </div>
        </div>
        <arr-footer></arr-footer>
    </section>
</template>

<script>
    import arrCarousel from './components/arrcarousel/Carousel.vue'
    import { _bus } from './_bus'
    export default {
        data(){
            return {
                error404: false,
                lightsOff: true,
                locale: null
            }
        },
        methods: {
            getProjects(){
                axios.get('projects/' + this.locale)
                    .then(response => {
                        _bus.$emit('projectsLoaded', response.data)
                    })
                    .catch(error => {
                        console.log('Error:', error.message);
                        this.error404 = true
                    })
            }
        },
        computed: {
            i18n(){
                return _bus.i18n[_bus.locale]
            }
        },
        created(){
            _bus.$on('setLocale', data => this.locale = data)

            _bus.$on('lightsChange', event => this.lightsOff = !event)

            _bus.getLocale()
                .then(data => {
                    this.locale = data

                    this.getProjects()
                })
        },
        components: {
            arrCarousel
        }
    }
</script>

<style scoped lang="scss">
    .slide-enter{
        transform: translateX(50%);
        opacity: 0;
    }
    .slide-enter-active, .slide-leave-active{
        transition: .25s;
    }
    .slide-enter-to, .slide-leave{
        transform: translateX(0%);
        opacity: 1;
    }
    .slide-leave-to{
        transform: translateX(-50%);
        opacity: 0;
    }
    .hero{
        transition: color, background-color 1s;
    }
</style>