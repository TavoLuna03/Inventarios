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
                <template v-for="category in categories">
                    <tr v-bind:key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <!-- <td>{{ category.answers }}</td>
                        <td>{{ category.points }}</td> -->
                        <td>
                        <!-- <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, true)">(+1) Right</button>&nbsp;
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isCountUpdating(category.id) }" @click="answer(category.id, false)">(-1) Wrong</button>&nbsp; -->
                        <button class="button is-primary" v-bind:class="{ 'is-loading' : isDeleting(category.id) }" @click="deleteCategory(category.id)">Delete category</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
     
        </div>
        <div class="column">
            <h1 class="title">Add Category</h1>
            <category-form @completed="addCategory"></category-form>
        </div> 
    </div>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'
import CategoryForm from './CategoryForm.vue'
import Vue from 'vue'

export default {
    components: {
        CategoryForm
    },
    data() {
        return {
            isLoading: true,
            question: null,
            categories: {}
        }
    },
    async created () {
        // this.getQuestion()
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
        addCategory(category) {
            this.categories.push(category)
        },
        isDeleting(id) {
            let index = this.categories.findIndex(category => category.id === id)
            return this.categories[index].isDeleting
        },
        async deleteCategory(id) {
            let index = this.categories.findIndex(player => player.id === id)
            Vue.set(this.categories[index], 'isDeleting', true)
            const response = await axios.delete(API_BASE_URL + '/categories/' + id)
            this.categories.splice(index, 1)
        },
        isCountUpdating(id) {
            let index = this.categories.findIndex(player => player.id === id)
            return this.categories[index].isCountUpdating
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
