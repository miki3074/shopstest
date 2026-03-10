<script setup>
import { ref } from 'vue'
import { useForm, Head } from '@inertiajs/vue3'

// Получаем категории из пропсов
const props = defineProps({
    categories: Array
})

// Инициализация формы через Inertia useForm
const form = useForm({
    name: '',
    price: '',
    stock: 0,
    unit: 'pcs',
    description: '',
    category_id: '',
    images: [] // Массив для файлов
})

const previews = ref([])

// Обработка выбора файлов
function handleImageUpload(event) {
    const files = Array.from(event.target.files)
    addFiles(files)
}

// Обработка Drag & Drop
function dropImages(event) {
    const files = Array.from(event.dataTransfer.files)
    addFiles(files)
}

function addFiles(files) {
    // Добавляем файлы в форму
    files.forEach(file => {
        form.images.push(file)

        // Создаем превью
        const reader = new FileReader()
        reader.onload = e => previews.value.push(e.target.result)
        reader.readAsDataURL(file)
    })
}

function removeImage(index) {
    form.images.splice(index, 1)
    previews.value.splice(index, 1)
}

// Отправка формы
function submit() {
    // В Inertia.js useForm сам определит, что нужно отправить FormData,
    // если в полях есть файлы. Больше не нужно создавать new FormData() вручную.
    form.post('/seller/product', {
        forceFormData: true, // Принудительно используем FormData для передачи файлов
        onSuccess: () => {
            console.log('Товар успешно добавлен')
        },
        onError: (errors) => {
            console.log('Ошибки валидации:', errors)
        }
    })
}
</script>

<template>
    <Head title="Добавить товар - Панель продавца" />

    <div class="min-h-screen bg-[#141414] text-white font-sans py-12 px-4">
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <button @click="window.history.back()" class="bg-[#1f1f1f] p-3 rounded-2xl hover:bg-[#262626] transition">
                    ⬅️
                </button>
                <h1 class="text-3xl font-black">Новый товар</h1>
            </div>

            <form @submit.prevent="submit" class="space-y-6">

                <!-- Основная информация -->
                <div class="bg-[#1f1f1f] rounded-[32px] p-8 border border-white/5 space-y-6">

                    <!-- Название -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">Название товара</label>
                        <input
                            v-model="form.name"
                            type="text"
                            placeholder="Напр: Свежие помидоры"
                            class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33] transition"
                        />
                        <div v-if="form.errors.name" class="text-red-500 text-xs mt-1 px-1">{{ form.errors.name }}</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Цена -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">Цена (₽)</label>
                            <input
                                v-model="form.price"
                                type="number"
                                class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33]"
                            />
                            <div v-if="form.errors.price" class="text-red-500 text-xs mt-1 px-1">{{ form.errors.price }}</div>
                        </div>

                        <!-- Склад (Stock) -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">На складе</label>
                            <input
                                v-model="form.stock"
                                type="number"
                                class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33]"
                            />
                            <div v-if="form.errors.stock" class="text-red-500 text-xs mt-1 px-1">{{ form.errors.stock }}</div>
                        </div>

                        <!-- Единица -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">Единица</label>
                            <select
                                v-model="form.unit"
                                class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33] appearance-none"
                            >
                                <option value="kg">кг</option>
                                <option value="g">г</option>
                                <option value="l">л</option>
                                <option value="ml">мл</option>
                                <option value="pcs">шт</option>
                            </select>
                        </div>
                    </div>

                    <!-- Категория -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">Категория</label>




                        <select
                            v-model="form.category_id"
                            class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33]"
                        >
                            <option value="">Выберите из списка</option>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                        <div v-if="form.errors.category_id" class="text-red-500 text-xs mt-1 px-1">{{ form.errors.category_id }}</div>
                    </div>

                    <!-- Описание -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-2 px-1">Описание</label>
                        <textarea
                            v-model="form.description"
                            rows="4"
                            class="w-full bg-[#262626] border-none rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-[#f33] resize-none"
                        ></textarea>
                    </div>
                </div>

                <!-- Загрузка изображений -->
                <div class="bg-[#1f1f1f] rounded-[32px] p-8 border border-white/5">
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-4 px-1">Изображения товара</label>

                    <div
                        @dragover.prevent
                        @drop.prevent="dropImages"
                        @click="$refs.fileInput.click()"
                        class="border-2 border-dashed border-white/10 rounded-3xl p-10 text-center cursor-pointer hover:bg-white/5 hover:border-[#f33]/50 transition-all group"
                    >
                        <input ref="fileInput" type="file" multiple accept="image/*" class="hidden" @change="handleImageUpload"/>
                        <div class="text-4xl mb-2 group-hover:scale-110 transition-transform">📸</div>
                        <p class="text-sm text-gray-400">Нажмите или перетащите фото сюда</p>
                        <p class="text-[10px] text-gray-600 mt-2 uppercase tracking-widest">PNG, JPG до 5MB</p>
                    </div>

                    <!-- Сетка превью -->
                    <div v-if="previews.length" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6">
                        <div v-for="(img, index) in previews" :key="index" class="relative aspect-square group">
                            <img :src="img" class="rounded-2xl w-full h-full object-cover border border-white/10 shadow-lg"/>
                            <button
                                type="button"
                                @click.stop="removeImage(index)"
                                class="absolute -top-2 -right-2 bg-[#f33] text-white rounded-full w-7 h-7 flex items-center justify-center shadow-xl hover:scale-110 transition active:scale-90"
                            >
                                ✕
                            </button>
                        </div>
                    </div>
                    <div v-if="form.errors.images" class="text-red-500 text-xs mt-2">{{ form.errors.images }}</div>
                </div>

                <!-- Кнопка отправки -->
                <div class="pt-4">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full bg-[#f33] hover:bg-[#ff4444] disabled:bg-gray-800 disabled:text-gray-500 py-5 rounded-[24px] font-black text-lg transition-all shadow-xl shadow-red-900/20 flex items-center justify-center gap-3 active:scale-[0.98]"
                    >
                        <span v-if="form.processing" class="animate-spin text-2xl">⏳</span>
                        {{ form.processing ? 'Сохранение...' : 'Опубликовать товар' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>

<style scoped>
/* Убираем стрелочки у input number */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
