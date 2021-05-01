import Router from 'vue-router'
import Admin from './components/Admin.vue'
import Place from './components/Place.vue'
import PhotoDisplay from './components/PhotoDisplay.vue'

export default new Router({
  //mode: 'history',
  
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: Admin
    },
    {
      path: '/place',
      name: 'place',
      component: Place
    },
    {
      path: '/photo-display',
      name: 'photo-display',
      component: PhotoDisplay
    },
  ]
});