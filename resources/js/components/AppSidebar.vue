<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import type { NavItem } from '@/types';
import { useTranslations } from '@/composables/useTranslations';

import { LayoutGrid, ShoppingCart, Store } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import LocalePicker from '@/components/LocalePicker.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { home, dashboard } from '@/routes';
import { index as cartIndex } from '@/routes/cart';

const { __ } = useTranslations();

const mainNavItems: NavItem[] = [
    {
        title: __('Shop'),
        href: home(),
        icon: Store,
    },
    {
        title: __('Dashboard'),
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: __('Cart'),
        href: cartIndex(),
        icon: ShoppingCart,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="home()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <div class="px-2 pb-2">
                <LocalePicker />
            </div>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
