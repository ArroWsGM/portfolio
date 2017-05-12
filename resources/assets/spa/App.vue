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
        <transition>
            <arr-alert
                    v-if="alertShow"
                    @inforemerHide="alertShow = false"
                    type="warning"
                    :prefix="i18n.warning"
                    :dismissable="false"
                    :timer="10"
            >
                <span v-html="i18n.oldbrowser"></span>
            </arr-alert>
        </transition>
    </section>
</template>

<script>
    import arrCarousel from './components/arrcarousel/Carousel.vue'
    import arrAlert from './components/elements/Alert.vue'
    import { _bus } from './_bus'
    export default {
        data(){
            return {
                error404: false,
                lightsOff: true,
                locale: null,
                alertShow: false
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

            if(isOldBrowser)
                this.alertShow = true
        },
        components: {
            arrCarousel,
            arrAlert
        }
    }
</script>