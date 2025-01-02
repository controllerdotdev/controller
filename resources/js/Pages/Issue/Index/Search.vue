<script setup>
import { ref, onMounted, onBeforeUnmount, computed, reactive } from "vue";
import { router, Link } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import {
    IconSearch,
    IconFilterCog,
    IconSquare,
    IconSquareCheckFilled,
    IconTrendingUp,
} from "@tabler/icons-vue";

import debounce from "@/debounce";
import Input from "@/Components/Input.vue";

const q = ref("");

const search = debounce(() => {
    router.visit(
        route("issues.index", {
            q: q.value,
        }),
        {
            method: "get",
            preserveScroll: true,
            preserveState: true,
        }
    );
}, 300);
</script>

<template>
    <div class="relative flex-1">
        <div
            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
        >
            <IconSearch class="h-5 w-5 text-zinc-400" />
        </div>
        <Input
            class="w-full !pl-10"
            id="search-field"
            autocomplete="off"
            type="text"
            placeholder="Search..."
            ref="search"
            v-model="q"
            @keyup="search"
        />
    </div>
</template>
