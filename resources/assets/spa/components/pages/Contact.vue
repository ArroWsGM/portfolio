<template>
    <div class="container mbot-25" style="padding: 0 20px;">
        <div class="loader is-large is-centered" v-if="loading"></div>
        <template v-else>
            <h3 class="heading-main sub">{{ i18n.leavemessage }}</h3>
            <!--
                From
            -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label"><arr-required :tooltip="i18n.required">{{ i18n.from }}*</arr-required></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" :placeholder="i18n.fromplaceholder"
                                   :class="{ 'is-danger': validation.hasError('message.name') || (response.e422 && response.e422.name), 'is-success': validation.isPassed('message.name') }"
                                   v-model.trim="message.name"
                            >
                            <span class="icon is-small is-left">
                            <i class="fa fa-user"></i>
                        </span>
                            <span class="icon is-small is-right is-danger" v-if="validation.hasError('message.name') || (response.e422 && response.e422.name)">
                            <i class="fa fa-warning"></i>
                        </span>
                            <span class="icon is-small is-right is-success" v-if="validation.isPassed('message.name')">
                            <i class="fa fa-check"></i>
                        </span>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.name')">{{ i18n.validatename }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.name">{{ response.e422.name[0] }}</p>
                    </div>
                </div>
            </div>
            <!--
                Email
            -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="email" placeholder="alex@smith.com"
                                   :class="{
                                        'is-danger': (validation.hasError('message.email') && message.email.length > 0) || (response.e422 && response.e422.email),
                                        'is-success': validation.isPassed('message.email') && message.email.length > 0
                               }"
                                   v-model.trim="message.email"
                            >
                            <span class="icon is-small is-left">
                            <i class="fa fa-envelope"></i>
                        </span>
                            <span class="icon is-small is-right is-danger"
                                  v-if="(validation.hasError('message.email') && message.email.length > 0) || (response.e422 && response.e422.email)"
                            >
                            <i class="fa fa-warning"></i>
                        </span>
                            <span class="icon is-small is-right is-success" v-if="validation.isPassed('message.email') && message.email.length > 0">
                            <i class="fa fa-check"></i>
                        </span>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.email')">{{ i18n.validateemail }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.email">{{ response.e422.email[0] }}</p>
                    </div>
                </div>
            </div>
            <!--
                Phone
            -->
            <div class="field is-horizontal" v-if="!isOldBrowser">
                <div class="field-label is-normal">
                    <label class="label">{{ i18n.phone }}</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <masked-input class="input" type="tel" placeholder="+380(xx)xxx-xx-xx"
                                          :class="{
                                        'is-danger': (validation.hasError('message.phone') && message.phone.length > 0) || (response.e422 && response.e422.phone),
                                        'is-success': validation.isPassed('message.phone') && message.phone.length > 0
                                    }"
                                          v-model.trim="message.phone"
                                          mask="\+\380(11)111-11-11"
                            ></masked-input>
                            <span class="icon is-small is-left">
                            <i class="fa fa-phone-square"></i>
                        </span>
                            <span class="icon is-small is-right is-danger"
                                  v-if="(validation.hasError('message.phone') && message.phone.length > 0) || (response.e422 && response.e422.phone)"
                            >
                            <i class="fa fa-warning"></i>
                        </span>
                            <span class="icon is-small is-right is-success" v-if="validation.isPassed('message.phone') && message.phone.length > 0">
                            <i class="fa fa-check"></i>
                        </span>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.phone')">{{ i18n.validatephone }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.phone">{{ response.e422.phone[0] }}</p>
                    </div>
                </div>
            </div>
            <!--
                Phone old browsers
            -->
            <div class="field is-horizontal" v-if="isOldBrowser">
                <div class="field-label is-normal">
                    <label class="label">{{ i18n.phone }}</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="tel" placeholder="+380(xx)xxx-xx-xx"
                                   :class="{
                                        'is-danger': (validation.hasError('message.phone') && message.phone.length > 0) || (response.e422 && response.e422.phone),
                                        'is-success': validation.isPassed('message.phone') && message.phone.length > 0
                                    }"
                                   v-model.trim="message.phone"
                            >
                            <span class="icon is-small is-left">
                            <i class="fa fa-phone-square"></i>
                        </span>
                            <span class="icon is-small is-right is-danger"
                                  v-if="(validation.hasError('message.phone') && message.phone.length > 0) || (response.e422 && response.e422.phone)"
                            >
                            <i class="fa fa-warning"></i>
                        </span>
                            <span class="icon is-small is-right is-success" v-if="validation.isPassed('message.phone') && message.phone.length > 0">
                            <i class="fa fa-check"></i>
                        </span>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.phone')">{{ i18n.validatephone }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.phone">{{ response.e422.phone[0] }}</p>
                    </div>
                </div>
            </div>
            <!--
                Subject
            -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label"><arr-required :tooltip="i18n.required">{{ i18n.subject }}*</arr-required></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" type="text" :placeholder="i18n.subjectplaceholder"
                                   :class="{ 'is-danger': (validation.hasError('message.subject')) || (response.e422 && response.e422.subject), 'is-success': validation.isPassed('message.subject') }"
                                   v-model.trim="message.subject"
                            >
                            <span class="icon is-small is-left">
                            <i class="fa fa-tag"></i>
                        </span>
                            <span class="icon is-small is-right is-danger" v-if="validation.hasError('message.subject') || (response.e422 && response.e422.subject)">
                            <i class="fa fa-warning"></i>
                        </span>
                            <span class="icon is-small is-right is-success" v-if="validation.isPassed('message.subject')">
                            <i class="fa fa-check"></i>
                        </span>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.subject')">{{ i18n.validatesubject }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.subject">{{ response.e422.subject[0] }}</p>
                    </div>
                </div>
            </div>
            <!--
                Message
            -->
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label"><arr-required :tooltip="i18n.required">{{ i18n.message }}*</arr-required></label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                        <textarea class="textarea" :placeholder="i18n.messageplaceholder"
                                  :class="{ 'is-danger': validation.hasError('message.message') || (response.e422 && response.e422.message), 'is-success': validation.isPassed('message.message') }"
                                  v-model.trim="message.message"
                        ></textarea>
                        </div>
                        <p class="help is-danger has-text-left" v-if="validation.hasError('message.message')">{{ i18n.validatemessage }}</p>
                        <p class="help is-danger has-text-left" v-if="response.e422 && response.e422.message">{{ response.e422.message[0] }}</p>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <!-- Left empty for spacing -->
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <router-link
                                    class="button is-danger is-outlined is-animated"
                                    :to="'/'"
                            >
                                <span class="icon"><i class="fa fa-arrow-left" aria-hidden="true"></i></span>
                                <span>{{ i18n.back }}</span>
                            </router-link>
                            <button class="button is-success is-outlined is-animated is-pulled-right"
                                    :disabled="disabled"
                                    @click="submit"
                            >
                                <span style="display: inline-flex; align-items: center; justify-content: center;"><!--Firefox < 52 <button> and <input type="button"> display property bug fix-->
                                    <span>{{ i18n.send }}</span>
                                    <span class="icon"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <transition>
            <arr-alert
                    v-if="alertShow"
                    @inforemerHide="hideAlert"
                    :type="alertType"
                    :prefix="alertPrefix"
            >
                {{ alertMessage }}
            </arr-alert>
        </transition>
    </div>
