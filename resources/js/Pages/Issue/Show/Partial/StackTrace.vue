<script setup>
defineProps({
    stackTrace: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="overflow-x-auto">
        <div class="p-4 space-y-4">
            <div
                v-for="(frame, index) in stackTrace.frames"
                :key="index"
                class="font-mono text-sm"
            >
                <div class="flex items-start space-x-2">
                    <!-- Linha do código -->
                    <div
                        class="flex-none w-16 text-gray-400 dark:text-gray-500"
                    >
                        {{ frame.lineno }}
                    </div>

                    <!-- Arquivo e função -->
                    <div class="flex-1">
                        <div class="text-gray-900 dark:text-gray-100">
                            {{ frame.filename }}
                        </div>
                        <div
                            class="text-gray-500 dark:text-gray-400"
                            v-if="frame.function"
                        >
                            in {{ frame.function }}
                        </div>
                    </div>

                    <!-- Indicador se é código da aplicação -->
                    <div class="flex-none" v-if="frame.in_app">
                        <span
                            class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100"
                        >
                            App
                        </span>
                    </div>
                </div>

                <!-- Contexto do código -->
                <div v-if="frame.context_line" class="mt-2 pl-20">
                    <pre
                        class="text-xs bg-gray-50 dark:bg-gray-900 p-2 rounded"
                        >{{ frame.context_line }}</pre
                    >
                </div>
            </div>
        </div>
    </div>
</template>
