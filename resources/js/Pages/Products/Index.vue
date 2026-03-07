<script setup>
defineProps({
    products:Array
})
</script>

<template>

    <h1>Products</h1>

    <div v-for="p in products" :key="p.id">

        <h3>{{p.name}}</h3>
        <p>{{p.price}}</p>

    </div>

</template>
