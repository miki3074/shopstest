<!--<script setup>-->
<!--import { Head, Link } from '@inertiajs/vue3';-->

<!--defineProps({-->
<!--    canLogin: {-->
<!--        type: Boolean,-->
<!--    },-->
<!--    canRegister: {-->
<!--        type: Boolean,-->
<!--    },-->
<!--    laravelVersion: {-->
<!--        type: String,-->
<!--        required: true,-->
<!--    },-->
<!--    phpVersion: {-->
<!--        type: String,-->
<!--        required: true,-->
<!--    },-->
<!--});-->
<!--</script>-->

<!--<template>-->
<!--    <Head title="Welcome" />-->

<!--    <div-->
<!--        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"-->
<!--    >-->
<!--        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">-->
<!--            <Link-->
<!--                v-if="$page.props.auth.user"-->
<!--                :href="route('dashboard')"-->
<!--                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                >Dashboard</Link-->
<!--            >-->

<!--            <template v-else>-->
<!--                <Link-->
<!--                    :href="route('login')"-->
<!--                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                    >Log in</Link-->
<!--                >-->

<!--                <Link-->
<!--                    v-if="canRegister"-->
<!--                    :href="route('register')"-->
<!--                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                    >Register</Link-->
<!--                >-->
<!--            </template>-->
<!--        </div>-->

<!--        <div class="max-w-7xl mx-auto p-6 lg:p-8">-->
<!--            <div class="flex justify-center">-->
<!--                <svg-->
<!--                    viewBox="0 0 62 65"-->
<!--                    fill="none"-->
<!--                    xmlns="http://www.w3.org/2000/svg"-->
<!--                    class="h-16 w-auto bg-gray-100 dark:bg-gray-900"-->
<!--                >-->
<!--                    <path-->
<!--                        d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z"-->
<!--                        fill="#FF2D20"-->
<!--                    />-->
<!--                </svg>-->
<!--            </div>-->

<!--            <div class="mt-16">-->
<!--                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">-->
<!--                    <a-->
<!--                        href="https://laravel.com/docs"-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Documentation</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laravel has wonderful documentation covering every aspect of the framework. Whether you-->
<!--                                are a newcomer or have prior experience with Laravel, we recommend reading our-->
<!--                                documentation from beginning to end.-->
<!--                            </p>-->
<!--                        </div>-->

<!--                        <svg-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                            fill="none"-->
<!--                            viewBox="0 0 24 24"-->
<!--                            stroke-width="1.5"-->
<!--                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"-->
<!--                        >-->
<!--                            <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"-->
<!--                            />-->
<!--                        </svg>-->
<!--                    </a>-->

<!--                    <a-->
<!--                        href="https://laracasts.com"-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Laracasts</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript-->
<!--                                development. Check them out, see for yourself, and massively level up your development-->
<!--                                skills in the process.-->
<!--                            </p>-->
<!--                        </div>-->

<!--                        <svg-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                            fill="none"-->
<!--                            viewBox="0 0 24 24"-->
<!--                            stroke-width="1.5"-->
<!--                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"-->
<!--                        >-->
<!--                            <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"-->
<!--                            />-->
<!--                        </svg>-->
<!--                    </a>-->

<!--                    <a-->
<!--                        href="https://laravel-news.com"-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Laravel News</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laravel News is a community driven portal and newsletter aggregating all of the latest-->
<!--                                and most important news in the Laravel ecosystem, including new package releases and-->
<!--                                tutorials.-->
<!--                            </p>-->
<!--                        </div>-->

<!--                        <svg-->
<!--                            xmlns="http://www.w3.org/2000/svg"-->
<!--                            fill="none"-->
<!--                            viewBox="0 0 24 24"-->
<!--                            stroke-width="1.5"-->
<!--                            class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6"-->
<!--                        >-->
<!--                            <path-->
<!--                                stroke-linecap="round"-->
<!--                                stroke-linejoin="round"-->
<!--                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"-->
<!--                            />-->
<!--                        </svg>-->
<!--                    </a>-->

