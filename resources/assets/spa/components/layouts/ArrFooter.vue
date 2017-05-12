<template>
    <!-- Hero footer: will stick at the bottom -->
    <div class="hero-foot">
        <div class="tile">
            <div class="tile is-parent">
                <div class="tile is-child is-adaptive">©ArroWs-Dev, 2014-{{ new Date().getFullYear() }}</div>
            </div>
            <div class="tile is-vertical is-parent">
                <div class="tile is-child has-text-right is-touch-left is-adaptive">
                    <p>Valery CMS <span class="text-red" v-if="version">{{ version }} (<span @click.ctrl="show = true" style="cursor: pointer">"{{ build }}"</span>)</span> powered by&nbsp;<a class="text-red" href="https://laravel.com/" target="_blank" rel="nofollow"><i class="arricon arricon-laravel arricon-beat" aria-hidden="true"></i></a></p>
                </div>
                <div class="tile is-child has-text-right is-touch-left is-adaptive">
                    <p>
                        <arr-tooltip tooltip="Webpack"><i class="arricon arricon-webpack"></i></arr-tooltip>
                        <arr-tooltip tooltip="ES6"><i class="arricon arricon-js"></i></arr-tooltip>
                        <arr-tooltip tooltip="Vue"><i class="arricon arricon-vue"></i></arr-tooltip>
                        <arr-tooltip tooltip="Bulma: a flexbox framework"><i class="arricon arricon-bulma"></i></arr-tooltip>
                        <arr-tooltip tooltip="HTML5"><i class="fa fa-html5"></i></arr-tooltip>
                        <arr-tooltip tooltip="CSS3"><i class="fa fa-css3"></i></arr-tooltip>
                        <arr-tooltip tooltip="See on Github"><a href="https://github.com/ArroWsGM"><i class="fa fa-github"></i></a></arr-tooltip>
                        <a href="/old" class="mleft-10">{{ i18n.old }} <i class="fa fa-hand-o-left" aria-hidden="true"></i></a>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal is-active" v-if="show && promo">
            <div class="modal-background" @click="show = false"></div>
            <div class="modal-content">
                <p class="video is-16by10">
                    <iframe :src="promo" frameborder="0" width="100%" height="100%"></iframe>
                </p>
            </div>
            <button class="modal-close" @click="show = false"></button>
        </div>
    </div>
</template>

<script>
    import arrTooltip from '../elements/Tooltip.vue'
    import { _bus } from '../../_bus'
    export default{
        data(){
            return{
                version: '',
                build: '',
                promo: '',
                show: false
            }
        },
        computed: {
            i18n(){
                return _bus.i18n[_bus.locale]
            }
        },
        created(){
            axios.get('versioninfo')
                .then(response => {
                    this.version = response.data.cms_version
                    this.build = response.data.cms_build
                    this.promo = response.data.cms_promo + '?autoplay=1'
                })
        },
        components: {
            arrTooltip
        }
    }
</script>

<style scoped>
    @media screen and (min-width: 769px) {
        .modal-content{
            width: 60%;
        }
    }
</style>