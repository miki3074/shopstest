<script setup>

defineProps({
    product:Object
})

</script>

<template>

    <div class="max-w-6xl mx-auto py-10 grid grid-cols-2 gap-10">

        <img
            :src="'/storage/'+product.image"
            class="rounded-2xl w-full"
        />

        <div>

            <h1 class="text-3xl font-bold mb-4">

                {{ product.name }}

            </h1>

            <p class="text-gray-500 mb-4">

                {{ product.category?.name }}

            </p>

            <p class="text-xl font-bold mb-6">

                {{ product.price }} ₽ / {{ product.unit }}

            </p>

            <p class="mb-6">

                {{ product.description }}

            </p>

            <button
                class="bg-green-500 text-white px-6 py-3 rounded-xl"
            >

                Добавить в корзину

            </button>

        </div>

    </div>

</template>
