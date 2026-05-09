<script setup lang="ts">
import { Head, Form, Link } from '@inertiajs/vue3';
import ShopNav from '@/components/ShopNav.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { home } from '@/routes';
import { show } from '@/routes/products';
import { update, remove, clear } from '@/routes/cart';
import type { CartItem } from '@/types';

const props = defineProps<{
    cartItems: CartItem[];
    total: number;
}>();

function formatPrice(price: number): string {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    }).format(price);
}
</script>

<template>
    <ShopNav />
    <Head title="Cart" />

    <div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="mb-6 text-3xl font-bold">Shopping Cart</h1>

        <div v-if="cartItems.length" class="flex flex-col gap-4">
            <div
                v-for="item in cartItems"
                :key="item.id"
                class="flex flex-col gap-4 rounded-lg border p-4 sm:flex-row sm:items-center"
            >
                <div class="flex-1">
                    <Link
                        :href="show(item.id)"
                        class="font-semibold hover:underline"
                    >
                        {{ item.name }}
                    </Link>
                    <p class="text-sm text-muted-foreground">
                        {{ formatPrice(item.price) }} each
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <Form
                        v-bind="update.form()"
                        v-slot="{ processing }"
                        class="flex items-center gap-2"
                    >
                        <input
                            type="hidden"
                            name="product_id"
                            :value="item.id"
                        />
                        <Input
                            name="quantity"
                            type="number"
                            min="1"
                            :value="item.quantity"
                            class="w-20"
                        />
                        <Button
                            type="submit"
                            variant="ghost"
                            size="sm"
                            :disabled="processing"
                        >
                            <Spinner v-if="processing" />
                            Update
                        </Button>
                    </Form>

                    <div class="w-24 text-right font-semibold">
                        {{ formatPrice(item.price * item.quantity) }}
                    </div>

                    <Form v-bind="remove.form()" v-slot="{ processing }">
                        <input
                            type="hidden"
                            name="product_id"
                            :value="item.id"
                        />
                        <Button
                            type="submit"
                            variant="ghost"
                            size="sm"
                            :disabled="processing"
                            class="text-destructive hover:text-destructive"
                        >
                            <Spinner v-if="processing" />
                            Remove
                        </Button>
                    </Form>
                </div>
            </div>

            <div class="mt-4 rounded-lg border p-4">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold">Total</span>
                    <span class="text-xl font-bold">
                        {{ formatPrice(total) }}
                    </span>
                </div>
            </div>

            <div class="mt-2 flex flex-col gap-2 sm:flex-row sm:justify-end">
                <Form v-bind="clear.form()">
                    <Button type="submit" variant="outline"
                        >Clear Cart</Button
                    >
                </Form>
                <Button as-child>
                    <Link :href="home()">Continue Shopping</Link>
                </Button>
            </div>
        </div>

        <div v-else class="py-20 text-center">
            <p class="mb-4 text-muted-foreground">Your cart is empty.</p>
            <Button as-child>
                <Link :href="home()">Start Shopping</Link>
            </Button>
        </div>
    </div>
</template>
