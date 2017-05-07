<template>
    <!-- Hero header: will stick at the top -->
    <div class="hero-head">
        <header class="nav bordered">
            <div class="container is-fluid">
                <div class="nav-left is-hidden-touch">
                    <span class="nav-item">
                        <a :class="{ 'is-active': locale === 'en' }"
                           @click="setLocale('en')"
                        >EN</a>
                        <span class="mside-5">|</span>
                        <a :class="{ 'is-active': locale === 'uk' }"
                           @click="setLocale('uk')"
                        >UA</a>
                    </span>
                    <span class="nav-item">
                        <span class="icon is-small"><i class="fa fa-moon-o" aria-hidden="true"></i></span>
                        <arr-switch colorOn="red" class="mside-5" @change="lightsOff"></arr-switch>
                        <span class="icon is-small"><i class="fa fa-sun-o" aria-hidden="true"></i></span>
                    </span>

                </div>
                <div class="nav-center">
                    <h1 class="nav-item heading-main"><router-link :to="'/'" class="text-red">{{ i18n.title }}</router-link></h1>
                </div>
                <span class="nav-toggle" @click="toggled = !toggled">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <div class="nav-right nav-menu is-animated" :class="{'is-active': toggled}">
                    <span class="nav-item">
                        <a
                                class="button is-danger is-outlined is-animated"
                                @click="goContact"
                        >
                            <span class="icon">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            <span>{{ i18n.contactme }}</span>
                        </a>
                    </span>
                    <span class="nav-item" v-if="toggled">
                        <a :class="{ 'is-active': locale === 'en' }"
                           @click="setLocale('en')"
                        >EN</a>
                        <span class="mside-5">|</span>
                        <a :class="{ 'is-active': locale === 'uk' }"
                           @click="setLocale('uk')"
                        >UA</a>
                    </span>
                    <span class="nav-item is-hidden-desktop">
                        <span class="icon is-small"><i class="fa fa-moon-o" aria-hidden="true"></i></span>
                        <arr-switch colorOn="red" class="mside-5" @change="lightsOff"></arr-switch>
                        <span class="icon is-small"><i class="fa fa-sun-o" aria-hidden="true"></i></span>
                    </span>
                </div>
            </div>
        </header>
    </div>
</template>

<script>
    import arrSwitch from '../elements/Switch.vue'
    import { _bus } from '../../_bus'
    export default{
        data(){
            return {
                toggled: false,
                locale: null
            }
        },
        computed:{
            i18n(){
                return _bus.i18n[_bus.locale]
            }
        },
        methods: {
            close(){
                this.toggled = false
            },
            goContact(){
                this.close()
                this.$router.push('/contact')
            },
            lightsOff(event){
                _bus.$emit('lightsChange', event)
                this.close()
            },
            setLocale(locale){
                this.locale = locale
                _bus.$emit('changeLocale', locale)
                this.close()
            }
        },
        components: {
            arrSwitch
        },
        created(){
            _bus.$on('setLocale', data => this.locale = data)

            if(_bus.cookies.has('locale'))
                this.locale = _bus.cookies.get('locale')
            else {
                _bus.getLocale()
                    .then(data => {
                        this.locale = data
                    })
            }
        }
    }
</script>

<style scoped>
    .nav.bordered{
        height: auto;
        min-height: 3.25rem;
    }
</style>