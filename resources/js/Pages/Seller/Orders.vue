<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    orders: Array
})

// Функция для форматирования даты
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('ru-RU', {
        day: '2-digit',
        month: 'long',
        hour: '2-digit',
        minute: '2-digit'
    })
}
</script>

<template>
    <Head title="Заказы покупателей" />

    <AuthenticatedLayout>
        <template #header>
            Заказы покупателей
        </template>

        <div class="max-w-5xl mx-auto py-8 px-4">

            <div v-if="orders.length === 0" class="text-center py-20 bg-[#1f1f1f] rounded-[32px] border border-white/5">
                <div class="text-6xl mb-4">📦</div>
                <h2 class="text-xl font-bold text-gray-400">У вас пока нет заказов</h2>
            </div>

            <div v-else class="space-y-6">
                <div
                    v-for="order in orders"
                    :key="order.id"
                    class="bg-[#1f1f1f] border border-white/5 rounded-[32px] overflow-hidden shadow-xl"
                >
                    <!-- Header заказа -->
                    <div class="p-6 border-b border-white/5 bg-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-xl font-black">Заказ #{{ order.id }}</span>
                                <span class="bg-[#f33] text-[10px] uppercase font-black px-2 py-0.5 rounded-md tracking-widest text-white">Новый</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium">{{ formatDate(order.created_at) }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-tighter mb-1">Адрес доставки</p>
                            <p class="text-sm font-bold text-gray-200">{{ order.order.address }}</p>
                        </div>
                    </div>

                    <!-- Состав заказа -->
                    <div class="p-6 space-y-4">
                        <div
                            v-for="item in order.items"
                            :key="item.id"
                            class="flex items-center justify-between py-2 group"
                        >
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-[#262626] rounded-xl flex-shrink-0 flex items-center justify-center border border-white/5 overflow-hidden">
                                    <img
                                        v-if="item.product.image"
                                        :src="'/storage/' + item.product.image"
                                        class="w-full h-full object-cover"
                                    />
                                    <span v-else>🥘</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-200 group-hover:text-white transition-colors">{{ item.product.name }}</p>
                                    <p class="text-xs text-gray-500">{{ item.quantity }} шт. × {{ Math.round(item.price) }} ₽</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-lg text-white">{{ Math.round(item.price * item.quantity) }} ₽</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer заказа -->
                    <div class="p-6 bg-[#262626]/50 border-t border-white/5 flex items-center justify-between">
                        <div>
                            <button class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-[#f33] transition-colors">
                                Изменить статус
                            </button>
                        </div>
                        <div class="flex items-center gap-6">
                            <span class="text-gray-500 font-medium">Итого к оплате</span>
                            <span class="text-3xl font-black text-[#f33]">{{ Math.round(order.total) }} ₽</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Плавные переходы для интерактивных элементов */
.shadow-xl {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.3);
}
</style>
