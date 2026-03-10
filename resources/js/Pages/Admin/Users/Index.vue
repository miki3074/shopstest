<template>
    <!-- ... (Ваш Sidebar и Header) ... -->

    <tbody class="divide-y divide-white/5">
    <tr v-for="user in users" :key="user.id" class="hover:bg-white/[0.02] transition-colors">
        <td class="p-5 text-gray-500 font-mono text-sm">#{{ user.id }}</td>
        <td class="p-5">
            <div class="font-bold">{{ user.name }}</div>
            <div class="text-xs text-gray-500">{{ user.email }}</div>
        </td>

        <!-- Кнопки управления ролями -->
        <td class="p-5">
            <!-- Если это не главный админ, показываем кнопки -->
            <div v-if="user.email !== 'miki23074@gmail.com'" class="flex items-center gap-2">

                <!-- Кнопка SELLER -->
                <button
                    @click="changeRole(user.id, 'seller')"
                    :class="hasRole(user, 'seller')
                ? 'bg-amber-500 text-black shadow-[0_0_15px_rgba(245,158,11,0.3)]'
                : 'bg-[#2a2a2a] text-gray-400 hover:bg-[#333]'"
                    class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300"
                >
                    Seller
                </button>

                <!-- Кнопка BUYER -->
                <button
                    @click="changeRole(user.id, 'buyer')"
                    :class="hasRole(user, 'buyer')
                ? 'bg-blue-500 text-white shadow-[0_0_15px_rgba(59,130,246,0.3)]'
                : 'bg-[#2a2a2a] text-gray-400 hover:bg-[#333]'"
                    class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300"
                >
                    Buyer
                </button>

            </div>
            <!-- Если это главный админ -->
            <div v-else class="flex items-center gap-2">
                <span class="px-4 py-1.5 rounded-xl bg-[#f33] text-white text-[10px] font-black uppercase">Super Admin</span>
            </div>
        </td>

        <td class="p-5 text-gray-500 text-sm">
            {{ new Date(user.created_at).toLocaleDateString() }}
        </td>
    </tr>
    </tbody>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

const props = defineProps({
    users: Array
});

// Функция проверки роли (у Spatie роли приходят как массив объектов в ключе roles)
const hasRole = (user, roleName) => {
    return user.roles.some(role => role.name === roleName);
};

// Функция отправки запроса на смену роли
const changeRole = (userId, roleName) => {
    router.patch(`/admin/users/${userId}/role`, {
        role: roleName
    }, {
        preserveScroll: true, // Чтобы страница не дергалась
        onBefore: () => confirm(`Изменить роль пользователя на ${roleName}?`),
    });
};
</script>
