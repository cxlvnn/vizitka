<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { useTranslations } from '@/composables/useTranslations';

import { computed } from 'vue';
import { ShoppingCart, Store } from 'lucide-vue-next';
import LocalePicker from '@/components/LocalePicker.vue';
import { Button } from '@/components/ui/button';
import { home, login, register, dashboard } from '@/routes';
import { index as cartIndex } from '@/routes/cart';

const { __ } = useTranslations();

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <nav
        class="sticky top-0 z-50 border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60"
    >
        <div class="mx-auto flex h-14 max-w-7xl items-center px-4 sm:px-6">
            <Link
                :href="home()"
                class="flex items-center gap-2 text-lg font-bold tracking-tight"
            >
                <div
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-sm font-bold text-primary-foreground"
                >
                    S
                </div>
                {{ __('Shop') }}
            </Link>

            <div class="ml-auto flex items-center gap-2">
                <LocalePicker />
                <Button variant="ghost" size="sm" as-child>
                    <Link :href="home()">
                        <Store class="mr-1 h-4 w-4" />
                        {{ __('Shop') }}
                    </Link>
                </Button>

                <template v-if="user">
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="cartIndex()">
                            <ShoppingCart class="mr-1 h-4 w-4" />
                            {{ __('Cart') }}
                        </Link>
                    </Button>
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="dashboard()">{{ __('Dashboard') }}</Link>
                    </Button>
                </template>

                <template v-else>
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="login()">{{ __('Sign in') }}</Link>
                    </Button>
                    <Button size="sm" as-child>
                        <Link :href="register()">{{ __('Sign up') }}</Link>
                    </Button>
                </template>
            </div>
        </div>
    </nav>
</template>
