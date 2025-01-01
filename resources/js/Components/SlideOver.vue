<template>
    <TransitionRoot as="template" :show="true" @close="close">
        <Dialog as="div" class="relative z-40">
            <div class="fixed inset-0" />

            <div class="fixed inset-0 overflow-hidden">
                <div
                    class="absolute inset-0 bg-opacity-40 dark:bg-opacity-60 bg-zinc-900/20 dark:bg-black"
                >
                    <div
                        class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full sm:pl-16"
                    >
                        <TransitionChild
                            as="template"
                            enter="transform transition ease-in-out duration-500 sm:duration-700"
                            enter-from="translate-x-full"
                            enter-to="translate-x-0"
                            leave="transform transition ease-in-out duration-500 sm:duration-700"
                            leave-from="translate-x-0"
                            leave-to="translate-x-full"
                        >
                            <DialogPanel
                                class="pointer-events-auto w-screen max-w-xl"
                            >
                                <div
                                    class="flex h-full flex-col overflow-y-scroll bg-white dark:bg-zinc-900 9 shadow-xl"
                                >
                                    <div class="px-4 py-6 sm:px-6">
                                        <div
                                            class="flex items-start justify-between"
                                        >
                                            <div
                                                class="text-xl font-medium text-black dark:text-white"
                                            >
                                                <slot name="title" />
                                            </div>
                                            <div
                                                class="ml-3 flex h-7 items-center"
                                            >
                                                <button
                                                    type="button"
                                                    class="rounded text-zinc-400 dark:text-zinc-700 hover:text-zinc-500 hover:dark:text-zinc-400 outline-none"
                                                    @click="close"
                                                >
                                                    <span class="sr-only"
                                                        >Close panel</span
                                                    >
                                                    <IconX
                                                        class="h-6 w-6"
                                                        aria-hidden="true"
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Main -->
                                    <div class="px-4 sm:px-6">
                                        <slot name="content" />
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { IconX } from "@tabler/icons-vue";

const show = ref(false);

const open = () => (show.value = true);
defineExpose({ open });

const emit = defineEmits(["close"]);

const close = () => {
    emit("close");
};
</script>
