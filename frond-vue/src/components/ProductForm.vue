<template>
    <form @submit.prevent="onSubmit">
        <span class="help is-danger" v-text="errors"></span>
            <div class="control">
                <div class="field">
                    <div class="control">
                        <input class="input" type="name" placeholder="Name" v-model="name" >
                    </div>
                </div>

                 <div class="field">
                    <div class="control">
                        <select v-model="category_id">
                            <option v-for="item in categories" :value="item.id" :key="item.id">
                                {{ item.name }}
                            </option>
                        </select>

                    </div>
                </div>

                <div class="field">
                    <div class="control ">
                        <input class="input" type="price" placeholder="Price"  v-model="price"  >
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <textarea class="textarea" placeholder="description"   v-model="description" ></textarea>
                    </div>
                </div>

                <div class="field">
                    <div class="controlt">
                        <input class="input" type="quantity" placeholder="quantity"  v-model="quantity">
                    </div>
                </div>

                 <div class="field">
                    <div class="control">
                        <input class="input" type="number_lote" placeholder="number lote"  v-model="number_lote">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="label">Expiration date</label>
                        <input class="datetime" type="date" placeholder="expiration date"  v-model="expiration_date">
                    </div>
                </div>
                 <div class="field">
                    <button class="button is-primary" v-bind:class="{ 'is-loading' : isLoading }">Add product</button>
                </div>
            </div>
    </form>
</template>
<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'

export default {
    data() {
        return {
            name: '',
            price: '',
            description: '',
            quantity: '',
            number_lote: '',
            errors: '',
            isLoading: false,
            category_id: '',
            categories: '',
            expiration_date: ''
        }
    },
    async created () {
        
        axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
        try {
            const response = await axios.get(API_BASE_URL + '/categories')
            this.categories = response.data.data
            this.isLoading = false
        } catch (e) {
            // handle the authentication error here
        }
    },
    methods: {
        onSubmit() {
            this.isLoading = true
            this.postProduct()
        },
        async postProduct() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${await this.$auth.getAccessToken()}`
            axios.post(API_BASE_URL + '/products', this.$data)
                .then(response => {
                    this.name = ''
                    this.price = ''
                    this.description = ''
                    this.quantity = ''
                    this.number_lote = ''
                    this.category_id = ''
                    this.categories = ''
                    this.expiration_date =  ''
                    this.isLoading = false
                    this.$emit('completed', response.data.data)
                })
                .catch(error => {
                    // handle authentication and validation errors here
                    this.errors = error.response.data.errors
                    this.isLoading = false
                })
        }
    }
    
}
</script>
