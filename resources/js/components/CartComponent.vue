<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <div>
            <i class="fas fa-shopping-cart"></i> {{ $store.state.cartCount }}
        </div>
        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right side-menu bg-white shadow-sm">
            <div v-for="(item,index) in $store.state.cart" :key="index">
                <span  class="navbar-item"> {{ item.name }} - {{ item.price }}€</span>
                <span class="removeBtn" @click="removeFromCart(index)">X</span>
            </div>
            <br>
            <span class="navbar-item">
                Totale: {{ $store.state.totalPrice }}€
            </span>
            <hr class="navbar-divider">
            <span class="navbar-item" @click="paymentsOpen = !paymentsOpen" style="cursor:pointer;">
                Checkout
            </span>

            <div v-if='paymentsOpen'>
                <transition class="fade">
                    <div class="mask-overlay" @click="paymentsOpen = !paymentsOpen">
                      <div class="panel" @click.stop>
                        <h3>Totale: {{ $store.state.totalPrice }}€</h3>
                        <h5>Numero Articoli: {{ $store.state.cartCount }}</h5>
                        <div class="form-group text-center">
                            <form>
                                <input class="form-control col-md-6" type="text" name="nm-carta" placeholder="Numero Carta">
                                <input class="form-control col-md-6 " type="text" name="exp-carta" placeholder="Scadenza Carta">
                                <input class="form-control col-md-6" type="text" name="code-carta" placeholder="Codice Segreto">
                                <input class="btn btn-primary" type="submit" name="" value="Paga">
                            </form>
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
        data() {
            return {
                paymentsOpen : false
            }
        },


        mounted() {                                                             //Si avvia solo alla creazione o montaggio del componente

        },

        methods: {
            removeFromCart(index) {
                this.$store.commit('removeFromCart', index);
            },

            toCheckout(cart) {
                axios.post('api/checkout', cart)
                .then(function (response ) {
                 console.log(response.config);
                 // window.location.href = "checkout";
                })
                .catch(function (error) {
                    console.log(error);
                })
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
        padding-top: 80px;
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

</style>
