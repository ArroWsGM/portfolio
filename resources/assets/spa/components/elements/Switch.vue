<template>
    <label class="switch">
        <input type="checkbox"
               :checked="localChecked"
               @change="switcher"
        >
        <div class="slider" :class="{ rounded: isRounded }" :style="{backgroundColor: localChecked ? colorOn : colorOff}"></div>
    </label>
</template>

<script>
    export default{
        model: {
            prop: 'checked',
            event: 'change'
        },
        props:{
            isRounded: {
                type: Boolean,
                default: true
            },
            colorOff: {
                type: String,
                default: '#aaa'
            },
            colorOn: {
                type: String,
                default: '#337ab7'
            },
            checked: {
                type: Boolean,
                default: false
            }
        },
        data(){
            return {
                localChecked: this.checked
            }
        },
        methods:{
            switcher(){
                this.localChecked = !this.localChecked
                this.$emit('change', this.localChecked)
            }
        }
    }
</script>

<style scoped>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 2rem;
        height: calc(1rem + 4px);
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: calc(1rem - 4px);
        width: calc(1rem - 4px);
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(calc(1rem - 4px));
        -ms-transform: translateX(calc(1rem - 4px));
        transform: translateX(calc(1rem - 4px));
    }

    /* Rounded sliders */
    .slider.rounded {
        border-radius: calc(1rem + 4px);
    }

    .slider.rounded:before {
        border-radius: 50%;
    }
</style>