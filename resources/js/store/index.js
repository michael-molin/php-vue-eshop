// store/index.js

import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
 state: {
     product: {
         name: "",
         description: "",
         price: ""
     }
 },
 getters: {},
 mutations: {},
 actions: {}
});
