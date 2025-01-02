<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

import { IconX, IconMenu2, IconChevronLeft } from "@tabler/icons-vue";

import MenuSetting from "./Components/MenuSetting.vue";

const sidebarOpen = ref(false);

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

defineExpose({
    toggleSidebar,
});
</script>

<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog
            as="div"
            class="relative z-40 lg:hidden"
            @close="sidebarOpen = false"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-zinc-900/80" />
            </TransitionChild>

            <div class="fixed inset-0 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative mr-16 flex w-full max-w-xs flex-1"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div
                                class="absolute left-full top-0 flex w-16 justify-center pt-5"
                            >
                                <button
                                    type="button"
                                    class="-m-2.5 p-2.5"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <IconX
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div
                            class="flex grow flex-col gap-y-5 overflow-y-auto bg-zinc-100 dark:bg-zinc-800 px-6 py-4 pb-2 ring-1 ring-white/10"
                        >
                            <div class="flex items-center space-x-3">
                                <Link
                                    class="rounded border border-zinc-300 dark:border-zinc-800 hover:bg-zinc-50 text-black dark:text-white p-1.5 -ml-2"
                                    :href="route('issues.index')"
                                >
                                    <IconChevronLeft class="w-4 h-4" />
                                </Link>
                                <h3 class="page-title">Settings</h3>
                            </div>
                            <MenuSetting />
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-64 lg:flex-col h-full"
    >
        <div
            class="flex-1 flex flex-col overflow-y-auto bg-zinc-100 dark:bg-zinc-900 px-6 py-4"
        >
            <div class="flex items-center space-x-3 mb-4">
                <Link
                    class="rounded hover:bg-zinc-200 dark:hover:bg-zinc-800 px-2 py-1 -ml-2 flex items-center gap-x-2 text-zinc-800 dark:text-zinc-400 group-hover:text-zinc-800 dark:group-hover:text-white"
                    :href="route('issues.index')"
                >
                    <IconChevronLeft class="w-4 h-4" />
                    <div class="text-sm font-medium">Back to App</div>
                </Link>
            </div>

            <MenuSetting />
        </div>
    </div>

    <div
        class="sticky top-0 z-40 flex items-center gap-x-6 bg-zinc-900 px-4 py-4 shadow-sm sm:px-6 lg:hidden"
    >
        <button
            type="button"
            class="-m-2.5 p-2.5 text-zinc-400 lg:hidden"
            @click="sidebarOpen = true"
        >
            <span class="sr-only">Open sidebar</span>
            <IconMenu2 class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex-1 text-sm font-semibold leading-6 text-white">
            Dashboard
        </div>
    </div>
</template>
