<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { useTranslations } from '@/composables/useTranslations';

import { LogOut, ShoppingCart, Store } from 'lucide-vue-next';
import {
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu';
import UserInfo from '@/components/UserInfo.vue';
import { logout } from '@/routes';
import { home } from '@/routes';
import { index as cartIndex } from '@/routes/cart';
import type { User } from '@/types';

const { __ } = useTranslations();

type Props = {
    user: User;
};

const handleLogout = () => {
    router.flushAll();
};

defineProps<Props>();
</script>

<template>
    <DropdownMenuLabel class="p-0 font-normal">
        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
            <UserInfo :user="user" :show-email="true" />
        </div>
    </DropdownMenuLabel>
    <DropdownMenuSeparator />
    <DropdownMenuGroup>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" :href="home()" prefetch>
                <Store class="mr-2 h-4 w-4" />
                {{ __('Shop') }}
            </Link>
        </DropdownMenuItem>
        <DropdownMenuItem :as-child="true">
            <Link class="block w-full cursor-pointer" :href="cartIndex()" prefetch>
                <ShoppingCart class="mr-2 h-4 w-4" />
                {{ __('Cart') }}
            </Link>
        </DropdownMenuItem>
    </DropdownMenuGroup>
    <DropdownMenuSeparator />
    <DropdownMenuItem :as-child="true">
        <Link
            class="block w-full cursor-pointer"
            :href="logout()"
            @click="handleLogout"
            as="button"
            data-test="logout-button"
        >
            <LogOut class="mr-2 h-4 w-4" />
            {{ __('Log out') }}
        </Link>
    </DropdownMenuItem>
</template>
