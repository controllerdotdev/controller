<script setup>
import { IconX } from "@tabler/icons-vue";
import { computed, onMounted, onUnmounted, watch } from "vue";

const props = defineProps({
    show: {
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["close"]);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = "hidden";
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit("close");
    }
};

const closeOnEscape = (e) => {
    if (e.key === "Escape" && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
        "3xl": "sm:max-w-3xl",
        "4xl": "sm:max-w-4xl",
        "5xl": "sm:max-w-5xl",
        "6xl": "sm:max-w-6xl",
        "7xl": "sm:max-w-7xl",
    }[props.maxWidth];
});
</script>

<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div
                v-show="show"
                class="fixed inset-0 overflow-y-auto z-50"
                scroll-region
            >
                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div
                        v-show="show"
                        class="fixed inset-0 transform transition-all"
                        @click="close"
                    >
                        <div
                            class="absolute inset-0 bg-opacity-40 dark:bg-opacity-60 bg-black/50 dark:bg-black/5 backdrop-blur-sm"
                        />
                    </div>
                </transition>

                <transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div class="flex items-center justify-center h-full p-4">
                        <div
                            v-show="show"
                            class="bg-white dark:bg-zinc-900 border border-transparent dark:border-zinc-700 rounded-2xl overflow-hidden transform transition-all w-full sm:mx-auto"
                            :class="maxWidthClass"
                        >
                            <button
                                v-if="props.closeable"
                                @click="close"
                                class="absolute right-3 top-3 text-zinc-500 hover:text-zinc-600 focus:outline-none focus:ring-0"
                            >
                                <span class="sr-only">Close</span>
                                <IconX
                                    class="h-6 w-6 stroke-2"
                                    aria-hidden="true"
                                />
                            </button>
                            <slot v-if="show" />
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>
