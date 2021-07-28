<template>
    <div class="row">
            <div v-for="product in products" :key="product.id" class="col-md-3 col-6 mb-3 col-sm-6">
                <div class="card h-100 border-0 shadow rounded-md">
                    <div class="card-img">
                        <img :src="product.image"
                            class="w-100">
                    </div>
                    <div class="card-body">
                        <router-link :to="{name: 'detail_product', params:{slug: product.slug }}" class="card-title font-weight-bold" style="font-size:20px">
                            {{ product.title }}
                        </router-link>
 
                        <div class="discount mt-2" style="color: #999"><s>Rp. {{ moneyFormat(product.price) }}</s> <span
                                style="background-color: darkorange" class="badge badge-pill badge-success text-white">DISKON
                                {{ product.discount }} %</span>
                        </div>
 
                        <div class="price font-weight-bold mt-3" style="color: #47b04b;font-size:20px">
                            Rp. {{ moneyFormat(calculateDiscount(product)) }}</div>
                        <router-link :to="{name: 'detail_product', params:{slug: product.slug}}" class="btn btn-primary btn-md mt-3 btn-block shadow-md">BELI</router-link>
                    </div>
                </div>
            </div>
        </div>
</template>
 
<script>
 

import { computed, ref } from 'vue'
import { useStore } from 'vuex'
 
export default {
 
 
    setup() {
 
        //store vuex
        const store = useStore()
 
        //computed properti digunakan untuk get data products dari state di module product 
        const products = computed(() => {
            return store.state.product.products
        })
        
        const keywords = ref('')

        function search() {
 
               store.dispatch('product/getSearchProducts', keywords.value)
               
            }

        return {
            store,
            products,
            keywords,
            search
        }
 
    }
 
}
</script>