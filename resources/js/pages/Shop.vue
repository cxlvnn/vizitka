<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import type { PaginatedProducts, Product, Category } from '@/types';
import { useTranslations } from '@/composables/useTranslations';

import ShopNav from '@/components/ShopNav.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { home } from '@/routes';
import { show } from '@/routes/products';

const { __ } = useTranslations();

const props = defineProps<{
    products: PaginatedProducts;
    categories: Category[];
    currentCategory: string | null;
}>();

function formatPrice(price: number): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    }).format(price);
}

function getInitials(name: string): string {
    return name
        .split(' ')
        .map((word) => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}
</script>

<template>
    <ShopNav />
    <Head :title="__('Shop')" />

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Hero -->
        <div
            class="mb-10 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 p-8 text-white sm:p-12 dark:from-slate-800 dark:to-slate-700"
        >
            <h1 class="mb-2 text-3xl font-bold sm:text-4xl">{{ __('Welcome to Shop') }}</h1>
            <p class="text-slate-300">
                {{ __('Discover great products at amazing prices.') }}
            </p>
        </div>

        <!-- Filters -->
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center">
            <Select
                :model-value="currentCategory || 'all'"
                @update:model-value="
                    (val) =>
                        $inertia.get(
                            home(),
                            { category: val === 'all' ? undefined : val },
                            { preserveState: true },
                        )
                "
            >
                <SelectTrigger class="w-full sm:w-[220px]">
                    <SelectValue :placeholder="__('All categories')" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="all">{{ __('All categories') }}</SelectItem>
                    <SelectItem
                        v-for="cat in categories"
                        :key="cat"
                        :value="cat"
                    >
                        {{ cat }}
                    </SelectItem>
                </SelectContent>
            </Select>

            <div class="text-sm text-muted-foreground">
                {{ products.total }} {{ __('products found') }}
            </div>
        </div>

        <!-- Products grid -->
        <div
            v-if="products.data.length"
            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
        >
            <Link
                v-for="product in products.data"
                :key="product.id"
                :href="show(product.id)"
                class="group block"
            >
                <Card
                    class="h-full overflow-hidden transition-shadow hover:shadow-lg"
                >
                    <div
                        class="flex aspect-square items-center justify-center bg-muted"
                    >
                        <img
                            v-if="product.image"
                            :src="product.image"
                            :alt="product.name"
                            class="h-full w-full object-cover"
                        />
                        <div
                            v-else
                            class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 text-2xl font-bold text-primary"
                        >
                            {{ getInitials(product.name) }}
                        </div>
                    </div>
                    <CardHeader class="p-4 pb-0">
                        <div class="flex items-start justify-between gap-2">
                            <CardTitle
                                class="line-clamp-1 text-base font-semibold"
                            >
                                {{ product.name }}
                            </CardTitle>
                        </div>
                        <CardDescription
                            class="line-clamp-2 text-sm"
                            v-if="product.description"
                        >
                            {{ product.description }}
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="p-4 pt-2">
                        <div
                            class="flex items-center justify-between gap-2"
                        >
                            <span
                                class="text-lg font-bold text-primary"
                                >{{ formatPrice(product.price) }}</span
                            >
                            <Badge v-if="product.category" variant="secondary">
                                {{ product.category }}
                            </Badge>
                        </div>
                    </CardContent>
                </Card>
            </Link>
        </div>

        <div v-else class="py-20 text-center text-muted-foreground">
            {{ __('No products found.') }}
        </div>

        <!-- Pagination -->
        <div
            v-if="products.last_page > 1"
            class="mt-8 flex items-center justify-center gap-2"
        >
            <Link
                v-for="link in products.links"
                :key="link.label"
                :href="link.url || '#'"
                preserve-state
                class="inline-flex h-9 min-w-9 items-center justify-center rounded-md border px-3 text-sm font-medium transition-colors"
                :class="{
                    'bg-primary text-primary-foreground border-primary': link.active,
                    'text-muted-foreground opacity-50 pointer-events-none': !link.url,
                    'hover:bg-accent hover:text-accent-foreground': !link.active && link.url,
                }"
                v-html="link.label"
            />
        </div>
    </div>
</template>
