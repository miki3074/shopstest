<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    carts:Array,
    total:Number
})

const address = ref('')
const paymentMethod = ref('card')

const cardNumber = ref('')
const cardDate = ref('')
const cardCvv = ref('')

function submit(){

    router.post('/checkout',{
        address:address.value,
        payment_method:paymentMethod.value,
        card_number:cardNumber.value
    })

}
</script>

<template>

    <div class="max-w-6xl mx-auto py-10 grid grid-cols-3 gap-8">

        <!-- товары -->

        <div class="col-span-2 bg-white rounded-2xl shadow p-6">

            <h2 class="text-xl font-bold mb-4">Ваш заказ</h2>

            <div
                v-for="item in carts"
                :key="item.id"
                class="flex items-center gap-4 border-b py-3"
            >

                <img
                    :src="'/storage/'+item.product.image"
                    class="w-16 h-16 object-cover rounded"
                />

                <div class="flex-1">

                    <p class="font-semibold">{{ item.product.name }}</p>

                    <p class="text-gray-500 text-sm">
                        {{ item.quantity }} x {{ item.product.price }} ₽
                    </p>

                </div>

                <p class="font-bold">
                    {{ item.quantity * item.product.price }} ₽
                </p>

            </div>

        </div>

        <!-- оформление -->

        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-xl font-bold mb-4">Оформление</h2>

            <label class="text-sm text-gray-500">
                Адрес доставки
            </label>

            <input
                v-model="address"
                class="w-full border rounded-xl px-3 py-2 mb-4"
            />

            <label class="text-sm text-gray-500">
                Способ оплаты
            </label>

            <select v-model="paymentMethod" class="w-full border rounded-xl px-3 py-2 mb-4">
                <option value="card">Карта</option>
                <option value="cash">Наличные</option>
            </select>

            <div v-if="paymentMethod==='card'">

                <input
                    v-model="cardNumber"
                    placeholder="Номер карты"
                    class="w-full border rounded-xl px-3 py-2 mb-2"
                />

                <div class="grid grid-cols-2 gap-2">

                    <input
                        v-model="cardDate"
                        placeholder="MM/YY"
                        class="border rounded-xl px-3 py-2"
                    />

                    <input
                        v-model="cardCvv"
                        placeholder="CVV"
                        class="border rounded-xl px-3 py-2"
                    />

                </div>

            </div>

            <div class="border-t mt-4 pt-4">

                <p class="flex justify-between font-semibold">
                    <span>Итого</span>
                    <span>{{ total }} ₽</span>
                </p>

                <button
                    @click="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-xl mt-4"
                >

                    Оформить заказ

                </button>

            </div>

        </div>

    </div>

</template>