<!--                    <div-->
<!--                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"-->
<!--                    >-->
<!--                        <div>-->
<!--                            <div-->
<!--                                class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full"-->
<!--                            >-->
<!--                                <svg-->
<!--                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                    fill="none"-->
<!--                                    viewBox="0 0 24 24"-->
<!--                                    stroke-width="1.5"-->
<!--                                    class="w-7 h-7 stroke-red-500"-->
<!--                                >-->
<!--                                    <path-->
<!--                                        stroke-linecap="round"-->
<!--                                        stroke-linejoin="round"-->
<!--                                        d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64"-->
<!--                                    />-->
<!--                                </svg>-->
<!--                            </div>-->

<!--                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</h2>-->

<!--                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">-->
<!--                                Laravel's robust library of first-party tools and libraries, such as-->
<!--                                <a-->
<!--                                    href="https://forge.laravel.com"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Forge</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://vapor.laravel.com"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Vapor</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://nova.laravel.com"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Nova</a-->
<!--                                >, and-->
<!--                                <a-->
<!--                                    href="https://envoyer.io"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Envoyer</a-->
<!--                                >-->
<!--                                help you take your projects to the next level. Pair them with powerful open source-->
<!--                                libraries like-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/billing"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Cashier</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/dusk"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Dusk</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/broadcasting"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Echo</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/horizon"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Horizon</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/sanctum"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Sanctum</a-->
<!--                                >,-->
<!--                                <a-->
<!--                                    href="https://laravel.com/docs/telescope"-->
<!--                                    class="underline hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"-->
<!--                                    >Telescope</a-->
<!--                                >, and more.-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

<!--            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">-->
<!--                <div class="text-center text-sm sm:text-start">&nbsp;</div>-->

<!--                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0">-->
<!--                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<style>-->
<!--.bg-dots-darker {-->
<!--    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");-->
<!--}-->
<!--@media (prefers-color-scheme: dark) {-->
<!--    .dark\:bg-dots-lighter {-->
<!--        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");-->
<!--    }-->
<!--}-->
<!--</style>-->

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

// Таймер обратного отсчёта (14 дней от текущего момента)
const countdown = ref({
    days: '14',
    hours: '08',
    minutes: '45',
    seconds: '22'
});

// Форма уведомления
const emailInput = ref('');
const feedbackMsg = ref('');
const showFeedback = ref(false);
const isError = ref(false);

let timerInterval = null;

onMounted(() => {
    // Установка даты окончания (14 дней от текущего момента)
    let countDownDate = new Date();
    countDownDate.setDate(countDownDate.getDate() + 14);
    countDownDate.setHours(23, 59, 59, 999);

    function updateTimer() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance < 0) {
            countdown.value = {
                days: '00',
                hours: '00',
                minutes: '00',
                seconds: '00'
            };
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.value = {
            days: days < 10 ? '0' + days : String(days),
            hours: hours < 10 ? '0' + hours : String(hours),
            minutes: minutes < 10 ? '0' + minutes : String(minutes),
            seconds: seconds < 10 ? '0' + seconds : String(seconds)
        };
    }

    updateTimer();
    timerInterval = setInterval(updateTimer, 1000);

    // Параллакс эффект для карточки
    const card = document.querySelector('.coming-soon-card');

    function handleMouseMove(e) {
        if (!card) return;
        const x = (window.innerWidth / 2 - e.clientX) / 35;
        const y = (window.innerHeight / 2 - e.clientY) / 35;
        card.style.transform = `perspective(1000px) rotateY(${x * 0.5}deg) rotateX(${y * 0.2}deg) translateZ(5px)`;
    }

    function handleMouseLeave() {
        if (!card) return;
        card.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg) translateZ(0)';
    }

    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseleave', handleMouseLeave);

    // Очистка при размонтировании
    onBeforeUnmount(() => {
        if (timerInterval) clearInterval(timerInterval);
        document.removeEventListener('mousemove', handleMouseMove);
        document.removeEventListener('mouseleave', handleMouseLeave);
    });
});

