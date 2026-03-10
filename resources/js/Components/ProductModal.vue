<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    product: Object,
    isOpen: Boolean
})

const emit = defineEmits(['close', 'addToCart'])

const activeImage = ref('')

// Следим за изменением продукта, чтобы обновлять главное фото
watch(() => props.product, (newVal) => {
    if (newVal) {
        activeImage.value = newVal.image
            ? '/storage/' + newVal.image
            : 'https://placehold.co/600x600/262626/white?text=No+Photo'
    }
}, { immediate: true })

function close() {
    emit('close')
}
</script>

<template>
    <Transition name="fade">
        <div v-if="isOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" @click="close"></div>

            <!-- Modal Content -->
            <div class="relative bg-[#1f1f1f] w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-[40px] shadow-2xl border border-white/5 no-scrollbar">

                <!-- Close Button -->
                <button @click="close" class="absolute top-6 right-6 z-10 bg-black/20 hover:bg-black/40 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                    ✕
                </button>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <!-- Left: Images -->
                        <div>
                            <div class="aspect-square bg-[#262626] rounded-[32px] overflow-hidden mb-4">
                                <img :src="activeImage" class="w-full h-full object-contain p-8" />
                            </div>

                            <!-- Thumbnails (если есть доп. фото) -->
                            <div v-if="product.images && product.images.length > 0" class="flex gap-3 overflow-x-auto pb-2">
                                <div
                                    @click="activeImage = '/storage/' + product.image"
                                    class="w-20 h-20 rounded-2xl bg-[#262626] cursor-pointer border-2 transition"
                                    :class="activeImage.includes(product.image) ? 'border-[#f33]' : 'border-transparent'"
                                >
                                    <img :src="'/storage/' + product.image" class="w-full h-full object-contain p-2" />
                                </div>
                                <div
                                    v-for="img in product.images" :key="img.id"
                                    @click="activeImage = '/storage/' + img.path"
                                    class="w-20 h-20 rounded-2xl bg-[#262626] cursor-pointer border-2 transition"
                                    :class="activeImage.includes(img.path) ? 'border-[#f33]' : 'border-transparent'"
                                >
                                    <img :src="'/storage/' + img.path" class="w-full h-full object-contain p-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Right: Info -->
                        <div class="flex flex-col">
                            <h2 class="text-3xl font-black mb-2 leading-tight">{{ product.name }}</h2>
                            <p class="text-gray-500 uppercase tracking-widest text-sm mb-6">
                                {{ product.category?.name }} • {{ product.unit }}
                            </p>

                            <div class="flex items-center gap-6 mb-8">
                                <span class="text-4xl font-black">{{ Math.round(product.price) }} ₽</span>
                                <button
                                    @click="emit('addToCart', product)"
                                    class="flex-1 bg-[#f3d001] hover:bg-[#e6c500] text-black font-bold py-4 rounded-2xl text-lg transition active:scale-95"
                                >
                                    Добавить
                                </button>
                            </div>

                            <!-- О товаре -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-xl font-bold mb-3">О товаре</h3>
                                    <p class="text-gray-400 leading-relaxed">
                                        {{ product.description || 'Описание товара скоро появится.' }}
                                    </p>
                                </div>

                                <!-- Сетку характеристик (как на фото) -->
                                <div class="grid grid-cols-2 gap-y-4 pt-4 border-t border-white/5">

                                    <div class="text-sm">
                                        <p class="text-gray-500">Остаток</p>
                                        <p>{{ product.stock }} шт</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
