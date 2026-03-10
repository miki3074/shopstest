<script setup>
import { ref, watch, computed } from 'vue'
import { router, usePage, Head } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import ProductModal from '@/Components/ProductModal.vue'
import ProductImage from '@/Components/ProductImage.vue';

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object,
})

const page = usePage()

// Состояния для мобилок
const isMobileCartOpen = ref(false)

// 1. Получаем корзину
const carts = computed(() => page.props.auth.carts || [])

// 2. Расчет общей суммы
const cartTotal = computed(() => {
    return carts.value.reduce((sum, item) => sum + (item.product.price * item.quantity), 0)
})

// 3. Поиск
const search = ref(props.filters.search || '')
watch(search, debounce((value) => {
    router.get('/shop', { ...props.filters, search: value }, {
        preserveState: true,
        replace: true,
        preserveScroll: true
    })
}, 500))

// 4. Категории
const selectCategory = (id) => {
    const newFilters = { ...props.filters }
    if (newFilters.category === id) {
        delete newFilters.category
    } else {
        newFilters.category = id
    }
    router.get('/shop', newFilters, { preserveScroll: true })
}

// 5. Корзина
function addToCart(product) {
    router.post(`/cart/add/${product.id}`, { quantity: 1 }, { preserveScroll: true })
}

function updateQuantity(item, change) {
    const newQty = item.quantity + change
    if (newQty <= 0) {
        router.delete(`/cart/remove/${item.id}`, { preserveScroll: true })
    } else {
        router.patch(`/cart/update/${item.id}`, { quantity: newQty }, { preserveScroll: true })
    }
}

const isModalOpen = ref(false)
const selectedProduct = ref(null)

function openProduct(product) {
    selectedProduct.value = product
    isModalOpen.value = true
}

function goToCheckout() {
    if (!carts.value.length) return

    router.visit('/checkout')
}


</script>

