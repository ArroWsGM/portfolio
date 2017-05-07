export default {
    data() {
        return {
            isTouch: false,
            isMove: false,
            moveBlock: true,
            moveLengthMin: 50,
            moveStartX: 0
        }
    },
    methods: {
        onMouseDown(event) {
            if (!this.isTouch)
                event.preventDefault()
            this.moveBlock = this.isMove = false
            this.moveStartX = this.isTouch && event.type === 'touchstart' ? event.touches[0].clientX : event.clientX
        },
        onMouseUp(){
            this.moveBlock = true
        }
    },
    mounted(){
        this.isTouch = 'ontouchstart' in window
    }
}