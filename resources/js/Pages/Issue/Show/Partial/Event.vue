<script setup>
import { computed } from "vue";

const props = defineProps({
    events: {
        type: Array,
        required: true,
    },
});

const formattedEvents = computed(() => {
    return props.events.map((event) => ({
        ...event,
        formattedDate: new Date(event.created_at).toLocaleString(),
    }));
});
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                Events ({{ events.length }})
            </h2>
        </div>

        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <div v-for="event in formattedEvents" :key="event.id" class="p-4">
                <div class="flex items-start justify-between">
                    <div class="space-y-1">
                        <!-- Timestamp -->
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ event.formattedDate }}
                        </div>

                        <!-- Environment & Release -->
                        <div class="flex items-center space-x-2">
                            <span
                                class="px-2 py-1 text-xs rounded-full"
                                :class="{
                                    'bg-green-100 text-green-800':
                                        event.environment === 'production',
                                    'bg-blue-100 text-blue-800':
                                        event.environment === 'staging',
                                    'bg-gray-100 text-gray-800':
                                        event.environment === 'development',
                                }"
                            >
                                {{ event.environment }}
                            </span>
                            <span
                                v-if="event.release"
                                class="text-sm text-gray-500 dark:text-gray-400"
                            >
                                Release: {{ event.release }}
                            </span>
                        </div>

                        <!-- User Data -->
                        <div v-if="event.user_data" class="mt-2">
                            <h4
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                User Info
                            </h4>
                            <div
                                class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                            >
                                <div v-if="event.user_data.id">
                                    ID: {{ event.user_data.id }}
                                </div>
                                <div v-if="event.user_data.email">
                                    Email: {{ event.user_data.email }}
                                </div>
                                <div v-if="event.user_data.ip_address">
                                    IP: {{ event.user_data.ip_address }}
                                </div>
                            </div>
                        </div>

                        <!-- Request Data -->
                        <div v-if="event.request_data" class="mt-2">
                            <h4
                                class="text-sm font-medium text-gray-700 dark:text-gray-300"
                            >
                                Request Info
                            </h4>
                            <div
                                class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
