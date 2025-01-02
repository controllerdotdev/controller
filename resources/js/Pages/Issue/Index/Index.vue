<script setup>
import { ref, onMounted, onBeforeUnmount, computed, watch } from "vue";
import { usePage, Head, Link } from "@inertiajs/vue3";

import { IconArrowRight, IconPin, IconConfetti } from "@tabler/icons-vue";
import date from "@/date";

import Layout from "@/Layouts/Master.vue";
import Button from "@/Components/Button.vue";
import EmptyState from "@/Components/EmptyState.vue";
import Pagination from "@/Components/Pagination.vue";
import Search from "./Search.vue";

const user = usePage().props.auth.user;

const props = defineProps({
    hasData: Boolean,
    table: Object,
});
</script>

<template>
    <Head title="Changelogs - Changelogfy" />
    <Layout :fluid="true">
        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="page-title">Changelog</h1>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 flex space-x-2 sm:flex-none">
                    <Search />
                </div>
            </div>
        </template>

        <div class="px-4 sm:px-0">
            <div class="flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div class="table-wrapper">
                            <table class="table">
                                <thead class="table-thead">
                                    <tr class="table-tr">
                                        <th scope="col" class="table-th">
                                            Title
                                        </th>
                                        <th scope="col" class="table-th">
                                            Labels
                                        </th>
                                        <th scope="col" class="table-th">
                                            Author
                                        </th>
                                        <th scope="col" class="table-th">
                                            Status
                                        </th>
                                        <th scope="col" class="table-th">
                                            Published At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    <Link
                                        v-for="data in table.data"
                                        :key="data"
                                        as="tr"
                                        class="table-tr"
                                        :href="
                                            route('issues.show', {
                                                id: data.id,
                                            })
                                        "
                                    >
                                        <td class="table-td">
                                            {{ data.title }}
                                        </td>
                                        <td class="table-td">
                                            {{ data.priority }}
                                        </td>
                                        <td class="table-td">
                                            {{ data.last_issue_at }}
                                        </td>
                                    </Link>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <template v-if="table.next_page_url" #pagination>
            <Pagination :data="table" />
        </template>

        <EmptyState
            v-if="!hasData"
            :icon="IconConfetti"
            title="Create your first Changelog"
            description="Get started by creating your first Changelog."
        />
    </Layout>
</template>
