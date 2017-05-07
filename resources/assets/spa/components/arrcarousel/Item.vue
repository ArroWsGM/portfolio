<template>
    <div class="carousel-item"
         :class="[currentClass]"
         :style="currentStyle"
         @click.stop="showItem"
    >
        <figure class="image is-square">
            <img :src="item.img" :alt="item.project.name">
        </figure>
        <figure class="caption">
            <h3 class="title">{{ item.project.name }}</h3>
            <p class="subtitle" v-if="item.project.description">{{ item.project.description }}</p>
        </figure>
    </div>
</template>

<script>
    import { _bus } from '../../_bus'
    export default {
        props: {
            item: {
                type: Object,
                required: true
            },
            index: {
                type: Number,
                required: true
            },
            itemsLength: {
                type: Number,
                required: true
            },
            ar: {
                type: Number,
                required: true
            },
            isMoveEvent: {
                type: Boolean,
                required: true
            }
        },
        data() {
            return {
                localIndex: this.index,
                isBackward: false
            }
        },
        computed: {
            currentClass(){
                if(this.itemsLength > 3)
                    switch (this.localIndex) {
                        case 0:
                            return 'first'
                        case 1:
                            return 'second'
                        case 2:
                            return this.itemsLength > 5 ? 'third' : ''
                        case this.itemsLength-1:
                            return 'last'
                        case this.itemsLength-2:
                            return this.itemsLength > 5 ? 'secondlast' : ''
                        default: return ''
                    }
                else
                    switch (this.localIndex) {
                        case 0:
                            return 'flipper current'
                        case 1:
                            return 'flipper next'
                        default: return 'flipper'
                    }
            },
            currentStyle(){
                let style = {}

                if (this.localIndex === 0)
                    style.cursor = 'pointer'

                if(this.itemsLength > 3){
                    if (this.currentClass === 'last' && this.itemsLength < 6)
                        style.zIndex = this.isBackward ? '81' : '79'

                    if (this.itemsLength > 5) {
                        if (this.currentClass === 'second') {
                            style.transform = this.ar >= 1 ? 'translate3d(30vh, 0, -32vh)' : 'translate3d(20vw, 0, -32vw)'
                        } else if (this.currentClass === 'last') {
                            style.transform = this.ar >= 1 ? 'translate3d(-30vh, 0, -32vh)' : 'translate3d(-20vw, 0, -32vw)'
                        }
                    }
                }

                return style
            }
        },
        methods: {
            showItem(){
                if (this.isMoveEvent || this.localIndex !== 0)
                    return false

                this.$router.push('project/' + this.item.slug)
            }
        },
        created(){
            _bus.$on('changeIndex', isBackward => {
                this.isBackward = isBackward

                isBackward ?
                    (this.localIndex === 0 ? this.localIndex = (this.itemsLength-1) : this.localIndex--) :
                    (this.localIndex === (this.itemsLength-1) ? this.localIndex = 0 : this.localIndex++)

            })
        },
        mounted(){
            if (_bus.idx) {
                this.localIndex = (this.localIndex - _bus.idx) >= 0 ?
                    this.localIndex - _bus.idx :
                    (this.itemsLength+this.localIndex) - _bus.idx
            }
        },
        beforeDestroy(){
            if(this.currentClass === 'first' || this.currentClass === 'flipper current') {
                _bus.$emit('currentIndex', this.index)
            }
        }
    }
</script>