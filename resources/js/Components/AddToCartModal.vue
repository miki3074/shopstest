<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    show: Boolean,
    product: Object
})

const emit = defineEmits(['close'])

const quantity = ref(1)

// Проверка доступного количества
watch(quantity, (val) => {
    if (val < 1) quantity.value = 1
    if (props.product.stock && val > props.product.stock) quantity.value = props.product.stock
})

function addToCart() {
    router.post(`/cart/add/${props.product.id}`, { quantity: quantity.value })
    emit('close')
}
</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl w-80 p-6 relative">
            <button @click="emit('close')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

            <img :src="'/storage/'+product.image" class="w-full h-40 object-cover rounded-xl mb-4"/>
            <h3 class="text-xl font-bold mb-2">{{ product.name }}</h3>
            <p class="text-gray-500 mb-2">{{ product.category?.name }}</p>
            <p class="font-bold text-lg mb-2">{{ product.price }} ₽ / {{ product.unit }}</p>
            <p v-if="product.stock !== undefined" class="text-sm text-gray-500 mb-4">Остаток: {{ product.stock }} шт</p>

            <div class="flex items-center gap-2 mb-4">
                <button @click="quantity--" class="px-3 py-1 bg-gray-200 rounded-lg">-</button>
                <input type="number" v-model="quantity" class="w-16 border rounded-lg text-center" />
                <button @click="quantity++" class="px-3 py-1 bg-gray-200 rounded-lg">+</button>
            </div>

            <button @click="addToCart" class="w-full bg-green-500 text-white px-4 py-2 rounded-xl font-semibold hover:bg-green-600 transition">
                Добавить в корзину
            </button>
        </div>
    </div>
</template>
