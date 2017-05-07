<template>
    <div>
        <div class="gallery" :style="galleryStyle">
            <div class="items"
                 :style="[itemsStyle, { left: shift }]"
                 @mousedown="onMouseDown"
                 @touchstart="onMouseDown"
                 @mouseup="onMouseUp"
                 @touchend="onMouseUp"
                 @mousemove="onMouseMove"
                 @touchmove="onMouseMove"
            >
                <!--
                    Images
                -->
                <figure v-for="image in images" class="item image is-16by10" :style="itemStyle">
                    <img :src="isFs ? image.item_url.full : image.item_url.small" :alt="image.item_alt">
                </figure>
                <!--
                    Video
                -->
                <figure v-for="video in videos" class="item video is-16by10" @click="playback" :style="itemStyle">
                    <video :controls="controls" @ended="endPlayback">
                        <source :src="video.item_url" type="video/mp4">
                    </video>
                    <span class="playback icon is-large" v-if="!controls"><i class="fa fa-youtube-play"></i></span>
                </figure>
                <!--
                    Embeds
                -->
                <figure class="item video is-16by10"
                        v-for="(embed, index) in embeds"
                        :style="itemStyle"
                >
                    <youtube
                            :video-id="embed.item_embed"
                            player-width="100%"
                            player-height="100%"
                            @ready="getPlayers(index, $event)"
                            @playing="playYoutube"
                            @paused="endYoutube"
                    ></youtube>
                    <div class="yt-blocker"
                         v-if="!nowYoutube"
                         @click="hideYtBlocker(index)"
                    ></div>
                </figure>
            </div>
            <!--control-->
            <div class="control prev is-animated" @click="rotate(true)" v-if="itemsLength>1">
            <span class="icon">
                <i class="fa fa-chevron-left"></i>
            </span>
            </div>
            <div class="control next is-animated" @click="rotate()" v-if="itemsLength>1">
            <span class="icon">
                <i class="fa fa-chevron-right"></i>
            </span>
            </div>
            <div class="fs is-animated is-hidden-touch" @click="expand">
                <span class="icon is-medium"><i class="fa" :class="{ 'fa-compress': isFs, 'fa-expand': !isFs }"></i></span>
            </div>
        </div>
        <div class="dots" v-if="itemsLength>1">
            <span class="dot"
                  v-for="index in itemsLength"
                  :class="{ active: index === current+1 }"
                  @click="rotate(false, index-1)"
            ></span>
        </div>
    </div>
</template>

