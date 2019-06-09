<template>
    <div class="columns">
        <div class="column" v-if="isLoading">Loading players...</div>
        <div class="column" v-else>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Number Lote</th>
                    <th>Expiration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="product in products">
                    <tr v-bind:key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.category_id }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.description }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.number_lote }}</td>
                        <td>{{ product.expiration_date }}</td>
                        <!-- <td>{{ category.answers }}</td>
                        <td>{{ category.points }}</td> -->
                        <td>
                        <!-- <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, true)">(+1) Right</button>&nbsp;
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, false)">(-1) Wrong</button>&nbsp; -->
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isDeleting(product.id) }" @click="deleteProduct(product.id)">Delete product</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
      
        </div>
        <div class="column">
            <h1 class="title">Add product to the invetario</h1>
            <!-- <div class="card"> -->
                 <product-form @completed="addProduct"></product-form>
            <!-- </div> -->
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'
import ProductForm from './ProductForm.vue'
import Vue from 'vue'

export default {
    components: {
        ProductForm
    },
    data() {
        return {
            isLoading: true,
            question: null,
            products: {}
        }
    },
    async created () {
        // this.getQuestion()
        axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
        try {
            const response = await axios.get(API_BASE_URL + '/products')
            this.products = response.data.data
            this.isLoading = false
        } catch (e) {
            // handle the authentication error here
        }
    },
    methods: {
        // async getQuestion() {
        //     delete axios.defaults.headers.common.Authorization
        //     this.doGetQuestion()
        //     axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
        // },
        // async doGetQuestion() {
        //     try {
        //         const response = await axios.get(TRIVIA_ENDPOINT, {
        //             headers: {
        //                 'Content-Type': 'application/x-www-form-urlencoded'
        //             }
        //         })
        //         this.question = response.data[0]
        //     } catch (e) {
        //         // handle errors here
        //     }
        // },
        addProduct(product) {
            this.products.push(product)
        },
        isDeleting(id) {
            let index = this.products.findIndex(product => product.id === id)
            return this.products[index].isDeleting
        },
        async deleteProduct(id) {
            let index = this.products.findIndex(product => product.id === id)
            Vue.set(this.products[index], 'isDeleting', true)
            const response = await axios.delete(API_BASE_URL + '/products/' + id)
            this.products.splice(index, 1)
        },
        isCountUpdating(id) {
            let index = this.products.findIndex(product => product.id === id)
            return this.products[index].isCountUpdating
        },
        // async answer(id, isCorrectAnswer) {
        //     let data = {
        //         correct: isCorrectAnswer
        //     }
        //     let index = this.players.findIndex(player => player.id === id)
        //     Vue.set(this.players[index], 'isCountUpdating', true)
        //     const response = await axios.post(API_BASE_URL + '/players/' + id + '/answers', data)
        //     this.players[index].answers = response.data.data.answers
        //     this.players[index].points = response.data.data.points
        //     this.players[index].isCountUpdating = false
        // }
    }
}
</script>
