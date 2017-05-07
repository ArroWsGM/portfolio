<template>
    <article class="message"
             :class="[alertClass]"
             :style="alertStyle"
    >
        <div class="message-header">
            <p><strong v-if="prefix">{{ prefix }}</strong> <slot></slot></p>
            <button class="delete" v-if="dismissable" @click="dismiss"></button>
        </div>
    </article>
</template>

<script>
    export default{
        props: {
            top: {
                type: Boolean,
                default: true
            },
            dismissable: {
                type: Boolean,
                default: true
            },
            type: {
                type: String,
                default: ''
            },
            prefix: {
                type: String,
                default: ''
            }
        },
        computed:{
            alertClass(){
                switch(this.type){
                    case 'primary':
                        return 'is-primary'
                    case 'success':
                        return 'is-success'
                    case 'danger':
                        return 'is-danger'
                    case 'warning':
                        return 'is-warning'
                    case 'info':
                        return 'is-info'
                    case 'dark':
                        return 'is-dark'
                    default:
                        return ''
                }
            },
            alertStyle(){
                return this.top ? { top: 0, left: 0 } : { bottom: 0, left:0 }
            }
        },
        methods:{
            dismiss(){
                this.$emit('inforemerHide')
            }
        }
    }
</script>

<style scoped>
    article.message{
        position: fixed;
        width: 100%;
        z-index: 1200;
    }
</style>