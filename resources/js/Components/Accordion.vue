<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { IconChevronDown } from "@tabler/icons-vue";
</script>

<template>
    <div>
        <Disclosure v-slot="{ open }">
            <DisclosureButton
                :class="{
                    'w-full': true,
                    'border-x border-t rounded-t-md group hover:border-zinc-500 cursor-pointer text-sm': true,
                    'border-zinc-200 dark:border-zinc-600 border-b rounded-b-md':
                        !open,
                    'border-zinc-500 dark:border-zinc-600': open,
                }"
            >
                <div class="flex items-center justify-between space-x-2 p-4">
                    <div
                        class="font-medium text-black dark:text-zinc-300 group-hover:text-zinc-600 dark:group-hover:text-white"
                    >
                        <slot name="title" />
                    </div>
                    <IconChevronDown
                        :class="{
                            'h-5 w-5 text-zinc-400 group-hover:text-zinc-600 flex-none': true,
                            '-rotate-0': !open,
                            'rotate-180 transform': open,
                        }"
                    />
                </div>
            </DisclosureButton>
            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-out"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <DisclosurePanel>
                    <div
                        :class="{
                            ' grid grid-cols-6 gap-x-6 gap-y-4 hover:border-zinc-600 cursor-pointer text-sm p-4': true,
                            'border-zinc-100 ': !open,
                            'border-zinc-600 border-b border-x rounded-b-md':
                                open,
                        }"
                    >
                        <slot name="content" />
                    </div>
                </DisclosurePanel>
            </transition>
        </Disclosure>
    </div>
</template>