// Обработка отправки email
const handleNotify = (e) => {
    e.preventDefault();

    const email = emailInput.value.trim();

    if (email && email.includes('@') && email.includes('.')) {
        // Успешная отправка
        feedbackMsg.value = '🍬 Спасибо! Как только халва появится — черкнём на почту.';
        isError.value = false;
        showFeedback.value = true;
        emailInput.value = '';

        setTimeout(() => {
            showFeedback.value = false;
        }, 5000);
    } else {
        // Ошибка валидации
        feedbackMsg.value = '⛔ Введи корректный email, чтобы не пропустить сладость.';
        isError.value = true;
        showFeedback.value = true;

        setTimeout(() => {
            showFeedback.value = false;
        }, 3000);
    }
};
</script>

<template>
    <Head title="Халва - правильное питание · Скоро" />

    <div class="min-h-screen bg-gradient-to-b from-amber-50 to-orange-50 flex items-center justify-center p-6 relative overflow-x-hidden">

        <!-- Навигация (логин/регистрация) в стиле карточки -->



        <!-- Плавающие эмодзи (ПП-атмосфера) -->
        <div class="floating-item item1">🥗</div>
        <div class="floating-item item2">🍯</div>
        <div class="floating-item item3">🥑</div>
        <div class="floating-item item4">🍉</div>
        <div class="floating-item item5">🥕</div>

        <!-- Основная карточка -->
        <main class="coming-soon-card">
            <!-- Верх с названием -->
            <div class="header-brand">
                <div class="logo-icon"><span>🍏</span></div>

                <div class="brand-name">ХАЛВА<span>правильное питание</span></div>
            </div>

            <!-- Главный тизер -->
            <div class="main-title">
                <h1>скоро открытие</h1>
              
            </div>

            <!-- Таймер обратного отсчёта -->
            <div class="countdown-box">
                <div class="time-unit">
                    <div class="time-value">{{ countdown.days }}</div>
                    <div class="time-label">дней</div>
                </div>
                <div class="time-unit">
                    <div class="time-value">{{ countdown.hours }}</div>
                    <div class="time-label">часов</div>
                </div>
                <div class="time-unit">
                    <div class="time-value">{{ countdown.minutes }}</div>
                    <div class="time-label">минут</div>
                </div>
                <div class="time-unit">
                    <div class="time-value">{{ countdown.seconds }}</div>
                    <div class="time-label">секунд</div>
                </div>
            </div>

            <!-- Текст-завлекалочка -->
            <div class="description">
                🌿 <strong>Халва доставка только свежих  продуктов</strong> —<br>
                скоро ты сможешь попробовать всё это и не только!
            </div>

            <!-- Форма для уведомления -->


            <!-- Область для ответа -->
            <div
                class="feedback-msg"
                :class="{ 'show': showFeedback, 'error': isError }"
                :style="{
                    background: isError ? '#f9e3d0' : '#e9f0da',
                    color: isError ? '#a33d18' : '#3b5e2b'
                }"
            >
                {{ feedbackMsg }}
            </div>

            <!-- Иконки соцсетей (декоративные) -->


            <div class="footnote">
                ⏳ скоро запуск · осталось совсем чуть-чуть
            </div>
        </main>
    </div>
</template>

<style scoped>
/* СБРОС И БАЗОВЫЕ НАСТРОЙКИ (дублируем стили из HTML) */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Roboto, system-ui, -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif;
}

/* декоративные элементы фона (съедобное настроение) */
.floating-item {
    position: absolute;
    opacity: 0.2;
    pointer-events: none;
    z-index: 1;
    font-size: 4rem;
    user-select: none;
    animation: float 12s infinite ease-in-out;
}

