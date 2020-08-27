<template>
    <div class="cart-component" v-if="products.length>0">
        <i class="fas fa-shopping-cart"></i>
        <span>{{products.length}}</span>
        <div v-for="(product, index) in products" :key="index">
            {{product.name}}
        </div>
        <span v-number="addPrice(products)"> {{price}}</span>
        <button type="button" name="button"> CheckOut </button>
    </div>
</template>

<style>
.cart-component {
    position: fixed;
    right: 0;
    top: 0;
    padding-top: 75px;
    height: 100%;
}
</style>

<script>
    export default {
        data() {
            return {
                price: 0,
                stringa: 'ciao'
            }
        },

        props: ['products'],

        mounted() {                                                             //Si avvia solo alla creazione o montaggio del componente

        },

        methods: {
            addPrice(products) {
                // this.price = parseInt(this.price + prezzo);
                // console.log(parseInt(prezzo));
                this.price=0;
                for (var i = 0; i < products.length; i++) {
                    this.price+= products[i].price;
                }
            }
        }
    }
</script>
