import VueCar from 'vue'
import VueMotorcycle from 'vue'
import VueCarSub from 'vue'
// import VueCarGuide from 'vue'
import VueCarModal from 'vue'
import VueMotorcycleModal from 'vue'
import CookieVue from 'vue'
import store from './store'
import VueSimpleAlert from 'vue-simple-alert'
import Inputmask from 'inputmask'

VueCar.component('car-form', require('./components/VueCar').default)
VueMotorcycle.component('motorcycle-form', require('./components/VueMotorcycle').default)
VueCarSub.component('car-sub-form', require('./components/VueCarSub').default)
// VueCarGuide.component('guide-form', require('./components/VueCarGuide').default)
VueCarModal.component('car-modal-form', require('./components/VueCarModal').default)
VueMotorcycleModal.component('motorcycle-modal-form', require('./components/VueMotorcycleModal').default)
CookieVue.component('cookie-content', require('./components/Cookie').default)

if(APP_ENV !== 'production') {

    VueCar.config.productionTip = false
    VueCar.config.devtools = false

    VueMotorcycle.config.productionTip = false
    VueMotorcycle.config.devtools = false

    VueCarSub.config.productionTip = false
    VueCarSub.config.devtools = false

    // VueCarGuide.config.productionTip = false
    // VueCarGuide.config.devtools = false

    VueCarModal.config.productionTip = false
    VueCarModal.config.devtools = false

    VueMotorcycleModal.config.productionTip = false
    VueMotorcycleModal.config.devtools = false

    CookieVue.config.productionTip = false
    CookieVue.config.devtools = false

}

if(document.getElementById('car-lead')) {
    VueCar.use(VueSimpleAlert)
    VueCar.directive('input-mask', {
        bind: function(el) {
            new Inputmask().mask(el)
        }
    })
    new VueCar({store}).$mount('#car-lead')
}

if(document.getElementById('motorcycle-lead')) {
    VueMotorcycle.use(VueSimpleAlert)
    VueMotorcycle.directive('input-mask', {
        bind: function(el) {
            new Inputmask().mask(el)
        }
    })
    new VueMotorcycle({store}).$mount('#motorcycle-lead')
}

if(document.getElementById('car-sub-lead')){
    new VueCarSub({store}).$mount('#car-sub-lead')
}

// if(document.getElementById('guide-lead')){
//     VueCarGuide.directive('input-mask', {
//         bind: function(el) {
//             new Inputmask().mask(el)
//         }
//     })
//     new VueCarGuide({store}).$mount('#guide-lead')
// }

if(document.getElementById('car-modal')){
    VueCarModal.directive('input-mask', {
        bind: function(el) {
            new Inputmask().mask(el)
        }
    })
    new VueCarModal({store}).$mount('#car-modal')
}

if(document.getElementById('motorcycle-modal')){
    VueMotorcycleModal.directive('input-mask', {
        bind: function(el) {
            new Inputmask().mask(el)
        }
    })
    new VueMotorcycleModal({store}).$mount('#motorcycle-modal')
}


if(document.getElementById('cookie')){
    new CookieVue({store}).$mount('#cookie')
}