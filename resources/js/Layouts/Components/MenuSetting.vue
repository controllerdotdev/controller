<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const workspace = usePage().props.auth.user.current_workspace;

import {
    IconMailCog,
    IconMailBolt,
    IconUser,
    IconCreditCard,
    IconUsers,
    IconLock,
    IconUsersGroup,
    IconWorldWww,
    IconBox,
    IconTags,
    IconShieldCog,
    IconLayoutCards,
    IconConfetti,
    IconTelescope,
    IconTerminal2,
    IconTriangleSquareCircle,
    IconLayoutList,
    IconEyeCog,
    IconHomeCog,
    IconAccessPoint,
    IconBook,
    IconLifebuoy,
    IconCode,
} from "@tabler/icons-vue";

const navigation = [
    {
        group: "Personal",
        items: [
            {
                name: "Account",
                href: route("setting.account.edit"),
                current: route().current("setting.account.edit"),
                icon: IconUser,
                show: true,
            },
        ],
    },
    {
        group: "Organization",
        items: [
            {
                name: "General",
                href: route("setting.workspace.edit"),
                current: route().current("setting.workspace.*"),
                icon: IconHomeCog,
                show: true,
            },
        ],
    },
    {
        group: "Resources",
        items: [
            {
                name: "Help Desk",
                href: "https://help.changelogfy.com/en/helpdesk",
                current: false,
                icon: IconLifebuoy,
                show: true,
                target: "_blank",
            },
            {
                name: "Developer Docs",
                href: "https://help.changelogfy.com/en/helpdesk/collections/public-api",
                current: false,
                icon: IconCode,
                show: true,
                target: "_blank",
            },
        ],
    },
];
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
                                <component
                                    preserve-state
                                    preserve-scroll
                                    prefetch
                                    :href="item.href"
                                    v-if="item.show"
                                    :is="item.target ? 'a' : Link"
                                    :target="item.target ? item.target : null"
                                    :class="[
                                        item.current
                                            ? 'bg-zinc-200 dark:bg-zinc-800 text-black dark:text-white'
                                            : 'text-zinc-900 hover:bg-zinc-200 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white',
                                        'group flex items-center gap-x-3 rounded-lg py-1 px-3 text-sm font-medium cursor-pointer',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="h-4 w-4 stroke-2"
                                        aria-hidden="true"
                                    />
                                    <div class="truncate">{{ item.name }}</div>
                                </component>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>
