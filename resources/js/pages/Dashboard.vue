<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { home } from '@/routes';
import { index as cartIndex } from '@/routes/cart';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: '#' }],
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold">Dashboard</h1>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <Card>
                <CardHeader class="pb-2">
                    <CardTitle class="text-sm font-medium">Shop</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="mb-4 text-sm text-muted-foreground">
                        Browse our collection of products.
                    </p>
                    <Button as-child size="sm">
                        <Link :href="home()">Browse Products</Link>
                    </Button>
                </CardContent>
            </Card>

            <Card>
                <CardHeader class="pb-2">
                    <CardTitle class="text-sm font-medium">Cart</CardTitle>
                </CardHeader>
                <CardContent>
                    <p class="mb-4 text-sm text-muted-foreground">
                        View and manage your shopping cart.
                    </p>
                    <Button as-child size="sm" variant="secondary">
                        <Link :href="cartIndex()">Open Cart</Link>
                    </Button>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
