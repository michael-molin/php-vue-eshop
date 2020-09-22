<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <div>
          <div @click="cartIsOpen = !cartIsOpen" class="btn btn-danger">
            <i class="fas fa-shopping-cart" ></i> {{ $store.state.cart.cartCount }}
          </div>
          <input type="hidden" name="userId" v-model="userId">
        </div>
        
        <div v-show="cartIsOpen" class="navbar-dropdown is-boxed is-right side-menu shadow-sm  box-cart navbar-light bg-white shadow-sm ">

            <!-- con la VAR $store, entro dentro state del file index.js -->
            
            <div v-for="(item,index) in $store.state.cart.listProducts" :key="index">
                <div class="box-article">
                  <span  class="navbar-item"> {{ item.name }} - {{ item.price }}€</span>
                  <span class="removeBtn" @click="removeFromCart(index)"><i class="fas fa-times"></i></span>
                </div>
            </div>
            <div class="navbar-item box-article checkout-section">
              <h4>Totale: {{ $store.state.cart.totalPrice }}€</h4>
              <div @click="paymentsOpen = !paymentsOpen" style="cursor:pointer;" class="btn btn-danger">Checkout </div>
            </div>

            
            <div v-show='paymentsOpen'>
                <transition class="fade">
                    <div class="mask-overlay" @click="paymentsOpen = !paymentsOpen">
                      <!-- click.stop = ferma esecuzione click mouse, evita che si chiuda cliccando il modale -->
                      <div class="panel" @click.stop>
                        <h3>Totale: {{ $store.state.cart.totalPrice }}€</h3>
                        <h5>Numero Articoli: {{ $store.state.cart.cartCount }}</h5>
                        <div class="form-group text-center">
                            <div>
                              <div class="card-header"></div>
                              <p>Per pagamento a buon fine: 4242 4242 4242 4242</p>
                              <p>Per pagamento rifiutato: 4000 0000 0000 9995</p>
                              <div class="card-body">
                                  <Label for="card-holder-name"> Nome Titolare Carta: </Label>
                                  <input id="card-holder-name" type="text">
                                  <div id="card" ref="card"></div>
                                  <button id="card-button" @click="toPayment" :disabled="isDisable"> 
                                      <i class="fab fa-cc-stripe" v-if="isPay"></i>
                                      <i class="fas fa-spinner" id="loading" v-if="isLoading"></i>
                                      <i class="fas fa-check-circle" v-if="isOk"></i>
                                      <i class="fas fa-times" v-if="isError"></i>
                                  </button>
                              </div>
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
                cartIsOpen : false,
                spk:'pk_test_51HMa46FUEyYvJlZwxKqaMFLFSJ8cci1OWaA0Adeavbtm2M8AEkShK10Hlijudr0m7NFYRCllxhIumqWa6Ib0i9Az00pEC788en',
                stripe: '',
                card: '',
                isPay: true,
                isLoading : false,
                isOk : false,
                isError : false,
                isDisable : false,
                paymentsOpen : false,
                userId: this.$userId
            }
        },

        mounted () {   //Si avvia solo alla creazione o montaggio del componente
          var self=this;
            self.stripe= Stripe(self.spk);
            self.card = self.stripe.elements().create('card', {
                hidePostalCode : true,
            });
            console.log(self.card);
            self.card.mount(self.$refs.card);
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
              console.log(cart); // carrello disponibile in tutto VUE

              axios.post('api/checkout', cart) // chiamata post, endpoint e variabile
              .then(function (response) {
              window.location.href = "checkout"; // simile al link
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
            },

            async toPayment() {
                this.$store.state.cart.userId = this.userId;
                var cart = this.$store.state.cart;
                var self = this;
                this.isDisable=true;
                this.isPay= false;
                this.isLoading= true;
                const cardButton = document.getElementById('card-button');
                const cardHolderName = document.getElementById('card-holder-name');
                const { paymentMethod, error } = await this.stripe.createPaymentMethod({
                    type: 'card',
                    card: this.card,
                    billing_details: {
                        name: cardHolderName.value,
                    }
                });

                if (error) {
                    this.isLoading = false;
                    this.isError = true;
                    alert('Errore pagamento');

                    
                } else {
                    var payData = {
                        pay : paymentMethod,
                        cart: cart
                    }
                    console.log(payData);
                    axios.post('api/checkout', payData).then(response => {
                        if(response.status=== 200) {
                            this.isLoading= false;
                            this.isOk= true;
                            self.$store.commit('resetCart');
                            this.isLoading= false;
                            this.isOk= true;
                        }
                    })
                }
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
        top: 65px;
        right: 0;
        height: 100%;
        width:200px;
        padding-top: 30px;
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

          height: 50px;
        }

        .box-cart {
          background: white;
          
        }

        .fa-times {
          color: red;
          font-size: 20px;
        }

        .checkout-section {
          display: flex;
          flex-direction: column;
          position: fixed;
          bottom: 30px;
          width: 200px;
          margin: 0 auto;
          text-align: center;
        }

</style>
