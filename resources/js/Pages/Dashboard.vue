<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)
const roles = computed(() => page.props.auth.roles || [])

// Чистые проверки ролей
const isSeller = computed(() => roles.value.includes('seller'))
const isAdmin = computed(() => roles.value.includes('admin'))
// Если нет спец. ролей, считаем пользователя обычным покупателем
const isBuyer = computed(() => roles.value.includes('buyer') || roles.value.length === 0)
</script>

<template>
    <Head title="Личный кабинет" />

    <AuthenticatedLayout>
        <template #header>
            Личный кабинет
        </template>

        <div class="py-6 px-4 md:px-8">
            <div class="max-w-7xl mx-auto">

                <!-- Блок приветствия -->
                <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black tracking-tight">Привет, {{ user.name }}! 👋</h1>
                        <p class="text-gray-500 mt-2 font-medium">Рады видеть вас снова в Халве.</p>
                    </div>

                    <!-- Бейдж текущей роли -->
                    <div class="flex">
                        <span v-if="isSeller" class="bg-[#f33] text-white px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest shadow-lg shadow-red-900/20">
                            Панель продавца
                        </span>
                        <span v-else class="bg-[#262626] text-gray-400 border border-white/5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest">
                            Аккаунт покупателя
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8">

                    <!-- КОНТЕНТ ПРОДАВЦА -->
                    <section v-if="isSeller" class="space-y-6">
                        <h2 class="text-xl font-black uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2 h-2 bg-[#f33] rounded-full"></span>
                            Активные заказы
                        </h2>

                        <div class="bg-[#1f1f1f] border border-white/5 p-10 rounded-[32px] text-center shadow-xl">
                            <div class="w-20 h-20 bg-[#262626] rounded-3xl flex items-center justify-center mx-auto mb-6 text-4xl transform -rotate-12">📦</div>
                            <h3 class="text-xl font-bold mb-2">Заказы </h3>
                            <p class="text-gray-500 max-w-sm mx-auto mb-8 font-medium">Здесь будут отображаться заказы ваших товаров.</p>
                            <button @click="$inertia.get(route('seller.orders'))" class="bg-white text-black px-8 py-3.5 rounded-2xl font-black hover:bg-gray-200 transition-all active:scale-95">
                                К моим заказам
                            </button>
                        </div>
                    </section>

                    <!-- КОНТЕНТ ПОКУПАТЕЛЯ -->
                    <section v-if="isBuyer" class="space-y-6">
                        <h2 class="text-xl font-black uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                            Мои покупки
                        </h2>

                        <div class="bg-[#1f1f1f] border border-white/5 p-10 rounded-[32px] text-center shadow-xl">
                            <div class="w-20 h-20 bg-[#262626] rounded-3xl flex items-center justify-center mx-auto mb-6 text-4xl">🛍️</div>
                            <h3 class="text-xl font-bold mb-2">История </h3>
                            <p class="text-gray-500 max-w-sm mx-auto mb-8 font-medium">Здесь будет история заказов</p>
                            <button @click="$inertia.get(route('shop.index'))" class="bg-[#f33] text-white px-8 py-3.5 rounded-2xl font-black shadow-lg shadow-red-900/20 hover:bg-[#ff4444] transition-all active:scale-95">
                                В магазин
                            </button>
                        </div>
                    </section>

                    <!-- КОНТЕНТ АДМИНА -->
                    <section v-if="isAdmin" class="pt-10 border-t border-white/5">
                        <h2 class="text-xl font-black mb-6 text-[#f33]">Администрирование</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-[#1f1f1f] p-6 rounded-[24px] border border-white/5 hover:border-white/20 transition-colors cursor-pointer group">
                                <p class="text-gray-500 text-sm font-bold uppercase mb-1">Система</p>
                                <p class="text-xl font-black group-hover:text-[#f33] transition-colors">Пользователи</p>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
