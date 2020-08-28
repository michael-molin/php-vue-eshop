<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="">
            Cart {{ $store.state.cartCount }}
        </a>

        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <a v-for="(item,index) in $store.state.cart" :key="index" class="navbar-item" href="">
                {{ item.name }} - ${{ item.price }} <br>
                <!-- <span class="removeBtn" title="Remove from cart" @click.prevent="removeFromCart(item)">X</span> -->
            </a>
            <br>
            <a class="navbar-item" href="">
                Total: ${{ $store.state.totalPrice }}
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item" @click="toCheckout($store.state)" href="">
                Checkout
            </a>
        </div>

        <div v-else class="navbar-dropdown is-boxed is-right">
            <a class="navbar-item" href="">
                Cart is empty
            </a>
        </div>
    </div>
</template>

<style>
    .removeBtn {
        margin-right: 1rem;
        color: red;
    }
</style>

<script>
    export default {
        data() {
            return {
            }
        },


        mounted() {                                                             //Si avvia solo alla creazione o montaggio del componente

        },

        methods: {
            removeFromCart(item) {
                this.$store.commit('removeFromCart', item);
            },

            toCheckout(cart) {
                // let data = {
                //     cart: JSON.stringify(this.$store.state)
                // }
                // axios.post('checkout', data);
                axios({
                    method: 'post',
                    url: 'api/checkout',
                    data: {
                        cart: JSON.stringify(this.$store.state.cart)
                    }
                }).then((response) => {
                    console.log(response);

                }).catch((error) => {
                    console.log('checkout ' + error)
                });
            }
        }
    }
</script>
