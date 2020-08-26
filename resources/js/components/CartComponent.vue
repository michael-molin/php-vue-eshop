<template>
    <div class="container">
        <i class="fas fa-shopping-cart"></i>
        <span @addCart="addProduct">{{cartLenght}}</span>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cartLenght: 0,
                shoppingCart: []
            }
        },
        mounted() {
            this.cartLenght = this.shoppingCart.length;
        },

        methods: {
            addProduct(item){
                this.shoppingCart.push(item);
            }
        }
    }
</script>
