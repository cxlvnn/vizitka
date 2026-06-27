<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { index as cartIndex } from '@/routes/cart';
import { useTranslations } from '@/composables/useTranslations';

import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { home } from '@/routes';

const { __ } = useTranslations();

defineOptions({
    layout: {
        breadcrumbs: [{ title: __('Dashboard'), href: '#' }],
    },
});
</script>

<template>
    <Head :title="__('Dashboard')" />

    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold">{{ __('Dashboard') }}</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <Card>
                <CardHeader class="pb-2">
                    <CardTitle class="text-sm font-medium">{{ __('Shop') }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="mb-4 text-sm text-muted-foreground">
                        {{ __('Browse our collection of products.') }}
                    </p>
                    <Button as-child size="sm">
                        <Link :href="home()">{{ __('Browse Products') }}</Link>
                    </Button>
                </CardContent>
            </Card>

            <Card>
                <CardHeader class="pb-2">
                    <CardTitle class="text-sm font-medium">{{ __('Cart') }}</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="mb-4 text-sm text-muted-foreground">
                        {{ __('View and manage your shopping cart.') }}
                    </p>
                    <Button as-child size="sm" variant="secondary">
                        <Link :href="cartIndex()">{{ __('Open Cart') }}</Link>
                    </Button>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