</template>

<script>
    import MaskedInput from 'vue-masked-input'
    import arrRequired from '../elements/Tooltip.vue'
    import arrAlert from '../elements/Alert.vue'
    import { _bus } from '../../_bus'
    import { mixin } from 'simple-vue-validator'
    import { Validator } from 'simple-vue-validator'
    export default {
        data() {
            return {
                message: {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                },
                submitted: false,
                response: {},
                loading: false,
                alertShow: false,
                alertType: '',
                alertPrefix: '',
                alertMessage: ''
            }
        },
        computed: {
            disabled(){
                return !(this.validation.isPassed('message.name') &&
                        (this.message.email.length === 0 || this.validation.isPassed('message.email')) &&
                        (this.message.phone.length === 0 || this.validation.isPassed('message.phone')) &&
                        this.validation.isPassed('message.subject') &&
                        this.validation.isPassed('message.message'))
            },
            i18n(){
                return _bus.i18n[_bus.locale]
            },
            isOldBrowser(){
                return isOldBrowser
            }
        },
        watch: {
            message: {
                handler: 'resetFormStatus',
                deep: true
            }
        },
        methods: {
            hideAlert(){
                this.alertShow = false
                this.alertMessage = ''
                this.alertType = ''
                this.alertPrefix = ''
            },
            resetForm(){
                this.message = {
                    name: '',
                    email: '',
                    phone: '',
                    subject: '',
                    message: ''
                }
            },
            resetFormStatus(){
                this.submitted = false
                this.response = {}
            },
            submit(){
                if(this.submitted) return

                this.submitted = true
                this.response = {}

                this.$validate()
                    .then(success => {
                        if (success) {
                            this.loading = true
                            this.hideAlert()
                            axios.post('message/' + _bus.locale, this.message)
                                .then(response => {
                                    this.loading = false
                                    this.resetForm()
                                    this.validation.reset()
                                    this.$nextTick(()=> {
                                        this.response['success'] = response.data
                                    })
                                    this.alertType = 'success'
                                    this.alertPrefix = this.i18n.success
                                    this.alertMessage = response.data.message
                                    this.alertShow = true
                                })
                                .catch(error => {
                                    this.loading = false
                                    if(error.response.status === 422) {
                                        this.$set(this.response, 'e422', error.response.data)
                                        this.alertType = 'danger'
                                        this.alertPrefix = this.i18n.error
                                        this.alertMessage = this.i18n.validateerrors
                                        this.alertShow = true
                                    } else if(error.response.status === 418) {
                                        this.resetForm()
                                        this.validation.reset()
                                        this.$nextTick(()=>{
                                            this.$set(this.response, 'e418', error.response.data)
                                            _bus.$emit('showAlert', {
                                            })
                                        })
                                        this.alertType = 'danger'
                                        this.alertPrefix = this.i18n.error
                                        this.alertMessage = error.response.data.message
                                        this.alertShow = true
                                    } else {
                                        console.log(error.response.status)
                                        console.log(error.response.data)
                                        this.validation.reset()
                                        this.$set(this.response, 'error', error.response.data)
                                        this.alertType = 'danger'
                                        this.alertPrefix = this.i18n.error
                                        this.alertMessage = this.i18n.error500
                                        this.alertShow = true
                                    }
                                })
                        }
                    })
            }
        },
        validators: {
            'message.name': value => Validator.value(value).required().lengthBetween(2,128),
            'message.email': value => Validator.value(value).email(),
            'message.phone': value => Validator.value(value).regex(/^\+380\([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/),
            'message.subject': value => Validator.value(value).required().lengthBetween(3,128),
            'message.message': value => Validator.value(value).required().minLength(10),
        },
        components: {
            MaskedInput,
            arrRequired,
            arrAlert
        },
        mixins: [
            mixin
        ]
    }
</script>

<style scoped>
    .v-enter{
        transform: translateY(-50px);
        opacity: 0;
    }
    .v-enter-active, .v-leave-active{
        transition: .25s;
    }
    .v-enter-to, .v-leave{
        transform: translateY(0);
        opacity: 1;
    }
    .v-leave-to{
        transform: translateY(-50px);
        opacity: 0;
    }
</style>