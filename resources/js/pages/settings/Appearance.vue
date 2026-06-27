<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { useTranslations } from '@/composables/useTranslations';
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import Heading from '@/components/Heading.vue';
import { edit } from '@/routes/appearance';
const { __ } = useTranslations();

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: __('Appearance settings'),
                href: edit(),
            },
        ],
    },
});
</script>

<template>
    <Head :title="__('Appearance settings')" />

    <h1 class="sr-only">{{ __('Appearance settings') }}</h1>

    <div class="space-y-6">
        <Heading
            variant="small"
            :title="__('Appearance settings')"
            :description="__('Update your account\'s appearance settings')"
        />
        <AppearanceTabs />
    </div>
</template>
