<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import { Check, Factory } from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { home, catalog } from '@/routes';

defineOptions({ layout: PublicLayout });

const props = defineProps<{
    categories: Array<{
        slug: string;
        name: string;
        description: string;
        itemCount: number;
    }>;
    products: Array<{
        id: number;
        slug: string;
        name: string;
        sku: string;
        category: string;
        description: string;
        image?: string;
        moq: string;
        leadTime: string;
        customization: boolean;
        isNew: boolean;
        discount?: number;
        specs: Array<{ label: string; value: string }>;
    }>;
    currentCategory?: {
        slug: string;
        name: string;
        description: string;
    };
}>();

const selectedCategory = computed(() => props.currentCategory?.slug ?? null);

const filteredProducts = computed(() => {
    return props.products;
});

const activeCategory = computed(() => {
    return props.currentCategory ?? null;
});

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
    <Head
        :title="
            activeCategory
                ? `${activeCategory.name} — опт от производителя | Mirum Textile`
                : 'Продукция — опт от производителя | Mirum Textile'
        "
    />

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 flex items-center gap-2 text-sm text-slate-500">
            <Link :href="home()" class="hover:text-slate-900 hover:underline">
                Главная
            </Link>
            <span>/</span>
            <span v-if="activeCategory" class="flex items-center gap-2">
                <Link
                    :href="catalog()"
                    class="hover:text-slate-900 hover:underline"
                >
                    Продукция
                </Link>
                <span>/</span>
                <span class="text-slate-900">{{ activeCategory.name }}</span>
            </span>
            <span v-else class="text-slate-900">Продукция</span>
        </nav>

        <!-- Page title -->
        <h1 class="mb-2 text-3xl font-bold text-slate-900">
            {{ activeCategory ? activeCategory.name : 'Вся продукция' }}
        </h1>
        <p v-if="activeCategory" class="mb-8 text-slate-600">
            {{ activeCategory.description }}
        </p>
        <p v-else class="mb-8 text-slate-600">
            Каталог текстильных аксессуаров и готовых изделий от производителя.
        </p>

        <div class="flex flex-col gap-8 lg:flex-row">
            <!-- Sidebar filters -->
            <aside class="w-full shrink-0 lg:w-64">
                <div class="sticky top-24 space-y-6">
                    <div>
                        <h3 class="mb-3 text-sm font-semibold text-slate-900">
                            Категории
                        </h3>
                        <div class="space-y-1">
                            <Link
                                :href="catalog()"
                                :class="[
                                    'flex items-center justify-between rounded-md px-3 py-2 text-sm transition-colors',
                                    !selectedCategory
                                        ? 'bg-blue-50 font-medium text-blue-700'
                                        : 'text-slate-600 hover:bg-slate-50',
                                ]"
                            >
                                Все категории
                                <span class="text-xs text-slate-400">{{
                                    products.length
                                }}</span>
                            </Link>
                            <Link
                                v-for="cat in categories"
                                :key="cat.slug"
                                :href="catalog.url() + '?category=' + cat.slug"
                                :class="[
                                    'flex items-center justify-between rounded-md px-3 py-2 text-sm transition-colors',
                                    selectedCategory === cat.slug
                                        ? 'bg-blue-50 font-medium text-blue-700'
                                        : 'text-slate-600 hover:bg-slate-50',
                                ]"
                            >
                                {{ cat.name }}
                                <span class="text-xs text-slate-400">{{
                                    cat.itemCount
                                }}</span>
                            </Link>
                        </div>
                    </div>

                    <Separator />
                </div>
            </aside>

            <!-- Products grid -->
            <div class="flex-1">
                <div class="mb-4 flex items-center justify-between">
                    <p class="text-sm text-slate-500">
                        {{ filteredProducts.length }} товаров
                    </p>
                    <Select default-value="newest">
                        <SelectTrigger class="w-[180px]">
                            <SelectValue placeholder="Сортировка" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="newest">Сначала новые</SelectItem>
                            <SelectItem value="name-asc">Название А–Я</SelectItem>
                            <SelectItem value="name-desc">Название Я–А</SelectItem>
                        </SelectContent>
                    </Select>
                </div>

                <div
                    v-if="filteredProducts.length"
                    class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3"
                >
                    <Link
                        v-for="product in filteredProducts"
                        :key="product.id"
                        :href="`/products/${product.slug}`"
                        class="group block"
                    >
                        <Card
                            class="h-full overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div
                                class="relative flex aspect-[3/2] items-center justify-center bg-slate-100"
                            >
                                <div
                                    v-if="product.image"
                                    class="flex h-full w-full items-center justify-center"
                                >
                                    <img
                                        :src="product.image"
                                        :alt="product.name"
                                        class="h-full w-full object-cover"
                                    />
                                </div>
                                <div
                                    v-else
                                    class="flex h-20 w-20 items-center justify-center rounded-full bg-blue-100 text-2xl font-bold text-blue-600"
                                >
                                    {{ getInitials(product.name) }}
                                </div>
                                <Badge
                                    v-if="product.isNew"
                                    class="absolute left-2 top-2 bg-emerald-600 text-white"
                                >
                                    Новинка
                                </Badge>
                                <div
                                    v-if="product.discount"
                                    class="absolute right-2 top-2 flex h-12 w-12 items-center justify-center rounded-full bg-orange-600 text-xs font-bold text-white"
                                >
                                    -{{ product.discount }}%
                                </div>
                            </div>
                            <CardHeader class="p-4 pb-0">
                                <div class="flex items-center gap-2">
                                    <Badge variant="secondary" class="text-xs">
                                        {{ product.category }}
                                    </Badge>
                                </div>
                                <CardTitle class="mt-2 text-base">
                                    {{ product.name }}
                                </CardTitle>
                            </CardHeader>
                            <CardContent class="p-4 pt-2">
                                <p class="text-xs text-slate-500">
                                    Артикул: {{ product.sku }}
                                </p>
                                <div
                                    class="mt-3 flex items-center gap-2 text-xs text-slate-500"
                                >
                                    <span
                                        v-if="product.customization"
                                        class="flex items-center gap-1"
                                    >
                                        <Check
                                            class="h-3 w-3 text-emerald-600"
                                        />
                                        Кастомизация
                                    </span>
                                    <span>MOQ: {{ product.moq }}</span>
                                </div>
                                <p
                                    class="mt-3 text-sm font-medium text-blue-700 group-hover:underline"
                                >
                                    Подробнее →
                                </p>
                            </CardContent>
                        </Card>
                    </Link>
                </div>

                <div
                    v-else
                    class="flex flex-col items-center justify-center py-20 text-slate-500"
                >
                    <Factory class="mb-4 h-16 w-16 text-slate-300" />
                    <p class="text-lg font-medium">В этой категории пока нет товаров</p>
                    <p class="text-sm">
                        Уточняйте наличие у менеджеров или посмотрите другие категории
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
