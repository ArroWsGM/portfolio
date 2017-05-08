<template>
    <div class="content is-medium mtop-20 mbot-20 pside-20">
        <div class="loader is-large is-centered" v-if="!project && !error404"></div>
        <div class="" v-if="error404" v-html="error404text">Page not found</div>
        <template v-if="project && !error404">
            <div class="columns is-multiline">
                <div class="column is-12">
                    <h2 class="heading-main sub is-marginless">{{ project.project_name }}</h2>
                </div>
                <div class="column"
                     v-if="itemsLength"
                    :class="{ 'is-half-tablet': !expanded, 'is-12-tablet is-8-desktop is-offset-2': expanded }"
                >
                    <arr-gallery
                            :images="images"
                            :videos="videos"
                            :embeds="embeds"
                            :itemsLength="itemsLength"
                            :isFs="expanded"
                            @expandGallery="expanded = !expanded"
                    ></arr-gallery>
                </div>
                <div class="column has-text-left"
                     :class="{ 'is-12': expanded || !itemsLength }"
                >
                    <p class="link" v-if="project.project_link">
                        <span class="icon"><i class="fa fa-link text-red"></i></span> <a
                            :href="project.project_link"
                            v-html="project.project_link"
                            target="_blank"></a>
                    </p>
                    <p class="devices"
                       v-if="devices"><span class="text-red">{{ i18n.devices }}:</span> <arr-tooltip class="has-text-centered"
                                                                v-for="device in devices"
                                                                :tooltip="device.property_name"
                                                                :key="device.id"
                                                        ><span class="icon is-medium"><i :class="[device.property_class]"></i></span>
                                                        </arr-tooltip>
                    </p>
                    <p class="browsers"
                       v-if="browsers"><span class="text-red">{{ i18n.browsers }}:</span> <arr-tooltip class="has-text-centered"
                                                                v-for="item in browsers"
                                                                :tooltip="item.property_name"
                                                                :key="item.id"
                                                        ><span class="icon is-medium"><i :class="[item.property_class]"></i></span>
                                                        </arr-tooltip>
                    </p>
                    <p class="text-red" v-if="tech">{{ i18n.tech }}:</p>
                    <ul class="technologies list-unstyled"
                        v-if="tech"
                    >
                        <li v-for="item in tech">
                            <span class="icon is-medium"><i class="text-red" :class="[item.property_class]"></i></span>&nbsp;{{ item.property_name }}
                        </li>
                    </ul>
                </div>
                <div class="column is-12 has-text-left" v-if="project.project_description">
                    <h3>{{ i18n.description }}</h3>
                    <div v-html="project.project_description"></div>
                </div>
            </div>
        </template>
        <div class="back-to-main">
            <router-link to="/">
                <span class="icon"><i class="fa fa-arrow-left"></i></span>
                <span class="text">{{ i18n.back }}</span>
            </router-link>
        </div>
    </div>
</template>

<script>
    import { _bus } from '../../_bus'
    import arrTooltip from '../elements/Tooltip.vue'
    import arrGallery from '../arrgallery/Gallery.vue'
    export default {
        props: ['slug'],
        data(){
            return {
                project: null,
                error404: false,
                expanded: false
            }
        },
        computed: {
            itemsLength(){
                let len = 0

                if (this.images)
                    len += this.images.length

                if (this.videos)
                    len += this.videos.length

                if (this.embeds)
                    len += this.embeds.length

                return len
            },
            images(){
                if(this.project && this.project.galleries.length) {
                    let images = this.project.galleries.filter(item => item.item_type === 'img')
                    return images.length ? images : null
                } else return null
            },
            videos(){
                if(this.project && this.project.galleries.length) {
                    let videos = this.project.galleries.filter(item => item.item_type === 'video')
                    return videos.length ? videos : null
                } else return null
            },
            embeds(){
                if(this.project && this.project.galleries.length) {
                    let embeds = this.project.galleries.filter(item => item.item_type === 'video_embed')
                    return embeds.length ? embeds : null
                } else return null
            },
            devices(){
                if(this.project && this.project.properties.length) {
                    let devices = []
                    this.project.properties.forEach(item => {
                        if (item.property.property_group === 'device')
                            devices.push(item.property)
                    })
                    return devices.length ? devices : null
                } else return null
            },
            browsers(){
                if(this.project && this.project.properties.length) {
                    let browsers = []
                    this.project.properties.forEach(item => {
                        if (item.property.property_group === 'browser')
                            browsers.push(item.property)
                    })
                    return browsers.length ? browsers : null
                } else return null
            },
            tech(){
                if(this.project && this.project.properties.length) {
                    let tech = []
                    this.project.properties.forEach(item => {
                        if (item.property.property_group === 'technology')
                            tech.push(item.property)
                    })
                    return tech.length ? tech : null
                } else return null
            },
            i18n(){
                return _bus.i18n[_bus.locale]
            },
            error404text(){
                return this.i18n.page404.replace('%s', '<code>' + this.$route.path + '</code>')
            }

        },
        created(){
            if (_bus.slug === this.slug && _bus.project)
                this.project = _bus.project
            else {
                let url = 'project/' + this.slug + '/' + _bus.locale
                axios.get(url)
                    .then(response => {
                        _bus.$emit('projectLoad', {
                            project: response.data,
                            slug: this.slug
                        })
                        this.project = response.data
                    })
                    .catch(error => {
                        console.log('Error:', error.message);
                        this.error404 = true
                    });
            }
        },
        components: {
            arrTooltip,
            arrGallery
        }
    }
</script>

<style scoped lang="scss">
    .link a{
        word-break: break-all;
        transition: color .25s;
    }
    .link a:hover{
        color: red;
    }
    .back-to-main{
        display: flex;
        align-items: center;
        margin: auto;
        padding-right: 5px;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        height: 39px;
        background-color: red;
        cursor: pointer;
        z-index: 2100;
        @media screen and (orientation: portrait) {
            top: 5px;
            bottom: auto;
        }
        a{
            display: flex;
            align-items: center;
            .icon{
                .fa{
                    color: white;
                }
            }
            .text{
                display: inline-flex;
                opacity: 0;
                color: white;
                width: 0;
                transition: width 0.25s;
                overflow: hidden;
                text-align: right;
            }
        }
        &:hover{
            .text{
                width: 55px;
                opacity: 1;
            }
        }
    }
</style>