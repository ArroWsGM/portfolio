let metaElement = document.querySelector('meta[property="api:url"]')
let metaContent = metaElement && metaElement.getAttribute('content')

export const apiUrl = metaContent ? metaContent : 'http://z.dtest.in.ua/api/1.0/'

import axios from 'axios'
axios.defaults.baseURL = apiUrl
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios = axios


import Vue from 'vue'


import App from './App.vue'

import { router } from './router/router'

import VueYouTubeEmbed from 'vue-youtube-embed'
Vue.use(VueYouTubeEmbed)

import arrHeader from './components/layouts/ArrHeader.vue'
import arrFooter from './components/layouts/ArrFooter.vue'
Vue.component('arr-header', arrHeader)
Vue.component('arr-footer', arrFooter)

new Vue({
    el: '#app',
    router,
    render: h => h(App)
})
