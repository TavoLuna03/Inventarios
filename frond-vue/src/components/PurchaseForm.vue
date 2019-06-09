<template>
    <table class="table">
        <thead>
            <tr>
                <td><strong>Product</strong></td>
                <td><strong>Quatity</strong></td>
                <td><strong>Total</strong></td>
                <td><strong>Action</strong></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
              <!-- <form @submit.prevent="onSubmit"> -->
            <tr v-for="row in rows">
                <td><select v-model="product_id">
                            <option v-for="item in products" :value="item.id" :key="item.id">
                                {{ item.name }} $ {{item.price}}
                            </option>
                        </select></td>
                <td><input type="number" v-model="row.quantity"></td>
                <td></td>
                <td><a v-on:click="removeElement(row);" style="cursor: pointer">Remove</a></td>
            </tr>
            <tr>
                <td><button class="button btn-primary" @click="addRow">Add row</button></td>
              
            </tr>
          <!-- </form> -->
              <td><button class="button btn-primary" v-bind:class="{ 'is-loading' : isLoading }">Buy</button></td>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'
import func from './vue-temp/vue-editor-bridge';

export default {

    data() {
        return {
            isLoading: false,
             rows: []
        }
    },
    async created () {
        
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
        addRow: function () {
            this.rows.push({ title: "", description: "" });
        },
        removeElement: function (row) {
            var index = this.rows.indexOf(row);
            this.rows.splice(index, 1);
        },
         onSubmit() {
            this.isLoading = true
          
        }
    }
    
}
</script>
