<script setup>
import { ref, computed, onMounted, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

import { useDarkTheme } from "@/theme";
const { isDarkTheme } = useDarkTheme();

import Sidebar from "./Sidebar.vue";
import SettingSidebar from "./SettingSidebar.vue";
import Banner from "@/Components/Banner.vue";

const { fluid, overflow } = defineProps({
    fluid: {
        type: Boolean,
        default: false,
    },

    overflow: {
        type: Boolean,
        default: true,
    },
});

const user = computed(() => usePage().props.auth.user);
</script>

<template>
    <Banner />
    <div
        class="h-screen overflow-hidden flex flex-col bg-zinc-100 dark:bg-zinc-900"
    >
        <Sidebar v-if="!route().current('setting.*')" />
        <SettingSidebar v-if="route().current('setting.*')" />

        <div class="lg:pl-64 pl-2 pr-2 py-2 overflow-hidden w-full h-full">
            <div
                class="bg-white dark:bg-zinc-800 w-full h-full border border-zinc-300 dark:border-zinc-700 rounded-lg shadow-lg dark:shadow-none overflow-hidden"
            >
                <div
                    :class="{
                        'overflow-x-hidden h-full': true,
                        'overflow-y-auto': overflow,
                        'overflow-y-hidden': !overflow,
                    }"
                >
                    <div
                        :class="{
                            'h-full flex flex-col justify-between': true,
                            'max-w-5xl mx-auto py-0 px-0 sm:py-12 sm:px-12':
                                !fluid,
                        }"
                    >
                        <div
                            v-if="$slots.header"
                            :class="{
                                'border-b border-zinc-100 dark:border-zinc-700': true,
                                'px-4 py-2.5 sticky top-0 bg-white z-10 dark:bg-zinc-900':
                                    fluid,
                                'px-4 pt-4 sm:pt-0 pb-4 sm:px-0 sm:pb-8 mb-4 sm:mb-8 z-10 bg-white dark:bg-zinc-800':
                                    !fluid,
                            }"
                        >
                            <slot name="header"></slot>
                        </div>

                        <div
                            :class="{
                                'flex flex-col flex-1 w-full ': true,
                                'px-4 py-4 sm:px-0 sm:py-0': fluid,
                                'overflow-hidden': !overflow,
                            }"
                        >
                            <slot />
                        </div>
                        <div
                            v-if="$slots.pagination"
                            class="px-4 sticky bottom-0 border-t border-zinc-100 dark:border-zinc-700 bg-white dark:bg-zinc-900"
                        >
                            <slot name="pagination"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
