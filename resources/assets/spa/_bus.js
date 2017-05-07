import Vue from 'vue'
import axios from 'axios'
import { apiUrl } from './main'
axios.defaults.baseURL = apiUrl
window.axios = axios
import Cookies from './classes/cookies/Cookies'
import i18n from './i18n'

export const _bus = new Vue({
    data: {
        projects: [],
        project: null,
        slug: '',
        idx: 0,
        locale: null,
        cookies: new Cookies(),
        i18n: i18n
    },
    methods: {
        getLocale(){
            return new Promise(resolve => {
                if(this.locale === null && !this.cookies.has('locale')) {
                    axios.get('locale')
                        .then(response => {
                            this.locale = response.data
                            this.cookies.set('locale', this.locale, 365)
                            resolve(this.locale)
                        })
                        .catch(error => {
                            console.log(error)
                            this.locale = 'en'
                            this.cookies.set('locale', this.locale, 365)
                            resolve('en')
                        })
                } else if(this.locale === null && this.cookies.has('locale')) {
                    this.locale = this.cookies.get('locale')
                    resolve(this.locale)
                } else {
                    resolve(this.locale)
                }
            })
        }
    },
    created(){
        this.$on('projectsLoaded', projects => this.projects = projects)
        this.$on('projectLoad', data => {
            this.project = data.project
            this.slug = data.slug
        })
        this.$on('currentIndex', data => this.idx = data)
        this.$on('changeLocale', data => {
            document.documentElement.lang = data
            this.locale = data
            this.cookies.set('locale', this.locale, 365)
        })
    }
})