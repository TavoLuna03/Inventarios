<template>
    <div class="columns">
        <div class="column" v-if="isLoading">Loading players...</div>
        <div class="column" v-else>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="purchase in purchases">
                    <tr v-bind:key="purchase.id">
                        <td>{{ purchase.id }}</td>
                        <td>{{ purchase.name }}</td>
                        <!-- <td>{{ category.answers }}</td>
                        <td>{{ category.points }}</td> -->
                        <td>
                        <!-- <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, true)">(+1) Right</button>&nbsp;
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, false)">(-1) Wrong</button>&nbsp; -->
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isDeleting(purchase.id) }" @click="deletePurchase(purchase.id)">Delete purchase</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
     
        </div>
        <div class="column">
            <h1 class="title">Add Purchase</h1>
            <purchase-form @completed="addPurchase"></purchase-form>
        </div> 
    </div>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'
import PurchaseForm from './PurchaseForm.vue'
import Vue from 'vue'

export default {
    components: {
        PurchaseForm
    },
    data() {
        return {
            isLoading: true,
            question: null,
            purchases: {}
        }
    },
    async created () {
        // this.getQuestion()
        axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
        try {
            const response = await axios.get(API_BASE_URL + '/orders')
            this.purchases = response.data.data
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
        addPurchase(puchase) {
            this.purchases.push(puchase)
        },
        isDeleting(id) {
            let index = this.purchases.findIndex(puchase => puchase.id === id)
            return this.purchases[index].isDeleting
        },
        async deleteCategory(id) {
            let index = this.purchases.findIndex(puchase => puchase.id === id)
            Vue.set(this.purchases[index], 'isDeleting', true)
            const response = await axios.delete(API_BASE_URL + '/orders/' + id)
            this.purchases.splice(index, 1)
        },
        isCountUpdating(id) {
            let index = this.purchases.findIndex(puchase => puchase.id === id)
            return this.purchases[index].isCountUpdating
        },
  
    }
}
</script>
