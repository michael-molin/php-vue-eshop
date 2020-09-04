// store/index.js
// JS e VUE
let cart = window.localStorage.getItem('cart');      //          //Salvataggio pt3: init variabile, prende l'elemento 'cart' dallo storage della pagina
let cartCount = window.localStorage.getItem('cartCount');       //Salvataggio pt3: init variabile, prende l'elemento 'cartCount' dallo storage della pagina
let totalPrice = window.localStorage.getItem('totalPrice');     //Salvataggio pt3: init variabile, prende l'elemento 'cartCount' dallo storage della pagina
import Vue from "vue";
import Vuex from "vuex"; // comando instalazione VUEX

Vue.use(Vuex);

export default new Vuex.Store({
 state: { // simile al data di VUE
     cart: {
         listProducts: cart ? JSON.parse(cart) : [],               //Salvataggio pt4: operatore ternario, se Json.parse(cart) ESISTE, assume il valore del carrello. ALTRIMENTI è un array vuoto
         cartCount: cartCount ? parseInt(cartCount) : 0,           //Salvataggio pt4: operatore ternario, se parseInt(cartCount) ESISTE, assume il valore del CartCount. ALTRIMENTI è 0
         totalPrice: cartCount ? parseInt(totalPrice) : 0,
         userId: 0
     }

 },
 getters: {},
 mutations: { // methods, tutte le funzioni necessitano dello STATE
        storeProduct(state, item) {
            state.cart.totalPrice= 0;
            state.cart.listProducts.push(item);
            state.cart.cartCount= state.cart.listProducts.length;
            for (var i = 0; i < state.cart.listProducts.length; i++) {
                state.cart.totalPrice += state.cart.listProducts[i].price; // somma il prezzo di ogni elemento del carrello
            }
            state.cart.totalPrice = state.cart.totalPrice.toFixed(2);
            this.commit('saveCart');  //Salvataggio pt1: Spedisce il contenuto alla mutazione saveCart
        },

        removeFromCart(state, index) {

            if (index > -1) {
                state.cart.listProducts.splice(index, 1);
                state.cart.cartCount= state.cart.listProducts.length;
                state.cart.totalPrice= 0;
                for (var i = 0; i < state.cart.listProducts.length; i++) {
                    state.cart.totalPrice += state.cart.listProducts[i].price;
                }
                state.cart.totalPrice = state.cart.totalPrice.toFixed(2);
                this.commit('saveCart'); // invoca la MUTATIONS senza passargli dati , li prende dallo state
            }
        },

        saveCart(state) {
            window.localStorage.setItem('cart', JSON.stringify(state.cart.listProducts));    //Salvataggio pt2: setta il tutto in uno storage della pagina del broweser sottoforma di Json
            window.localStorage.setItem('cartCount', state.cart.cartCount);          //Salvataggio pt2: setta il tutto in uno storage della pagina del broweser
            window.localStorage.setItem('totalPrice', state.cart.totalPrice);          //Salvataggio pt2: setta il tutto in uno storage della pagina del broweser
        },
    },
 actions: {}
});