<template>
    <Head title="Доставка продуктов" />

    <div class="min-h-screen bg-[#141414] text-white font-sans selection:bg-red-500/30 pb-24 md:pb-0">

        <!-- HEADER -->
        <header class="bg-[#1a1a1a]/90 backdrop-blur-xl sticky top-0 z-40 border-b border-white/5">
            <div class="max-w-[1600px] mx-auto px-4 md:px-6 py-3 md:py-4 flex flex-col md:flex-row items-center gap-4">
                <!-- Logo & Search Row -->
                <div class="flex items-center justify-between w-full md:w-auto gap-4">
                    <div @click="router.get('/shop')" class="flex items-center gap-3 cursor-pointer group">
                        <span class="text-xl md:text-2xl font-black tracking-tighter uppercase text-[#f33]">Халва</span>
                    </div>

                    <!-- Search for Mobile (icon only or hidden if space is tight) -->
                    <div class="md:hidden flex-1 max-w-[200px]">
                        <input v-model="search" placeholder="Поиск..." class="w-full bg-[#262626] border-none rounded-xl px-4 py-2 text-sm" />
                    </div>
                </div>

                <!-- Desktop Search -->
                <div class="relative flex-1 max-w-2xl hidden md:block">
                    <input
                        v-model="search"
                        placeholder="Найти любимые продукты..."
                        class="w-full bg-[#262626] border-none rounded-2xl px-5 py-3.5 text-sm placeholder:text-gray-500 focus:ring-2 focus:ring-[#f33] transition-all"
                    />
                </div>
            </div>

            <!-- MOBILE CATEGORIES (Horizontal Scroll) -->
            <div class="lg:hidden overflow-x-auto no-scrollbar border-t border-white/5 bg-[#1a1a1a]">
                <div class="flex px-4 py-3 gap-2">
                    <button
                        @click="router.get('/shop')"
                        :class="!filters.category ? 'bg-[#f33] text-white' : 'bg-[#262626] text-gray-400'"
                        class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-bold transition-all"
                    >
                        Все
                    </button>
                    <button
                        v-for="cat in categories"
                        :key="cat.id"
                        @click="selectCategory(cat.id)"
                        :class="filters.category == cat.id ? 'bg-[#f33] text-white' : 'bg-[#262626] text-gray-400'"
                        class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-bold transition-all"
                    >
                        {{ cat.name }}
                    </button>
                </div>
            </div>
        </header>

        <!-- MAIN LAYOUT -->
        <div class="max-w-[1600px] mx-auto flex flex-col lg:flex-row gap-6 p-4 md:p-6">

            <!-- LEFT SIDEBAR (Desktop only) -->
            <aside class="w-64 flex-shrink-0 hidden lg:flex flex-col gap-6">
                <div class="bg-[#1f1f1f] rounded-[28px] p-2 border border-white/5 sticky top-28">
                    <h3 class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-2 px-4 mt-3">Категории</h3>
                    <nav class="space-y-1">
                        <button
                            @click="router.get('/shop')"
                            :class="!filters.category ? 'bg-[#262626] text-white shadow-lg border border-white/5' : 'text-gray-400 hover:bg-white/5'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium"
                        >
                            📦 Все товары
                        </button>
                        <button
                            v-for="cat in categories"
                            :key="cat.id"
                            @click="selectCategory(cat.id)"
                            :class="filters.category == cat.id ? 'bg-[#262626] text-white shadow-lg border border-white/5' : 'text-gray-400 hover:bg-white/5'"
                            class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium text-left"
                        >
                            {{ cat.name }}
                        </button>
                    </nav>
                </div>
            </aside>

            <!-- CENTER: Product Grid -->
            <main class="flex-1 min-w-0">
                <div class="mb-6 md:mb-8 flex items-center justify-between">
                    <h1 class="text-2xl md:text-4xl font-black tracking-tight">
                        {{ categories.find(c => c.id == filters.category)?.name || 'Все товары' }}
                    </h1>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 md:gap-4">
                    <div
                        v-for="product in products.data" :key="product.id"
                        @click="openProduct(product)"
                        class="bg-[#1f1f1f] rounded-[24px] md:rounded-[32px] p-2 md:p-3 flex flex-col hover:bg-[#252525] transition-all cursor-pointer group border border-transparent hover:border-white/10"
                    >
                        <!-- Image -->
                        <div class="relative mb-2 md:mb-3 aspect-square bg-[#262626] rounded-[18px] md:rounded-[24px] overflow-hidden">
                            <ProductImage
                                :src="product.image"
                                :category="product.category?.name"
                            />
                        </div>

                        <!-- Price -->
                        <div class="px-2 mb-1">
                            <span class="text-xl md:text-2xl font-black text-white">{{ Math.round(product.price) }} <span class="text-sm font-normal opacity-70">₽</span></span>
                        </div>

                        <!-- Title -->
                        <div class="px-2 flex-1">
                            <h3 class="text-[13px] md:text-[14px] leading-tight text-gray-200 line-clamp-2 font-medium mb-1 min-h-[32px] md:min-h-[40px]">
                                {{ product.name }}
                            </h3>
                            <p class="text-[10px] text-gray-500 uppercase tracking-tighter">{{ product.category?.name }}</p>
                        </div>

                        <!-- Add Button -->
                        <div class="mt-3 md:mt-4 px-1 pb-1">
                            <button
                                @click.stop="addToCart(product)"
                                class="w-full bg-[#2a2a2a] hover:bg-[#f33] active:scale-95 text-xl md:text-2xl font-light py-1.5 md:py-2 rounded-xl md:rounded-2xl transition-all"
                            >
                                +
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="products.links.length > 3" class="mt-12 flex flex-wrap justify-center items-center gap-1 md:gap-2 pb-10">
                    <button
                        v-for="link in products.links"
                        :key="link.label"
                        @click="router.get(link.url)"
                        v-html="link.label"
                        :disabled="!link.url || link.active"
                        class="px-3 md:px-4 py-1.5 md:py-2 rounded-lg md:rounded-xl text-xs md:text-sm transition-colors"
                        :class="[
                            link.active ? 'bg-[#f33] font-bold text-white' : 'bg-[#1f1f1f] text-gray-400 hover:text-white',
                            !link.url ? 'opacity-20 cursor-not-allowed' : ''
                        ]"
                    ></button>
                </div>
            </main>

            <!-- RIGHT SIDEBAR (Desktop Cart) -->
            <aside class="w-80 flex-shrink-0 hidden xl:block">
                <div class="bg-[#1f1f1f] rounded-[36px] p-6 sticky top-28 border border-white/5 min-h-[500px] flex flex-col shadow-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-black">Корзина</h2>
                        <span v-if="carts.length" class="text-xs bg-[#262626] px-2 py-1 rounded-lg text-gray-400">{{ carts.length }} тов.</span>
                    </div>

                    <div v-if="carts.length > 0" class="flex-1 flex flex-col gap-5 overflow-y-auto max-h-[450px] pr-2 custom-scroll">
                        <div v-for="item in carts" :key="item.id" class="flex gap-4 items-center group">
                            <div class="w-14 h-14 rounded-2xl bg-[#262626] flex-shrink-0 overflow-hidden border border-white/5">
                                <img :src="'/storage/'+item.product.image" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[13px] font-bold truncate pr-2">{{ item.product.name }}</p>
                                <p class="text-sm text-[#f33] font-black">{{ item.product.price * item.quantity }} ₽</p>
                            </div>
                            <div class="flex items-center bg-[#262626] rounded-xl p-1 gap-2">
                                <button @click="updateQuantity(item, -1)" class="w-6 h-6 flex items-center justify-center text-gray-400">-</button>
                                <span class="text-xs font-bold w-4 text-center">{{ item.quantity }}</span>
                                <button @click="updateQuantity(item, 1)" class="w-6 h-6 flex items-center justify-center text-gray-400">+</button>
                            </div>
                        </div>
                    </div>

                    <div v-else class="flex-1 flex flex-col items-center justify-center text-center opacity-50">
                        <div class="text-4xl mb-4">🛍️</div>
                        <h3 class="text-lg font-bold">Пусто</h3>
                    </div>

                    <div class="mt-8 pt-6 border-t border-white/5">
                        <div v-if="carts.length" class="flex justify-between items-end mb-6">
                            <span class="text-gray-500 font-medium">Итого</span>
                            <span class="text-3xl font-black">{{ Math.round(cartTotal) }} ₽</span>
                        </div>
                        <button
                            :disabled="!carts.length"
                            @click="goToCheckout"
                            class="w-full py-4 rounded-[22px] bg-[#f33] hover:bg-[#ff4444] disabled:bg-[#262626] font-black text-sm transition-all shadow-lg shadow-red-900/20"
                        >
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </aside>
        </div>

        <!-- MOBILE STICKY CART BUTTON -->
        <div v-if="carts.length > 0" class="xl:hidden fixed bottom-6 left-4 right-4 z-50">
            <button
                @click="isMobileCartOpen = true"
                class="w-full bg-[#f33] text-white flex items-center justify-between p-4 rounded-2xl shadow-2xl shadow-red-950/40 active:scale-95 transition-transform"
            >
                <div class="flex items-center gap-3">
                    <span class="bg-white/20 px-2 py-1 rounded-lg text-xs font-bold">{{ carts.length }}</span>
                    <span class="font-bold">Посмотреть корзину</span>
                </div>
                <span class="font-black">{{ Math.round(cartTotal) }} ₽</span>
            </button>
        </div>

        <!-- MOBILE CART MODAL/DRAWER (упрощенно) -->
        <div v-if="isMobileCartOpen" class="fixed inset-0 z-[60] xl:hidden">
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="isMobileCartOpen = false"></div>
            <div class="absolute bottom-0 left-0 right-0 bg-[#1f1f1f] rounded-t-[32px] max-h-[85vh] overflow-hidden flex flex-col p-6 shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-black">Ваш заказ</h2>
                    <button @click="isMobileCartOpen = false" class="text-gray-400 text-2xl">&times;</button>
                </div>

                <div class="flex-1 overflow-y-auto space-y-4 mb-6">
                    <div v-for="item in carts" :key="item.id" class="flex gap-4 items-center">
                        <div class="w-12 h-12 rounded-xl bg-[#262626] overflow-hidden">
                            <img :src="'/storage/'+item.product.image" class="w-full h-full object-cover" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold truncate">{{ item.product.name }}</p>
                            <p class="text-xs text-gray-500">{{ item.product.price }} ₽/шт</p>
                        </div>
                        <div class="flex items-center bg-[#262626] rounded-lg p-1">
                            <button @click="updateQuantity(item, -1)" class="w-6 h-6 flex items-center justify-center">-</button>
                            <span class="text-xs font-bold w-6 text-center">{{ item.quantity }}</span>
                            <button @click="updateQuantity(item, 1)" class="w-6 h-6 flex items-center justify-center">+</button>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/5 pt-4">
                    <div class="flex justify-between mb-4">
                        <span class="text-gray-400">Сумма заказа</span>
                        <span class="font-black text-xl">{{ Math.round(cartTotal) }} ₽</span>
                    </div>
                    <button
                        @click="goToCheckout"
                        class="w-full py-4 bg-[#f33] rounded-2xl font-black"
                    >
                        Заказать
                    </button>
                </div>
            </div>
        </div>

        <ProductModal
            :isOpen="isModalOpen"
            :product="selectedProduct"
            @close="isModalOpen = false"
            @addToCart="handleAddToCart"
        />
    </div>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.custom-scroll::-webkit-scrollbar {
    width: 4px;
}
.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scroll::-webkit-scrollbar-thumb {
    background: #333;
    border-radius: 10px;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
