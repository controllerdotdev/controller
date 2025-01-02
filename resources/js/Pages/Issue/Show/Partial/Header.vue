<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";

defineProps({
    title: String,
    status: String,
    priority: String,
    environment: String,
});

const emit = defineEmits(["update-status", "update-priority"]);
</script>

<template>
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="container mx-auto px-4 py-4">
            <!-- Breadcrumb -->
            <div
                class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400"
            >
                <span>Issues</span>
                <span>/</span>
                <span>{{ title }}</span>
            </div>

            <!-- Title & Actions -->
            <div class="mt-2 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ title }}
                </h1>

                <div class="flex items-center space-x-3">
                    <!-- Environment Badge -->
                    <span
                        class="px-2 py-1 text-xs rounded-full"
                        :class="{
                            'bg-green-100 text-green-800':
                                environment === 'production',
                            'bg-blue-100 text-blue-800':
                                environment === 'staging',
                            'bg-gray-100 text-gray-800':
                                environment === 'development',
                        }"
                    >
                        {{ environment }}
                    </span>

                    <!-- Status Dropdown -->
                    <Menu as="div" class="relative">
                        <MenuButton
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            Status: {{ status }}
                        </MenuButton>

                        <MenuItems
                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5"
                        >
                            <MenuItem v-slot="{ active }">
                                <button
                                    class="w-full text-left px-4 py-2 text-sm"
                                    :class="[
                                        active
                                            ? 'bg-gray-100 dark:bg-gray-600'
                                            : '',
                                    ]"
                                    @click="$emit('update-status', 'open')"
                                >
                                    Open
                                </button>
                            </MenuItem>
                            <!-- Adicionar outros status -->
                        </MenuItems>
                    </Menu>

                    <!-- Priority Dropdown -->
                    <Menu as="div" class="relative">
                        <MenuButton
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium"
                            :class="{
                                'text-red-700 bg-red-50':
                                    priority === 'critical',
                                'text-yellow-700 bg-yellow-50':
                                    priority === 'high',
                                'text-blue-700 bg-blue-50':
                                    priority === 'medium',
                                'text-gray-700 bg-gray-50': priority === 'low',
                            }"
                        >
                            Priority: {{ priority }}
                        </MenuButton>

                        <MenuItems
                            class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5"
                        >
                            <!-- Adicionar prioridades -->
                        </MenuItems>
                    </Menu>
                </div>
            </div>
        </div>
    </div>
</template>