.item1 { top: 5%; left: 3%; animation-delay: 0s; font-size: 5rem; }
.item2 { bottom: 8%; right: 2%; animation-delay: 2s; font-size: 6rem; }
.item3 { top: 15%; right: 12%; animation-delay: 4s; font-size: 4.2rem; }
.item4 { bottom: 20%; left: 8%; animation-delay: 1s; font-size: 5.5rem; }
.item5 { top: 30%; left: 20%; animation-delay: 3s; font-size: 3.8rem; }

@keyframes float {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(8deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}

/* основной контейнер-карточка */
.coming-soon-card {
    position: relative;
    z-index: 10;
    max-width: 880px;
    width: 100%;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 68px 32px 72px 32px;
    box-shadow: 0 35px 75px -15px rgba(170, 130, 70, 0.35),
    0 0 0 1px rgba(255, 245, 225, 0.6) inset,
    0 0 40px rgba(255, 215, 165, 0.3);
    padding: 3.5rem 2.5rem;
    border: 1px solid rgba(255, 235, 205, 0.7);
    transition: all 0.3s;
}

/* шапка с логотипом */
.header-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 18px;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.logo-icon {
    font-size: 4rem;
    line-height: 1;
    filter: drop-shadow(0 8px 12px rgba(230, 150, 50, 0.25));
    background: #fff3e0;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 15px 25px -8px rgba(190, 130, 30, 0.3), 0 4px 0 0 #f9d9b0 inset;
}

.logo-icon span {
    transform: scale(1.2);
    display: inline-block;
}

.brand-name {
    font-size: 3.2rem;
    font-weight: 700;
    letter-spacing: 1px;
    background: linear-gradient(145deg, #ac6b2b 0%, #7a4c1d 40%, #b4722a 80%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 2px 10px rgba(220, 150, 50, 0.2);
}

.brand-name span {
    font-weight: 300;
    font-size: 2rem;
    color: #c9873a;
    background: none;
    text-shadow: none;
    margin-left: 0.3rem;
}

/* основной заголовок */
.main-title {
    text-align: center;
    margin: 2rem 0 1.8rem;
    position: relative;
}

.main-title h1 {
    font-size: 4.2rem;
    font-weight: 800;
    line-height: 1.1;
    color: #3f2e1a;
    letter-spacing: -0.01em;
    text-transform: uppercase;
    background: linear-gradient(165deg, #755320 0%, #a86123 45%, #623f16 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 4px 20px rgba(190, 130, 40, 0.4);
}

.main-title .sub {
    font-size: 1.5rem;
    font-weight: 300;
    color: #7b623a;
    background: rgba(250, 235, 200, 0.7);
    display: inline-block;
    padding: 0.5rem 2rem;
    border-radius: 60px;
    backdrop-filter: blur(4px);
    margin-top: 1rem;
    border: 1px solid #e9cba0;
    box-shadow: 0 6px 14px rgba(150, 100, 30, 0.1);
}

/* таймер обратного отсчёта */
.countdown-box {
    margin: 3rem auto 2.5rem;
    display: flex;
    justify-content: center;
    gap: 1.8rem;
    flex-wrap: wrap;
}

.time-unit {
    background: linear-gradient(165deg, #faeedb, #f5e2ca);
    min-width: 110px;
    padding: 1.2rem 0.5rem;
    border-radius: 40px 18px 40px 18px;
    box-shadow: 0 12px 0 #cb9f6b, 0 20px 30px -8px #e1b585;
    text-align: center;
    border: 2px solid #ffeaca;
    transition: transform 0.2s;
}

.time-unit:hover {
    transform: scale(1.02);
}

.time-value {
    font-size: 4.2rem;
    font-weight: 800;
    line-height: 1;
    color: #52391c;
    text-shadow: 0 2px 5px #fce3c0;
    letter-spacing: 4px;
}

.time-label {
    font-size: 1.1rem;
    text-transform: uppercase;
    font-weight: 500;
    color: #7f613b;
    background: #efdbbc;
    display: inline-block;
    padding: 0.3rem 1.2rem;
    border-radius: 30px;
    margin-top: 0.3rem;
    letter-spacing: 0.5px;
}

/* описание */
.description {
    text-align: center;
    font-size: 1.4rem;
    color: #4d3b22;
    margin: 2rem 0 2.5rem;
    font-weight: 400;
    background: rgba(255, 240, 215, 0.6);
    padding: 1.2rem 2rem;
    border-radius: 80px 18px 80px 18px;
    line-height: 1.5;
    border: 1px dashed #dbb47a;
    backdrop-filter: blur(4px);
}

.description strong {
    font-weight: 700;
    color: #894e18;
}

/* форма оповещения */
.notify-form {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    margin: 2.8rem 0 1.2rem;
}

.email-input {
    flex: 1 1 280px;
    padding: 1.2rem 1.8rem;
    border: none;
    background: #fbf3e7;
    border-radius: 56px 16px 56px 16px;
    font-size: 1.2rem;
    color: #3b2d18;
    outline: 2px solid transparent;
    transition: 0.25s;
    box-shadow: 0 10px 18px -10px #ccaa7b, 0 0 0 2px #f3dbb8 inset;
}

.email-input:focus {
    outline: 2px solid #d99e4d;
    background: #fffbf5;
    box-shadow: 0 18px 25px -14px #b57a36;
}

.email-input::placeholder {
    color: #b09773;
    font-weight: 300;
    font-style: italic;
}

.notify-btn {
    background: linear-gradient(115deg, #b5772a, #e3a459);
    border: none;
    padding: 1.2rem 2.8rem;
    border-radius: 60px 16px 60px 16px;
    font-size: 1.4rem;
    font-weight: 600;
    color: #2e1f0e;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    box-shadow: 0 12px 0 #7e501f, 0 12px 25px -5px #ac823b;
    cursor: pointer;
    transition: 0.1s linear, transform 0.1s, box-shadow 0.1s;
    border: 1px solid #fdc38c;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.notify-btn:active {
    transform: translateY(6px);
    box-shadow: 0 6px 0 #7e501f, 0 15px 25px -5px #d8a252;
}

/* сообщение после отправки */
.feedback-msg {
    text-align: center;
    min-height: 3rem;
    font-size: 1.3rem;
    font-weight: 500;
    padding: 0.8rem;
    border-radius: 60px;
    width: fit-content;
    margin: 1.5rem auto 0.5rem;
    border: 1px solid #b3b483;
    display: none;
    transition: all 0.3s;
}

.feedback-msg.show {
    display: block;
}

.feedback-msg.error {
    border-color: #dbaa8b;
}

/* социальные ссылки */
.social-links {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 2.8rem;
    font-size: 2rem;
}

.social-link {
    text-decoration: none;
    color: #8f673b;
    width: 64px;
    height: 64px;
    background: #fcf3e4;
    border-radius: 30% 30% 30% 30%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 0 #b1854b, 0 10px 20px -7px #c59658;
    transition: all 0.2s;
    border: 2px solid #ffdbb0;
    cursor: pointer;
}

.social-link:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 0 #b1854b, 0 15px 25px -5px #b87f3f;
    background: #fff3e0;
    color: #7b4d1b;
}

/* footer */
.footnote {
    margin-top: 2rem;
    font-size: 1rem;
    color: #b29066;
    text-align: center;
    border-top: 2px dotted #e5cbaa;
    padding-top: 1.8rem;
}

/* адаптив */
@media (max-width: 600px) {
    .coming-soon-card { padding: 2rem 1.2rem; }
    .main-title h1 { font-size: 2.8rem; }
    .brand-name { font-size: 2.4rem; }
    .time-unit { min-width: 70px; }
    .time-value { font-size: 2.8rem; }
    .time-label { font-size: 0.8rem; }
    .description { font-size: 1.1rem; }
    .notify-btn { font-size: 1.1rem; padding: 1rem 1.8rem; }
    .floating-item { font-size: 2.5rem; }
}
</style>
