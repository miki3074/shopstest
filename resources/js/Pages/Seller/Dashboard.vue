<script setup>
import { router, Head } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, watch } from 'vue'

const props = defineProps({
    products: Object,
    filters: Object
})

const searchQuery = ref(props.filters?.search || '')
const selectedUnit = ref(props.filters?.unit || 'all')

const showDeleteModal = ref(false)
const productToDelete = ref(null)

// Наблюдение за фильтрами
watch([searchQuery, selectedUnit], () => {
    router.get('/seller/dashboardsell', {
        search: searchQuery.value,
        unit: selectedUnit.value
    }, {
        preserveState: true,
        replace: true
    })
})

function openDeleteModal(product) {
    productToDelete.value = product
    showDeleteModal.value = true
}

function confirmDelete() {
    router.delete(`/seller/product/${productToDelete.value.id}`, {
        onSuccess: () => showDeleteModal.value = false
    })
}
</script>

<template>
    <Head title="Мои товары - Панель продавца" />

    <AuthenticatedLayout>
        <div class="min-h-screen bg-[#141414] text-white font-sans py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- HEADER -->
                <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <h1 class="text-4xl font-black tracking-tight mb-2">Мои товары</h1>
                        <p class="text-gray-500 font-medium">Управление ассортиментом вашего магазина</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="bg-[#1f1f1f] border border-white/5 rounded-[24px] px-6 py-4 flex flex-col">
                            <span class="text-[10px] uppercase font-bold text-gray-500 tracking-widest">Всего</span>
                            <span class="text-2xl font-black text-[#f33] leading-tight">{{ products.total }}</span>
                        </div>

                        <button
                            @click="router.visit('/seller/product/create')"
                            class="bg-[#f33] hover:bg-[#ff4444] text-white h-full px-8 py-4 rounded-[24px] font-black shadow-lg shadow-red-900/20 transition-all active:scale-95 flex items-center gap-3"
                        >
                            <span class="text-xl">+</span>
                            Добавить
                        </button>
                    </div>
                </div>

                <!-- FILTERS -->
                <div class="mb-10 flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Поиск по названию или описанию..."
                            class="w-full bg-[#1f1f1f] border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-[#f33] transition placeholder:text-gray-600"
                        />
                        <span class="absolute right-4 top-4 text-gray-600">🔍</span>
                    </div>

