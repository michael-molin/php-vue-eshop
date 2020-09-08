<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <div>
            <i class="fas fa-shopping-cart"></i> {{ $store.state.cart.cartCount }}
            <input type="hidden" name="userId" v-model="userId">
        </div>
        
        <div v-if="$store.state.cart.listProducts.length > 0" class="navbar-dropdown is-boxed is-right side-menu shadow-sm box-cart">

            <!-- con la VAR $store, entro dentro state del file index.js -->
            <div v-for="(item,index) in $store.state.cart.listProducts" :key="index">
                <div class="box-article">
                  <span  class="navbar-item"> {{ item.name }} - {{ item.price }}€</span>
                  <span class="removeBtn" @click="removeFromCart(index)"><i class="fas fa-times"></i></span>
                </div>
            </div>
            <br>
            <span class="navbar-item">
                <div class="box-article">
                  Totale: {{ $store.state.cart.totalPrice }}€
                </div>
            </span>
            <hr class="navbar-divider">
            <div class="box-article navbar-item" @click="paymentsOpen = !paymentsOpen" style="cursor:pointer;">
              <span >
                  Checkout
              </span>
            </div>
            <div v-if='paymentsOpen'>
                <transition class="fade">
                    <div class="mask-overlay" @click="paymentsOpen = !paymentsOpen">
                      <!-- click.stop = ferma esecuzione click mouse, evita che si chiuda cliccando il modale -->
                      <div class="panel" @click.stop>
                        <h3>Totale: {{ $store.state.cart.totalPrice }}€</h3>
                        <h5>Numero Articoli: {{ $store.state.cart.cartCount }}</h5>
                        <div class="form-group text-center">
                            <form>
                                <input class="form-control col-md-6" type="text" name="nm-carta" placeholder="Numero Carta">
                                <input class="form-control col-md-6 " type="text" name="exp-carta" placeholder="Scadenza Carta">
                                <input class="form-control col-md-6" type="text" name="code-carta" placeholder="Codice Segreto">
                                <!-- al click invio carrello all function payment -->
                                <input @click='payment()' class="btn btn-primary col-md-6" name="" value="Paga">
                            </form>
                            <div class="credit">
                              <i class="fab fa-cc-mastercard"></i>
                              <i class="fab fa-cc-visa"></i>
                              <i class="fab fa-paypal"></i>
                            </div>
                        </div>
                      </div>
                  </div>
                </transition>
            </div>
        </div>
    </div>
</template>


<script>

    export default {
        props: ['app'], // prendo i dati inseriti nel file app.blade
        data() {
            return {
                paymentsOpen : false,
                userId: this.$userId
            }
        },

        mounted() {   //Si avvia solo alla creazione o montaggio del componente

        },

        methods: {
            removeFromCart(index) {
                console.log(index); // prende l' indice dell array di oggetti = nome + prezzo
                // console.log(this.$store.state); // restituisce array degli oggetti nel carrello
                this.$store.commit('removeFromCart', index); // rimuove il valore relativo all index
            },

            payment() {
              this.$store.state.cart.userId = this.userId;
              var cart = this.$store.state.cart;
              var self = this;      //Per richiamare this all'interno di Axios, bisogna salvare this in una variabile e richiamarla dopo
              // console.log(cart); // carrello disponibile in tutto VUE

              axios.post('api/checkout', cart) // chiamata post, endpoint e variabile
              .then(function (response) {
               // window.location.href = "checkout"; // simile al link
               console.log(this);   //This all'interno di .then non è il this dell'esterno
               self.$store.commit('resetCart');
               self.paymentsOpen = false;

              })
              .catch(function (error) {
                  console.log(error);
              })


            },

            resetVueCart() {
                this.$store.commit('resetCart');
                this.paymentsOpen = false;
                alert('pagamento effettuato');
            }


        }
    }
</script>


<style>
    .removeBtn {
        margin-right: 1rem;
        color: red;
        cursor: pointer;
    }

    .side-menu {
        position: fixed;
        top: 0;
        right: 0;
        height: 100%;
        width: 500px;
        padding-top: 150px;
        z-index: 0;
    }

    .mask-overlay{
            position: fixed;
            z-index: 9998;
            top: 0px;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.9);
            display:flex;
            justify-content: center;
            align-items: center;
        }

        .panel {
            z-index: 9999;
            text-align: center;
            width: 85vw;
            height: 85vh;
            margin: 0 auto;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
            transition: all 0.3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

        form {
          display: flex;
          flex-direction: column;
          align-items: center;

        }

        form input {
          margin: 10px;
        }

        .credit .fab {
          font-size: 50px;
          padding: 5px;
          color: #3490dc;
          cursor: pointer;
        }

        .credit .fab:hover {
          color: blue;
        }

        .box-article {
          display: flex;
          justify-content: space-around;
          align-items: center;
          margin-bottom: 3px;
          background-color: white;
          border: 1px solid rgba(0,0,0,0.1);
          height: 50px;
        }

        .box-cart {
          background: rgb(255,255,255);
          background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(200,200,200,1) 100%);
          /* margin-top: 78px; */
          padding-top: 3px;
        }

        .fa-times {
          color: red;
          font-size: 20px;
        }

</style>
