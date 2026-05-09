<script setup lang="ts">
import { Head, Form, Link } from '@inertiajs/vue3';
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
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { home } from '@/routes';
import { add } from '@/routes/cart';
import type { Product } from '@/types';

const props = defineProps<{
    product: Product;
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
    <Head :title="product.name" />

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-muted-foreground">
            <Link :href="home()" class="underline hover:text-foreground">
                Shop
            </Link>
            <span class="mx-2">/</span>
            <span class="text-foreground">{{ product.name }}</span>
        </div>

        <div class="grid gap-8 md:grid-cols-2">
            <!-- Image -->
            <div
                class="flex aspect-square items-center justify-center rounded-xl bg-muted"
            >
                <img
                    v-if="product.image"
                    :src="product.image"
                    :alt="product.name"
                    class="h-full w-full rounded-xl object-cover"
                />
                <div
                    v-else
                    class="flex h-32 w-32 items-center justify-center rounded-full bg-primary/10 text-5xl font-bold text-primary"
                >
                    {{ getInitials(product.name) }}
                </div>
            </div>

            <!-- Info -->
            <div class="flex flex-col gap-4">
                <div>
                    <Badge v-if="product.category" variant="secondary" class="mb-2">
                        {{ product.category }}
                    </Badge>
                    <h1 class="text-3xl font-bold">{{ product.name }}</h1>
                    <p
                        v-if="product.description"
                        class="mt-2 text-muted-foreground"
                    >
                        {{ product.description }}
                    </p>
                </div>

                <div class="text-3xl font-bold text-primary">
                    {{ formatPrice(product.price) }}
                </div>

                <Form
                    v-bind="add.form()"
                    v-slot="{ errors, processing }"
                    class="mt-4 flex flex-col gap-4"
                >
                    <input
                        type="hidden"
                        name="product_id"
                        :value="product.id"
                    />
                    <div class="grid gap-2">
                        <Label for="quantity">Quantity</Label>
                        <Input
                            id="quantity"
                            name="quantity"
                            type="number"
                            min="1"
                            value="1"
                            required
                            class="w-24"
                        />
                    </div>

                    <Button type="submit" :disabled="processing" class="w-full">
                        <Spinner v-if="processing" />
                        Add to Cart
                    </Button>
                </Form>

                <Button variant="outline" class="w-full" as-child>
                    <Link :href="home()">Continue Shopping</Link>
                </Button>
            </div>
        </div>
    </div>
</template>