<script>
    import dragMixin from '../../mixins/dragDetect'

    export default {
        props: {
            images: {
                type: Array,
                default: () => null
            },
            videos: {
                type: Array,
                default: () => null
            },
            embeds: {
                type: Array,
                default: () => null
            },
            itemsLength: {
                type: Number,
                required: true
            },
            isFs: {
                type: Boolean,
                default: false
            }

        },
        data(){
            return {
                controls: false,
                nowPlaying: null,
                nowYoutube: null,
                yPlayers: [],
                itemSize: {
                    w: 0,
                    h: 0
                },
                shift: 0,
                current: 0
            }
        },
        computed: {
            galleryStyle(){
                return this.itemSize.w ? { width: this.itemSize.w + 'px', height: this.itemSize.h + 'px' } : null
            },
            itemStyle(){
                return this.itemSize.w ? { width: this.itemSize.w + 'px', height: this.itemSize.h + 'px', paddingTop: this.itemSize.h + 'px', float: 'left' } : null
            },
            itemsStyle(){
                return this.itemSize.w ? { width: (this.itemsLength * this.itemSize.w) + 'px', height: this.itemSize.h + 'px', left: 0 } : null
            }
        },
        methods: {
            setSize(){
                if(this.itemsLength) {
                    this.itemSize.w = 0
                    this.itemSize.h = 0
                    this.$nextTick(() => {
                        let item = this.$el.querySelector('figure.item')
                        this.itemSize.w = item.clientWidth
                        this.itemSize.h = item.clientHeight
                        if (this.current > 0)
                            this.shift = this.getShift(this.shift, false, this.current)
                    })
                }
            },
            expand(){
                this.$emit('expandGallery')
                this.$nextTick(() => {
                    this.setSize()
                })
            },
            getPlayers(index, player){
                this.yPlayers[index] = player
            },
            hideYtBlocker(index){
                if (this.isMove) return false

                let player = this.yPlayers[index]

                this.playYoutube(player)
                player.playVideo()
            },
            playYoutube(player){
                this.nowYoutube = player
            },
            endYoutube(){
                this.nowYoutube = null
            },
            playback(event){
                if (this.isMove) return false

                let video = this.nowPlaying = event.currentTarget.querySelector('video')

                if (video.currentTime > 0 && video.paused === false && video.ended === false){
                    video.pause()
                    this.controls = false
                    this.nowPlaying = null
                } else {
                    video.play()
                    this.controls = true
                }
            },
            endPlayback(){
                this.nowPlaying.currentTime = 0
                this.nowPlaying = null
                this.controls = false
            },
            rotate(isBackward = false, toIndex = false){
                if (this.nowPlaying){
                    this.nowPlaying.pause()
                    this.endPlayback()
                }

                if (this.nowYoutube){
                    this.nowYoutube.stopVideo()
                    this.endYoutube()
                }

                this.shift = this.getShift(this.shift, isBackward, toIndex)
            },
            getShift(pos, isBackward = false, toIndex = false){
                pos = parseInt(pos)
                let shift = this.itemSize.w,
                    total = shift * this.itemsLength

                if(toIndex === false){
                    if(isBackward){
                        (pos < 0) ? this.current-- : this.current = this.itemsLength-1
                    } else {
                        (pos > -(total - shift)) ? this.current++ : this.current = 0
                    }
                } else {
                    this.current = toIndex
                }

                return -(shift * this.current) + 'px'
            },
            onMouseMove(event){
                if (this.moveBlock)
                    return false

                let currentX = this.isTouch ? event.touches[0].clientX : event.clientX
                let moveLength = this.moveStartX - currentX

                if (moveLength > this.moveLengthMin) {
                    this.rotate()
                    this.isMove = true
                    this.onMouseUp()
                } else if (moveLength < -this.moveLengthMin) {
                    this.rotate(true)
                    this.isMove = true
                    this.onMouseUp()
                }
            }
        },
        mixins: [
            dragMixin
        ],
        mounted() {
            this.setSize()
            window.addEventListener('resize', this.setSize)
        },
        beforeDestroy(){
            window.removeEventListener('resize', this.setSize)
        }
    }
</script>

<style scoped lang="scss">
    .gallery{
        position: relative;
        overflow: hidden;
        .fs{
            height: 2rem;
            width: 2rem;
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            background-color: rgba(10,10,10,.25);
            z-index: 1100;
            &:hover{
                transform: scale(1.15);
            }
        }
        .items{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transition: left .25s;
            .video{
                cursor: pointer;
            }
        }
        .control{
            position: absolute;
            width: 2rem;
            height: 2rem;
            color: white !important;
            left: 5px;
            top: calc((100% - 2rem) / 2);
            cursor: pointer;
            background-color: rgba(10,10,10,.25);
            border-radius: 50%;
            padding: 5px 0px 0 2px;
            z-index: 1100;
            &.next{
                left: auto;
                right: 5px;
                padding-left: 5px;
            }
            &:hover{
                transform: scale(1.15);
            }
        }
    }
    .dots{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        background-color: rgba(0,0,0,.2);
        .dot{
            display: inline-flex;
            width: 15px;
            height: 15px;
            border: 3px solid white;
            border-radius: 50%;
            margin: 10px;
            cursor: pointer;
            transition: scale .2s;
            &.active{
                background-color: red;
                transform: scale(1.1);
            }
            &:hover{
                transform: scale(1.25);
            }
        }
    }
    .playback{
        width: 3rem;
        height: 1.5rem;
        position: absolute;
        margin: auto;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        &.icon{
            &.is-large{
                .fa{
                    font-size: 68px;
                    opacity: .81;
                }
            }
        }
    }
    .yt-blocker{
        width: 100%;
        height: 100%;
        z-index: 1100;
        position: absolute;
        top: 0;
    }
</style>