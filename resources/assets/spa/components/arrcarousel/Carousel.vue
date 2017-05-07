<template>
    <div class="carousel"
         :style="{ height: height + 'px' }"
         @mousedown="onMouseDown"
         @touchstart="onMouseDown"
         @mouseup="onMouseUp"
         @touchend="onMouseUp"
         @mousemove="onMouseMove"
         @touchmove="onMouseMove"
    >
        <div class="loader is-large is-centered"
             v-if="!itemsLength"
             :style="{ 'margin-top': (height/2) + 'px' }"
        ></div>
        <arr-carousel-item
                v-if="itemsLength"
                v-for="(item, index) in carousel"
                :item="item"
                :index="index"
                :itemsLength="itemsLength"
                :ar="aspect"
                :isMoveEvent="isMove"
                :key="item.id"
        ></arr-carousel-item>

        <div class="control prev is-animated" @click="rotate(true)" v-if="itemsLength>1">
            <span class="icon is-medium">
                <i class="fa fa-chevron-left"></i>
            </span>
        </div>
        <div class="control next is-animated" @click="rotate()" v-if="itemsLength>1">
            <span class="icon is-medium">
                <i class="fa fa-chevron-right"></i>
            </span>
        </div>
    </div>
</template>
<script>
    import arrCarouselItem from './Item.vue'
    import { _bus } from '../../_bus'
    import dragMixin from '../../mixins/dragDetect'

    export default {
        data() {
            return {
                carousel: [],
                height: 0,
                width: 0,
                aspect: 0
            }
        },
        computed: {
            itemsLength() {
                return this.carousel.length
            }
        },
        methods: {
            rotate(isBackward = false) {
                if (this.itemsLength>1)
                    _bus.$emit('changeIndex', isBackward)
            },
            getParentSize(node, height = true) {

                if (node && node.parentNode && height) {
                    return node.parentNode.clientHeight > 0 ?
                        parseInt(window.getComputedStyle(node.parentNode).getPropertyValue('height')) :
                        this.getParentSize(node.parentNode)
                } else if (node && node.parentNode) {
                    return node.parentNode.clientWidth > 0 ?
                        parseInt(window.getComputedStyle(node.parentNode).getPropertyValue('width')) :
                        this.getParentSize(node.parentNode, false)
                } else return 0
            },
            setSize() {
                this.width = this.height = 0
                this.$nextTick(() => {
                    this.width = this.getParentSize(this.$el, false)
                    this.height = this.getParentSize(this.$el)
                })
                this.aspect = window.innerWidth / window.innerHeight
            },
            onMouseMove(event){
                if (this.moveBlock)
                    return false

                let currentX = this.isTouch ? event.touches[0].clientX : event.clientX
                let moveLength = this.moveStartX - currentX

                if (moveLength > this.moveLengthMin) {
                    this.rotate(true)
                    this.isMove = true
                    this.onMouseUp()
                } else if (moveLength < -this.moveLengthMin) {
                    this.rotate()
                    this.isMove = true
                    this.onMouseUp()
                }
            }
        },
        components: {
            arrCarouselItem
        },
        mixins: [
            dragMixin
        ],
        created(){
            _bus.$on('projectsLoaded', projects => this.carousel = projects)
        },
        mounted(){
            this.setSize()

            window.addEventListener('resize', this.setSize)

            if (!this.carousel.length)
                this.carousel = _bus.projects
        },
        beforeDestroy(){
            window.removeEventListener('resize', this.setSize)
        }
    }
</script>

<style lang="scss">
    .carousel{
        perspective: 1000px;
        min-height: 60vh;
        overflow: hidden;
        .control{
            position: absolute;
            width: 3rem;
            height: 3rem;
            color: white;
            left: 0;
            top: calc((100% - 3rem) / 2);
            cursor: pointer;
            background-color: rgba(10,10,10,.25);
            border-radius: 50%;
            padding: 9px 0px 0 5px;
            z-index: 1100;
            &.next{
                left: auto;
                right: 0;
                padding-left: 9px;
            }
            &:hover{
                transform: scale(1.15);
            }
        }
        .carousel-item{
            $width: 60vh;
            width: $width;
            position: absolute;
            top: calc((100% - #{$width}) / 2);
            left: calc(50% - #{$width/2});
            visibility: hidden;
            transition: all .3s ease-out;
            transform-style: preserve-3d;
            transform: translateX(0) translateZ(-55vh);
            z-index: 50;
            background-color: red;
            .caption{
                width: 100%;
                position: absolute;
                bottom: 0;
                padding: 0 10px 10px;
                background-color: rgba(128,0,0,.8);
                h3.title{
                    text-align: left;
                    font-size: 1rem;
                    color: white;
                    @media screen and (min-width: 769px) {
                        font-size: 1.5rem;
                    }
                    @media screen and (min-width: 1000px) {
                        font-size: 2rem;
                    }
                    &:last-child{
                        margin-bottom: 25px;
                    }
                }
                p.subtitle{
                    text-align: left;
                    font-size: .65rem;
                    color: rgba(255, 255, 255, 0.9);
                    @media screen and (min-width: 769px) {
                        font-size: .9rem;
                    }
                    @media screen and (min-width: 1000px) {
                        font-size: 1.25rem;
                    }
                }
            }
            @media screen and (orientation: portrait) {
                $width: 60vw;
                width: $width;
                top: calc((100% - #{$width}) / 2);
                left: calc(50% - #{$width/2});
            }
            &.first{
                visibility: visible;
                transform: translateX(0) translateZ(0);
                z-index: 99;
            }
            &.second{
                visibility: visible;
                transform: translateX(45vh) translateZ(-35vh);
                z-index: 80;
                @media screen and (orientation: portrait) {
                    transform: translateX(20vh) translateZ(-35vh);
                }
            }
            &.third{
                visibility: visible;
                transform: translateX(55vh) translateZ(-55vh);
                z-index: 75;
                @media screen and (orientation: portrait) {
                    transform: translateX(15vw) translateZ(-55vw);
                }
            }
            &.last{
                visibility: visible;
                transform: translateX(-45vh) translateZ(-35vh);
                z-index: 79;
                @media screen and (orientation: portrait) {
                    transform: translateX(-20vh) translateZ(-35vh);
                }
            }
            &.secondlast{
                visibility: visible;
                transform: translateX(-55vh) translateZ(-55vh);
                z-index: 74;
                @media screen and (orientation: portrait) {
                    transform: translateX(-15vw) translateZ(-55vw);
                }
            }
            &.flipper{
                transform: translateZ(0) rotateY(-180deg);
                backface-visibility: hidden;
                &.current{
                    visibility: visible;
                    transform: rotateY(0deg);
                    z-index: 51;
                }
                &.next{
                    visibility: visible;
                    transform: rotateY(-180deg);
                }
            }
        }
    }
</style>