<template>
    <div class="container">
      <div v-for='(product, index) in products' :key='index' class="card">
        <h2>Nome: {{product.name}}</h2>
        <!-- <p>Descrizione: {{product.description}}</p> -->
        <small>Prezzo: {{product.price}}</small>

        <!-- al click isOpen diventa il contario -->
        <button @click='isOpen = !isOpen , getThisProduct(product)' type="button" name="button">Visualizza</button>
        <p>{{isOpen}}</p>
        <div v-if='isOpen'>
        <transition class="fade">
            <div class="mask-overlay" @click="isOpen = !isOpen">
                <div class="panel" @click.stop>
                    <h2>{{thisProduct.name}}</h2>
                    <p>{{thisProduct.price}}€</p>
                    <carousel :per-page="1" :autoplay="true" :mouse-drag="true">
                        <slide>
                            <img src="https://picsum.photos/200/300?random=1">
                        </slide>
                        <slide>
                           <img src="https://picsum.photos/200/300?random=2">
                        </slide>
                  </carousel>
                    <p>{{thisProduct.description}}</p>
                    <p>In magazzino: {{thisProduct.stock}}</p>
                </div>
            </div>
        </transition>
        </div>
        <img :src='product.photo' alt="">
      </div>
    </div>
</template>

<style lang="scss">
    .fade {
        transition: opacity 0.9s ease;
    }
    .mask-overlay{
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            display:flex;
            justify-content: center;
            align-items: center;
        }

        .panel {
            width: 300px;
            margin: 0 auto;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
            transition: all 0.3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

</style>


<script>
    import { Carousel, Slide } from 'vue-carousel';   
    export default {
        data() {
          return {
            products : [],
            thisProduct : {},
            isOpen : false // var sentinella
          }

        },
        mounted() {
            // console.log('Welcome Montato');
            axios({
                "method": "GET",
                "url": "api/products",
            }).then((response) => {
                // console.log(response);
                this.products = response.data;
                // console.log(this.products[0].description);

            }).catch((error) => {
                console.log('APi ' + error)
            });
        },
        methods: {
            getThisProduct(item) {
                this.thisProduct=item;
            }
        }
    }
</script>
