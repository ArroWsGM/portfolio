<template>
    <span
            @mouseenter="attachTooltip"
            @mouseleave="detachTooltip"
    >
        <slot
        >{{ tooltip }}</slot>
        <transition>
            <span class="tooltip top"
                              v-if="show"
                              :style="offset"
                        >
                <span class="tooltip-arrow"></span>
                <span class="tooltip-inner">{{ tooltip }}</span>
            </span>
        </transition>
    </span>
</template>

<script>
    export default {
        props: {
            tooltip: {
                type: String,
                default: 'Tooltip'
            }
        },
        data(){
            return {
                show: false,
                offset: null
            }
        },
        methods:{
            attachTooltip(){
                this.show = true
                this.$nextTick(
                    () => this.offset = { left: (this.$el.clientWidth / 2) - (this.$el.querySelector('.tooltip').clientWidth / 2) + 'px'}
                )
            },
            detachTooltip(){
                this.show = false
                this.offset = null
            }
        }
    }
</script>

<style scoped>
    span{
        position: relative;
        display: inline-block;
    }
    span.tooltip {
        position: absolute;
        top: -100%;
        left: 0;
        z-index: 1070;
        display: block;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 12px;
        font-style: normal;
        font-weight: normal;
        line-height: 1.42857143;
        text-align: left;
        text-align: start;
        text-decoration: none;
        text-shadow: none;
        text-transform: none;
        letter-spacing: normal;
        word-break: normal;
        word-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        line-break: auto;
    }
    span.tooltip.top {
        padding: 5px 0;
        margin-top: -3px;
    }
    span.tooltip-inner {
        max-width: 200px;
        padding: 3px 8px;
        color: #333;
        text-align: center;
        background-color: #eee;
        border-radius: 4px;
    }
    span.tooltip-arrow {
        position: absolute;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
    }
    span.tooltip.top span.tooltip-arrow {
        bottom: 0;
        left: 50%;
        margin-left: -5px;
        border-width: 5px 5px 0;
        border-top-color: #eee;
    }
    .v-enter, .v-leave-to{
        opacity: 0;
    }
    .v-enter-to, .v-leave{
        opacity: .9;
    }
    .v-enter-active, .v-leave-active{
        transition: opacity .3s;
    }
</style>