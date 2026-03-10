<template>
    <div class="min-h-screen bg-[#121212] text-white flex">
        <!-- Боковая панель -->
        <aside class="w-64 bg-[#1f1f1f] p-6 border-r border-white/5">
            <h2 class="text-xl font-black mb-8 text-[#f33]">ADMIN PANEL</h2>
            <nav class="space-y-4">
                <Link href="/admin" class="block hover:text-[#f33] transition">Дашборд</Link>
                <Link href="/admin/products" class="block hover:text-[#f33] transition">Товары</Link>
                <Link href="/" class="block text-gray-500 pt-4 border-t border-white/5">На сайт</Link>
            </nav>
        </aside>

        <!-- Основной контент -->
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-10">
                <h1 class="text-3xl font-bold">Управление магазином</h1>
                <div class="text-sm text-gray-400 font-mono">Вход: miki23074@gmail.com</div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Карточка статистики -->
                <div class="bg-[#1f1f1f] p-6 rounded-3xl border border-white/5">
                    <p class="text-gray-400 text-sm">Всего товаров</p>
                    <p class="text-4xl font-black mt-2">124</p>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
