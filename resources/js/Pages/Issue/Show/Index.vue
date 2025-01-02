<script setup>
import { ref, onMounted } from "vue";
import Layout from "@/Layouts/Master.vue";
import Header from "./Partial/Header.vue";
import StackTrace from "./Partial/StackTrace.vue";
import Metadata from "./Partial/Metadata.vue";
import Event from "./Partial/Event.vue";

const { issue } = defineProps({
    issue: Object,
});

const updateStatus = async (newStatus) => {
    // Implementar atualização de status
};

const updatePriority = async (newPriority) => {
    // Implementar atualização de prioridade
};
</script>

<template>
    <Layout :fluid="true">
        <div>
            <!-- Header com informações principais -->
            <Header
                :title="issue.title"
                :status="issue.status"
                :priority="issue.priority"
                :environment="issue.environment"
                @update-status="updateStatus"
                @update-priority="updatePriority"
            />

            <!-- Conteúdo Principal -->
            <div class="container mx-auto px-4 py-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Coluna Principal (2/3) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Exception e Stack Trace -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow"
                        >
                            <div
                                class="p-4 border-b border-gray-200 dark:border-gray-700"
                            >
                                <h2
                                    class="text-lg font-medium text-gray-900 dark:text-white"
                                >
                                    {{ issue.exception_class }}
                                </h2>
                                <p
                                    class="mt-1 text-sm text-gray-500 dark:text-gray-400"
                                >
                                    {{ issue.message }}
                                </p>
                            </div>

                            <StackTrace :stack-trace="issue.stack_trace" />
                        </div>

                        <!-- Events/Ocorrências -->
                        <Event :events="issue.issue_events" />
                    </div>

                    <!-- Sidebar (1/3) -->
                    <div class="space-y-6">
                        <Metadata
                            :issue="issue"
                            :tags="issue.tags"
                            :context="issue.context"
                            :request-data="issue.request_data"
                        />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
