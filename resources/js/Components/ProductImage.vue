<template>
    <div class="relative w-full h-full flex items-center justify-center overflow-hidden select-none">
        <!-- Если есть фото товара -->
        <img
            v-if="src"
            :src="'/storage/' + src"
            class="w-full h-full object-contain p-2 md:p-4 group-hover:scale-110 transition-transform duration-500"
        />

        <!-- Если фото нет, выводим Эмодзи -->
        <div v-else class="text-5xl md:text-7xl group-hover:scale-110 transition-transform duration-500 flex items-center justify-center">
            {{ emoji }}
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    src: {
        type: String,
        default: null
    },
    category: {
        type: String,
        default: ''
    }
});

// Логика выбора эмодзи в зависимости от категории
const emoji = computed(() => {
    const cat = props.category;


    if (cat === 'Крупа') return '🍚';
    if (cat === 'Мука') return '🌾';
    if (cat === 'Спагетти') return '🍝 ';
    if (cat === 'Макаронные изделия') return '🍝 ';

    if (cat === 'Овощи') return '🍅';
    if (cat === 'Соль') return '🧂';
    if (cat === 'Яйца') return '🥚';

    // Если категория не найдена или пустая (общий символ продуктов)
    return '📦';
});
</script>