<!--                    <select-->
<!--                        v-model="selectedUnit"-->
<!--                        class="bg-[#1f1f1f] border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-[#f33] min-w-[160px] appearance-none cursor-pointer"-->
<!--                    >-->
<!--                        <option value="all">Все единицы</option>-->
<!--                        <option value="kg">Килограмм</option>-->
<!--                        <option value="g">Грамм</option>-->
<!--                        <option value="l">Литр</option>-->
<!--                        <option value="pcs">Штука</option>-->
<!--                    </select>-->
                </div>

                <!-- PRODUCTS GRID -->
                <div v-if="products.data.length > 0"
                     class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    <div
                        v-for="product in products.data"
                        :key="product.id"
                        class="group bg-[#1f1f1f] rounded-[32px] overflow-hidden border border-white/5 hover:border-[#f33]/30 transition-all duration-300 flex flex-col"
                    >
                        <!-- Image Gallery -->
                        <div class="relative h-56 bg-[#262626] overflow-hidden">
                            <div v-if="product.images?.length > 0"
                                 class="flex overflow-x-auto snap-x snap-mandatory scrollbar-none h-full">
                                <div v-for="(img, idx) in product.images" :key="idx"
                                     class="flex-shrink-0 w-full h-full snap-center">
                                    <img :src="'/storage/' + img.path"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"/>
                                </div>
                            </div>
                            <div v-else class="w-full h-full flex items-center justify-center">
                                <span class="text-4xl">📦</span>
                            </div>

                            <!-- Badges -->
                            <div class="absolute top-4 left-4">
                                <span :class="[
                                    'text-[10px] font-black uppercase px-3 py-1.5 rounded-full tracking-widest shadow-lg',
                                    product.stock > 10 ? 'bg-emerald-500 text-white' :
                                    product.stock > 0 ? 'bg-orange-500 text-white' : 'bg-red-600 text-white'
                                ]">
                                    {{ product.stock > 0 ? `Склад: ${product.stock}` : 'Нет в наличии' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <div class="mb-4">
                                <h3 class="font-black text-xl text-white group-hover:text-[#f33] transition-colors truncate">
                                    {{ product.name }}
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-2 mt-1 leading-relaxed">
                                    {{ product.description }}
                                </p>
                            </div>

                            <div class="mt-auto">
                                <div class="flex items-baseline gap-1 mb-6">
                                    <span class="text-3xl font-black text-white">{{ product.price }}</span>
                                    <span class="text-gray-500 font-bold uppercase text-xs">₽ / {{ product.unit }}</span>
                                </div>

                                <div class="flex gap-3">
                                    <button
                                        @click="router.visit(`/seller/product/${product.id}/edit`)"
                                        class="flex-1 bg-[#262626] hover:bg-[#323232] text-white py-4 rounded-2xl text-sm font-bold transition-all active:scale-95"
                                    >
                                        Изменить
                                    </button>
                                    <button
                                        @click="openDeleteModal(product)"
                                        class="bg-[#262626] hover:bg-red-900/20 hover:text-red-500 text-gray-500 px-5 rounded-2xl transition-all active:scale-95"
                                    >
                                        🗑
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- EMPTY STATE -->
                <div v-else class="bg-[#1f1f1f] rounded-[40px] border border-white/5 py-32 text-center">
                    <div class="text-6xl mb-6">🏜️</div>
                    <h3 class="text-2xl font-black text-white mb-2">Товаров пока нет</h3>
                    <p class="text-gray-500 mb-8">Начните свой бизнес, добавив первый товар</p>
                    <button
                        @click="router.visit('/seller/product/create')"
                        class="bg-[#f33] text-white px-10 py-4 rounded-2xl font-black hover:bg-[#ff4444] transition-all"
                    >
                        Добавить товар
                    </button>
                </div>

                <!-- PAGINATION -->
                <div v-if="products.links.length > 3" class="mt-12 flex justify-center gap-3">
                    <button
                        v-for="link in products.links"
                        :key="link.label"
                        v-html="link.label"
                        :disabled="!link.url || link.active"
                        @click="router.visit(link.url)"
                        class="px-5 py-3 rounded-2xl font-bold transition-all"
                        :class="[
                            link.active ? 'bg-[#f33] text-white' : 'bg-[#1f1f1f] text-gray-500 hover:text-white',
                            !link.url ? 'opacity-20 cursor-not-allowed' : ''
                        ]"
                    />
                </div>
            </div>
        </div>

        <!-- DELETE MODAL (DARK) -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-[#1f1f1f] border border-white/10 rounded-[32px] p-8 max-w-md w-full shadow-2xl transform transition-all">
                <div class="text-3xl mb-4 text-red-500">⚠️</div>
                <h2 class="text-2xl font-black text-white mb-2">Удалить товар?</h2>
                <p class="text-gray-400 mb-8 leading-relaxed">
                    Вы собираетесь удалить <span class="text-white font-bold">{{ productToDelete?.name }}</span>.
                    Это действие нельзя будет отменить.
                </p>

                <div class="flex gap-3">
                    <button
                        @click="showDeleteModal = false"
                        class="flex-1 bg-[#262626] text-white py-4 rounded-2xl font-bold hover:bg-[#323232] transition"
                    >
                        Отмена
                    </button>
                    <button
                        @click="confirmDelete"
                        class="flex-1 bg-[#f33] text-white py-4 rounded-2xl font-bold hover:bg-[#ff4444] transition shadow-lg shadow-red-900/40"
                    >
                        Да, удалить
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Скрытие скроллбара для галереи изображений */
.scrollbar-none::-webkit-scrollbar {
    display: none;
}
.scrollbar-none {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Плавное появление карточек */
.grid > div {
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
