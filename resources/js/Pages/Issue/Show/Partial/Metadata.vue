<script setup>
defineProps({
    issue: Object,
    tags: Object,
    context: Object,
    requestData: Object,
});
</script>

<template>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <!-- Tags -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                Tags
            </h3>
            <div class="mt-2 space-y-2">
                <div
                    v-for="(value, key) in tags"
                    :key="key"
                    class="flex justify-between text-sm"
                >
                    <span class="text-gray-500 dark:text-gray-400">{{
                        key
                    }}</span>
                    <span class="text-gray-900 dark:text-white">{{
                        value
                    }}</span>
                </div>
            </div>
        </div>

        <!-- Request Data -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                Request
            </h3>
            <div class="mt-2 space-y-2">
                <div v-if="requestData.url" class="text-sm">
                    <span class="text-gray-500 dark:text-gray-400">URL:</span>
                    <span class="ml-2 text-gray-900 dark:text-white">{{
                        requestData.url
                    }}</span>
                </div>
                <div v-if="requestData.method" class="text-sm">
                    <span class="text-gray-500 dark:text-gray-400"
                        >Method:</span
                    >
                    <span class="ml-2 text-gray-900 dark:text-white">{{
                        requestData.method
                    }}</span>
                </div>
            </div>
        </div>

        <!-- Runtime Info -->
        <div class="p-4">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                Runtime
            </h3>
            <div class="mt-2 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400"
                        >First Seen</span
                    >
                    <span class="text-gray-900 dark:text-white">{{
                        new Date(issue.first_seen_at).toLocaleString()
                    }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400"
                        >Last Seen</span
                    >
                    <span class="text-gray-900 dark:text-white">{{
                        new Date(issue.last_seen_at).toLocaleString()
                    }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Events</span>
                    <span class="text-gray-900 dark:text-white">{{
                        issue.events_count
                    }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
