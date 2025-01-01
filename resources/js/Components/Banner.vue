<script setup>
import { computed, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";

import {
    IconX,
    IconCircleCheck,
    IconCircleX,
    IconExclamationCircle,
    IconInfoCircle,
} from "@tabler/icons-vue";

const show = ref(true);
const style = computed(() => usePage().props.flash?.bannerStyle || "success");
const message = computed(() => usePage().props.flash?.banner || "");

watch(message, async () => {
    show.value = true;
    setTimeout(() => {
        show.value = false;
    }, 3000);
});
</script>

<template>
    <div
        v-if="show && message"
        class="fixed inset-0 flex px-4 py-6 pointer-events-none sm:p-6 sm:items-start z-50"
    >
        <div
            class="w-full flex flex-col absolute bottom-5 right-5 items-end space-y-4"
        >
            <transition
                enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    v-if="show"
                    class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-zinc-800 shadow-2xl ring-1 ring-transparent dark:ring-zinc-700 ring-opacity-5"
                >
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-0.5">
                                <IconCircleCheck
                                    v-if="style == 'success'"
                                    class="h-6 w-6 text-green-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <IconCircleX
                                    v-if="style == 'danger'"
                                    class="h-6 w-6 text-red-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <IconInfoCircle
                                    v-if="style == 'info'"
                                    class="h-6 w-6 text-blue-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <IconExclamationCircle
                                    v-if="style == 'warning'"
                                    class="h-6 w-6 text-yellow-400 stroke-2"
                                    aria-hidden="true"
                                />
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-white">
                                    {{ message }}
                                </p>
                                <p class="mt-0.5 text-xs text-zinc-400">
                                    This will close in a few seconds.
                                </p>
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                <button
                                    type="button"
                                    @click="show = false"
                                    class="inline-flex rounded-md bg-transparent text-zinc-400 hover:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                >
                                    <span class="sr-only">Close</span>
                                    <IconX class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>
