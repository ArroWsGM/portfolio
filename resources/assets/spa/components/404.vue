<template>
    <div>
        <h2>404</h2>
        <p class="mtop-50" v-html="text"></p>
        <p class="mtop-50">
            <router-link
                    class="button is-danger is-outlined is-animated"
                    :to="'/'"
            >
                <span class="icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
                <span>{{ i18n.back }}</span>
            </router-link>
        </p>
    </div>
</template>

<script>
    import { _bus } from '../_bus'
    export default{
        computed: {
            i18n(){
                return _bus.i18n[_bus.locale]
            },
            text(){
                return this.i18n.page404.replace('%s', '<code>' + this.$route.path + '</code>')
            }
        }
    }
</script>