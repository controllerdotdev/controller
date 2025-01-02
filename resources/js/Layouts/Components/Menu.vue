<script setup>
import { ref, onMounted, computed } from "vue";
import { usePage, router, Link } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import helper from "@/helper";

import {
    IconInbox,
    IconAt,
    IconSquareAsterisk,
    IconTelescope,
    IconConfetti,
    IconUsersGroup,
    IconGift,
    IconSettings,
    IconUsers,
    IconWorldShare,
    IconTrendingUp,
    IconMapNorth,
    IconProgressBolt,
    IconLifebuoy,
    IconBook,
    IconLockSquare,
    IconAccessPoint,
} from "@tabler/icons-vue";

const navigation = [
    {
        group: "Issues",
        items: [
            {
                name: "All Issues",
                href: route("issues.index"),
                current: route().current("issues.*"),
                icon: IconInbox,
                show: true,
            },
        ],
    },

    {
        group: "Organization",
        items: [
            {
                name: "Settings",
                href: route("setting.workspace.edit"),
                current: route().current("setting.*"),
                target: "_self",
                icon: IconSettings,
                show: true,
            },
        ],
    },
];

const openLink = (item) => {
    // open in new tab
    if (item.target == "_blank") {
        return window.open(item.href, "_blank");
    }

    router.visit(item.href);
};
</script>

<template>
    <nav class="flex-1 flex flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-6">
            <li>
                <ul role="list" class="-mx-2 space-y-2">
                    <li v-for="group in navigation" :key="group">
                        <div
                            class="text-sm text-zinc-600 dark:text-white tracking-wider font-medium mb-0.5"
                        >
                            {{ group.group }}
                        </div>
                        <div class="space-y-px">
                            <ul v-for="item in group.items" :key="item">
                                <li
                                    @click="openLink(item)"
                                    :class="{
                                        'bg-zinc-200 dark:bg-zinc-900 text-black dark:text-white':
                                            item.current,
                                        'text-zinc-900 hover:bg-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white':
                                            !item.current,

                                        'group flex items-center gap-x-3 rounded-lg py-1 px-3 text-sm font-medium cursor-pointer': true,
                                        hidden: !item.show,
                                    }"
                                >
                                    <component
                                        :is="item.icon"
                                        class="h-4 w-4 stroke-2"
                                        aria-hidden="true"
                                    />
                                    <div
                                        class="flex flex-1 items-center justify-between"
                                    >
                                        <div>{{ item.name }}</div>

                                        <div
                                            v-if="
                                                item.name == 'Inbox' &&
                                                totalPendingInbox >= 1
                                            "
                                            class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-white bg-red-400"
                                        >
                                            {{ totalPendingInbox }}
                                        </div>

                                        <span
                                            v-if="item.new"
                                            class="inline-flex items-center rounded bg-violet-600/10 px-2 py-0.5 text-xs font-medium text-violet-600 dark:text-violet-500 ring-1 ring-inset ring-violet-600/20"
                                        >
                                            New
                                        </span>

                                        <span
                                            v-if="item.progress"
                                            class="inline-flex items-center rounded bg-violet-600/10 px-2 py-0.5 text-xs font-medium text-violet-600 dark:text-violet-500 ring-1 ring-inset ring-violet-600/20"
                                        >
                                            {{ item.progress }}
                                        </span>
                                    </div>
                                </li>

                                <div
                                    v-if="item.items && item.current"
                                    class="py-1"
                                >
                                    <div class="">
                                        <ul
                                            v-for="item in item.items"
                                            :key="item"
                                        >
                                            <Link
                                                :href="item.href"
                                                as="li"
                                                preserve-scroll
                                                preserve-state
                                                :class="[
                                                    'pt-0.5 ml-5 -0 border-l border-zinc-300 dark:border-zinc-700',
                                                ]"
                                            >
                                                <div
                                                    :class="[
                                                        item.current
                                                            ? 'text-black dark:text-white'
                                                            : 'text-zinc-600 hover:bg-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white',
                                                        'ml-4 group flex gap-x-2 rounded py-1.5 px-1.5 text-sm font-medium cursor-pointer',
                                                    ]"
                                                >
                                                    <div></div>
                                                    <div
                                                        class="flex flex-1 items-center justify-between"
                                                    >
                                                        <div>
                                                            {{ item.name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </Link>
                                        </ul>
                                    </div>
                                </div>

                                <!-- <li
                                    v-if="item.items && item.current"
                                    role="list"
                                    class="ml-8 mt-1"
                                >
                                    <ul v-for="item in item.items" :key="item">
                                        <li
                                            @click="openLink(item)"
                                            :class="[
                                                item.current
                                                    ? 'text-black dark:text-white'
                                                    : 'text-zinc-500 dark:text-zinc-500 hover:text-black dark:hover:text-white',
                                                'group flex  gap-x-2 rounded py-1 px-3 text-sm font-medium cursor-pointer',
                                            ]"
                                        >
                                            <div
                                                class="flex flex-1 items-center justify-between"
                                            >
                                                <div>{{ item.name }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>

        <ul role="list">
            <li>
                <ul role="list" class="-mx-2 space-y-4">
                    <li>
                        <div class="space-y-0.5">
                            <!-- <li>
                                <div
                                    class="changelogfy-widget cursor-pointer text-zinc-600 dark:text-zinc-500 hover:text-black dark:hover:text-white hover:bg-zinc-200 dark:hover:bg-[#1d212e] group flex items-center gap-x-3 rounded py-2 px-3 text-sm font-medium"
                                >
                                    <IconGift
                                        class="h-5 w-5 shrink-0"
                                        aria-hidden="true"
                                    />
                                    <div>What's New</div>
                                </div>
                            </li> -->
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>
