import arrCarousel from '../components/arrcarousel/Carousel.vue'
import arrProject from '../components/pages/Project.vue'
import arrContact from '../components/pages/Contact.vue'
import app404 from '../components/404.vue'

export const routes = [
    {path: '', component: arrCarousel},
    {path: '/project/:slug', name: 'project', component: arrProject, props: true},
    {path: '/contact', component: arrContact},
    {path: '*', component: app404, props: true}
]