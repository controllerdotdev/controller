<script setup>
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Dropdown from "@/Components/Dropdown.vue";
import InputHelp from "@/Components/InputHelp.vue";
import Banner from "@/Components/Banner.vue";
import FormSection from "@/Components/FormSection.vue";

import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

import { useDarkTheme } from "@/theme";
const { isDarkTheme } = useDarkTheme();

const user = usePage().props.auth.user;

const { platforms } = defineProps({
    platforms: Object,
});
console.log(platforms);

const form = useForm({
    name: "",
    platform: "",
});

const submit = () => {
    form.post(route("projects.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Project" />
    <Banner />

    <div
        class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 bg-white dark:bg-zinc-800"
    >
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="flex justify-center mb-8">
                <img
                    src="/images/lua/full-color.svg"
                    class="h-16 hidden dark:block"
                />
                <img
                    src="/images/lua/full-black.svg"
                    class="h-16 block dark:hidden"
                />
            </div>
            <div class="text-center">
                <h1 class="page-title">New project</h1>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    Project is a place where you can organize your issues
                </p>
            </div>

            <FormSection @submitted="submit">
                <template #form>
                    <div class="col-span-6">
                        <Label for="name" value="Name" :required="true" />

                        <Input
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            placeholder="Enter the project name"
                            class="mt-1"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="col-span-6">
                        <Dropdown
                            id="platform"
                            :search="true"
                            :options="
                                platforms.map((platform) => ({
                                    id: platform.id,
                                    label: platform.name,
                                }))
                            "
                            class="w-full"
                            v-model="form.platform"
                        />

                        <InputError
                            :message="form.errors.platform"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #actions>
                    <div class="flex flex-1 flex-col justify-center">
                        <Button
                            type="submit"
                            :class="{
                                'w-full btn-primary': true,
                                'opacity-25': form.processing,
                            }"
                            :disabled="form.processing"
                        >
                            <span>
                                {{
                                    form.processing ? "Creating..." : "Continue"
                                }}
                            </span>
                        </Button>
                    </div>
                </template>
            </FormSection>
        </div>
    </div>
</template>
