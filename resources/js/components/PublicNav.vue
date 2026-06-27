<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Menu, X, Phone, ChevronDown } from 'lucide-vue-next';
import LocalePicker from '@/components/LocalePicker.vue';
import { useTranslations } from '@/composables/useTranslations';
import { Button } from '@/components/ui/button';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
} from '@/components/ui/navigation-menu';
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet';
import { home, catalog, about, contact } from '@/routes';

const page = usePage();
const currentRoute = computed(() => page.url);
const categories = computed(() => (page.props.sharedCategories as Array<{
    slug: string;
    name: string;
    itemCount: number;
}>) ?? []);
const settings = computed(() => (page.props.sharedSettings as Record<string, string>) ?? {});
const { __ } = useTranslations();

function isActive(routePath: string): boolean {
    return currentRoute.value == routePath;
}

const mobileMenuOpen = ref(false);
</script>

<template>
    <header
        class="sticky top-0 z-50 border-b bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/80"
    >
        <!-- Top bar -->
        <div class="border-b bg-slate-900 text-white">
            <div
                class="mx-auto flex h-9 max-w-7xl items-center justify-between px-4 text-xs sm:px-6"
            >
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">
                        <Phone class="h-3 w-3" />
                        <a :href="'tel:' + settings.phone" class="hover:underline"
                            >{{ settings.phone || '+(99871) 253 95 40' }}</a
                        >
                    </span>
                    <span class="hidden sm:inline text-slate-400"
                        >{{ settings.email || 'info@mirumtextile.uz' }}</span
                    >
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-slate-400">{{ settings.working_hours || __('Mon\u2013Fri, 09:00\u201318:00') }}</span>
                </div>
            </div>
        </div>

        <!-- Main nav -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <Link
                    :href="home()"
                    class="flex items-center gap-2 text-lg font-bold tracking-tight text-slate-900"
                >
                <img src="/images/logo.jpeg" class="size-6" />
                    <span class="hidden sm:inline">{{ settings.brand_name || 'Mirum Textile' }}</span>
                </Link>

                <!-- Desktop navigation -->
                <NavigationMenu class="hidden lg:flex">
                    <NavigationMenuList class="gap-1">
                        <NavigationMenuItem>
                            <NavigationMenuLink as-child>
                                <Link
                                    :href="home.url()"
                                    :class="[
                                        'inline-flex h-9 items-center justify-center rounded-md px-4 text-sm font-medium transition-colors',
                                        isActive(home.url())
                                            ? 'bg-slate-100 text-slate-900'
                                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900',
                                    ]"
                                >
                                    {{ __('Home') }}
                                </Link>
                            </NavigationMenuLink>
                        </NavigationMenuItem>

                        <NavigationMenuItem>
                            <NavigationMenuTrigger
                                :class="[
                                    'h-9 px-4 text-sm font-medium',
                                    isActive(catalog.url())
                                        ? 'bg-slate-100 text-slate-900'
                                        : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900',
                                ]"
                            >
                                {{ __('Products') }}
                            </NavigationMenuTrigger>
                            <NavigationMenuContent>
                                <div
                                    class="grid w-125 gap-3 p-4 md:w-150 md:grid-cols-2"
                                >
                                    <Link
                                        v-for="cat in categories"
                                        :key="cat.slug"
                                        :href="catalog.url() + '?category=' + cat.slug"
                                        class="group flex flex-col gap-1 rounded-md p-3 hover:bg-slate-50"
                                    >
                                        <div
                                            class="text-sm font-semibold text-slate-900 group-hover:text-blue-700"
                                        >
                                            {{ cat.name }}
                                        </div>
                                        <div class="text-xs text-slate-500">
                                            {{ cat.itemCount }} {{ __('items') }}
                                        </div>
                                    </Link>
                                </div>
                            </NavigationMenuContent>
                        </NavigationMenuItem>

                        <NavigationMenuItem>
                            <NavigationMenuLink as-child>
                                <Link
                                    :href="about.url()"
                                    :class="[
                                        'inline-flex h-9 items-center justify-center rounded-md px-4 text-sm font-medium transition-colors',
                                        isActive(about.url())
                                            ? 'bg-slate-100 text-slate-900'
                                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900',
                                    ]"
                                >
                                    {{ __('About Us') }}
                                </Link>
                            </NavigationMenuLink>
                        </NavigationMenuItem>

                        <NavigationMenuItem>
                            <NavigationMenuLink as-child>
                                <Link
                                    :href="contact.url()"
                                    :class="[
                                        'inline-flex h-9 items-center justify-center rounded-md px-4 text-sm font-medium transition-colors',
                                        isActive(contact.url())
                                            ? 'bg-slate-100 text-slate-900'
                                            : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900',
                                    ]"
                                >
                                    {{ __('Contacts') }}
                                </Link>
                            </NavigationMenuLink>
                        </NavigationMenuItem>
                    </NavigationMenuList>
                </NavigationMenu>

                <!-- Right side CTA -->
                <div class="hidden items-center gap-2 lg:flex">
                    <LocalePicker />
                    <Button
                        size="sm"
                        class="bg-blue-700 hover:bg-blue-800"
                        as-child
                    >
                        <Link :href="contact.url()">{{ __('Request a Quote') }}</Link>
                    </Button>
                </div>

                <!-- Mobile menu button -->
                <Sheet v-model:open="mobileMenuOpen">
                    <SheetTrigger as-child class="lg:hidden">
                        <Button variant="ghost" size="icon">
                            <Menu class="h-5 w-5" />
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="right" class="w-80">
                        <SheetHeader>
                            <SheetTitle>{{ __('Menu') }}</SheetTitle>
                        </SheetHeader>
                        <div class="mt-6 flex flex-col gap-2">
                            <Link
                                :href="home.url()"
                                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-slate-100"
                                @click="mobileMenuOpen = false"
                            >
                                {{ __('Home') }}
                            </Link>

                            <div class="px-3 py-2 text-sm font-semibold text-slate-500">
                                {{ __('Products') }}
                            </div>
                            <Link
                                v-for="cat in categories"
                                :key="cat.slug"
                                :href="catalog.url() + '?category=' + cat.slug"
                                class="flex items-center gap-2 rounded-md px-6 py-2 text-sm text-slate-600 hover:bg-slate-100"
                                @click="mobileMenuOpen = false"
                            >
                                {{ cat.name }}
                            </Link>

                            <Link
                                :href="about.url()"
                                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-slate-100"
                                @click="mobileMenuOpen = false"
                            >
                                {{ __('About Us') }}
                            </Link>
                            <Link
                                :href="contact.url()"
                                class="flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium hover:bg-slate-100"
                                @click="mobileMenuOpen = false"
                            >
                                {{ __('Contacts') }}
                            </Link>

                            <div class="mt-4 border-t pt-4 px-3 flex flex-col gap-2">
                                <LocalePicker />
                                <Button class="w-full bg-blue-700 hover:bg-blue-800" as-child>
                                    <Link :href="contact.url()" @click="mobileMenuOpen = false"
                                        >{{ __('Request a Quote') }}</Link
                                    >
                                </Button>
                            </div>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>
        </div>
    </header>
</template>
