import Vue from 'vue'
import Vuex from 'vuex'
import createCache from 'vuex-cache'

import main from './modules/main'

Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    plugins: [
        createCache()
    ],
    modules: {
        main,
    }
})
