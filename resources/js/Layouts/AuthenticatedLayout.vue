<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <!-- Основной фон приложения -->
        <div class="min-h-screen bg-[#141414] text-white selection:bg-[#f33]/30">

            <!-- Навигация -->
            <nav class="bg-[#1a1a1a]/80 backdrop-blur-xl border-b border-white/5 sticky top-0 z-50">
                <!-- Primary Navigation Menu -->
                <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('shop.index')" class="group flex items-center gap-2">
                                    <span class="text-2xl font-black tracking-tighter uppercase text-[#f33] group-hover:scale-105 transition-transform">
                                        Халва
                                    </span>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                    class="text-sm font-bold uppercase tracking-widest transition-all"
                                >
                                    Личный кабинет
                                </NavLink>
                                <NavLink
                                    v-if="page.props.auth.roles.includes('seller')"
                                    :href="route('seller.dashboard')"
                                    :active="route().current('seller.dashboard')"
                                    class="text-sm font-bold uppercase tracking-widest transition-all"
                                >
                                    Мои товары
                                </NavLink>
                                <NavLink
                                    :href="route('shop.index')"
                                    :active="route().current('shop.index')"
                                    class="text-sm font-bold uppercase tracking-widest transition-all"
                                >
                                    В магазин
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 border border-white/5 text-sm leading-4 font-bold rounded-xl text-gray-300 bg-[#262626] hover:text-white hover:bg-[#2a2a2a] focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4 opacity-50"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="bg-[#262626] border border-white/10 rounded-lg overflow-hidden">
                                            <DropdownLink :href="route('profile.edit')" class="hover:bg-white/5 text-gray-300"> Профиль </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button" class="hover:bg-red-500/10 text-red-400">
                                                Выйти
                                            </DropdownLink>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-white hover:bg-[#262626] focus:outline-none transition duration-150"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden bg-[#1a1a1a] border-t border-white/5 shadow-2xl"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white">
                            Личный кабинет
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('shop.index')" class="text-white">
                            Магазин
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-white/5">
                        <div class="px-4">
                            <div class="font-bold text-base text-white">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')" class="text-gray-400"> Профиль </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="text-red-400">
                                Выйти
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-[#141414] border-b border-white/5" v-if="$slots.header">
                <div class="max-w-[1600px] mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="text-3xl font-black tracking-tight text-white">
                        <slot name="header" />
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-[1600px] mx-auto p-4 sm:p-6 lg:p-8">
                <div class="bg-[#1a1a1a] rounded-[32px] border border-white/5 overflow-hidden shadow-sm">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style>
/* Стилизация стандартных NavLink, если они не кастомизированы в их собственных файлах */
.nav-link-active {
    color: #ffffff !important;
    border-bottom-color: #f33 !important;
}

/* Глобальный скроллбар приложения */
::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    background: #141414;
}
::-webkit-scrollbar-thumb {
    background: #262626;
    border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background: #333;
}
</style>
