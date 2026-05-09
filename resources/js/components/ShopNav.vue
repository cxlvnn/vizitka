<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { ShoppingCart, Store } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { home, login, register, dashboard } from '@/routes';
import { index as cartIndex } from '@/routes/cart';

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
                Shop
            </Link>

            <div class="ml-auto flex items-center gap-2">
                <Button variant="ghost" size="sm" as-child>
                    <Link :href="home()">
                        <Store class="mr-1 h-4 w-4" />
                        Shop
                    </Link>
                </Button>

                <template v-if="user">
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="cartIndex()">
                            <ShoppingCart class="mr-1 h-4 w-4" />
                            Cart
                        </Link>
                    </Button>
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="dashboard()">Dashboard</Link>
                    </Button>
                </template>

                <template v-else>
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="login()">Sign in</Link>
                    </Button>
                    <Button size="sm" as-child>
                        <Link :href="register()">Sign up</Link>
                    </Button>
                </template>
            </div>
        </div>
    </nav>
</template>
