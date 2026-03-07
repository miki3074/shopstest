<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name:'',
    description:'',
    price:''
})

function submit(){
    form.post('/products')
}
</script>

<template>

    <h1>Create Product</h1>

    <form @submit.prevent="submit">

        <input v-model="form.name" placeholder="name">
        <textarea v-model="form.description"></textarea>
        <input v-model="form.price" type="number">

        <button>Create</button>

    </form>

</template>
