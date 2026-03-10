<script setup>

import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    product:Object
})

const form = useForm({
    name:props.product.name,
    price:props.product.price,
    unit:props.product.unit,
    description:props.product.description
})

function submit(){

    form.put('/seller/product/'+props.product.id)

}

</script>

<template>

    <div class="container">

        <h1>Редактировать товар</h1>

        <form @submit.prevent="submit">

            <input v-model="form.name">

            <input v-model="form.price">

            <select v-model="form.unit">
                <option value="kg">кг</option>
                <option value="g">гр</option>
            </select>

            <textarea v-model="form.description"></textarea>

            <button>Сохранить</button>

        </form>

    </div>

</template>
