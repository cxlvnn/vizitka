<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    Card,
    CardContent,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Check,
    ArrowRight,
    Factory,
    Palette,
    Clock,
    DollarSign,
    Package,
} from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { catalog, contact, home } from '@/routes';

defineOptions({ layout: PublicLayout });

const props = defineProps<{
    categories: Array<{
        slug: string;
        name: string;
        description: string;
        itemCount: number;
    }>;
    newProducts: Array<{
        id: number;
        slug: string;
        name: string;
        sku: string;
        image?: string;
        isNew: boolean;
    }>;
    discountProducts: Array<{
        id: number;
        slug: string;
        name: string;
        sku: string;
        image?: string;
        discount?: number;
    }>;
    settings: Record<string, string>;
}>();

function getInitials(name: string): string {
    return name
        .split(' ')
        .map((word) => word[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}

function discountBadge(product: { discount?: number }): string {
    return product.discount ? `-${product.discount}%` : '';
}
</script>

<template>
    <Head title="Mirum Textile — Текстильные аксессуары от производителя" />

    <!-- Hero -->
    <section class="relative bg-slate-900 text-white">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:py-28">
            <div class="max-w-2xl">
                <Badge
                    variant="outline"
                    class="mb-4 border-blue-400 text-blue-300"
                >
                    Производитель с 2001 года
                </Badge>
                <h1 class="mb-4 text-4xl font-bold leading-tight sm:text-5xl">
                    Текстильные аксессуары от производителя с 2001 года
                </h1>
                <p class="mb-8 text-lg text-slate-300">
                    Производство плосковязаных воротников и манжетов, шнуров,
                    лент, готовых трикотажных изделий и шарфов. Качество,
                    которому доверяют с 2001 года.
                </p>
                <div class="flex flex-wrap gap-3">
                    <Button size="lg" class="bg-blue-600 hover:bg-blue-700" as-child>
                        <Link :href="catalog()">
                            Смотреть продукцию
                            <ArrowRight class="ml-2 h-4 w-4" />
                        </Link>
                    </Button>
                    <Button
                        size="lg"
                        variant="outline"
                        class="border-white bg-transparent text-white hover:bg-white hover:text-slate-900"
                        as-child
                    >
                        <Link :href="contact()">Запросить КП</Link>
                    </Button>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages -->
    <section class="border-b bg-white py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                    >
                        <Check class="h-5 w-5 text-blue-600" />
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900">
                            Качество изделий
                        </div>
                        <div class="text-sm text-slate-500">
                            Контроль на всех этапах
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                    >
                        <Package class="h-5 w-5 text-blue-600" />
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900">
                            Богатый ассортимент
                        </div>
                        <div class="text-sm text-slate-500">
                            5+ категорий, 100+ позиций
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                    >
                        <Palette class="h-5 w-5 text-blue-600" />
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900">
                            Любой проект под заказ
                        </div>
                        <div class="text-sm text-slate-500">
                            Логотип, цвета, размеры
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                    >
                        <Clock class="h-5 w-5 text-blue-600" />
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900">
                            Честные сроки
                        </div>
                        <div class="text-sm text-slate-500">
                            Выполняем в срок
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50"
                    >
                        <DollarSign class="h-5 w-5 text-blue-600" />
                    </div>
                    <div>
                        <div class="font-semibold text-slate-900">
                            Разумные цены
                        </div>
                        <div class="text-sm text-slate-500">
                            Опт от производителя
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="bg-slate-50 py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <h2 class="mb-10 text-center text-3xl font-bold text-slate-900">
                Наша продукция
            </h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                <Link
                    v-for="cat in categories"
                    :key="cat.slug"
                    :href="catalog.url() + '?category=' + cat.slug"
                    class="group block"
                >
                    <Card
                        class="h-full overflow-hidden transition-all hover:-translate-y-1 hover:shadow-lg"
                    >
                        <div
                            class="flex h-32 items-center justify-center bg-blue-50"
                        >
                            <Factory
                                class="h-12 w-12 text-blue-300 transition-colors group-hover:text-blue-500"
                            />
                        </div>
                        <CardHeader class="p-4 pb-2">
                            <CardTitle class="text-base">{{ cat.name }}</CardTitle>
                        </CardHeader>
                        <CardContent class="p-4 pt-0">
                            <p class="text-sm text-slate-500">
                                {{ cat.itemCount }} позиций
                            </p>
                            <p
                                class="mt-2 text-sm font-medium text-blue-700 group-hover:underline"
                            >
                                Перейти →
                            </p>
                        </CardContent>
                    </Card>
                </Link>
            </div>
        </div>
    </section>

    <!-- New Products -->
    <section class="bg-white py-16" v-if="newProducts.length">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-slate-900">Новая продукция</h2>
                <Link
                    :href="catalog()"
                    class="text-sm font-medium text-blue-700 hover:underline"
                >
                    Вся продукция →
                </Link>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <Link
                    v-for="product in newProducts"
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
                        </div>
                        <CardHeader class="p-4 pb-0">
                            <CardTitle class="text-base">{{ product.name }}</CardTitle>
                        </CardHeader>
                        <CardContent class="p-4 pt-2">
                            <p class="text-xs text-slate-500">
                                Артикул: {{ product.sku }}
                            </p>
                            <p
                                class="mt-2 text-sm font-medium text-blue-700 group-hover:underline"
                            >
                                Подробнее →
                            </p>
                        </CardContent>
                    </Card>
                </Link>
            </div>
        </div>
    </section>

    <!-- Discounts -->
    <section class="bg-slate-50 py-16" v-if="discountProducts.length">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="mb-10 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-slate-900">Скидки</h2>
                <Link
                    :href="catalog()"
                    class="text-sm font-medium text-blue-700 hover:underline"
                >
                    Все товары со скидкой →
                </Link>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <Link
                    v-for="product in discountProducts"
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
                            <div
                                class="absolute right-2 top-2 flex h-12 w-12 items-center justify-center rounded-full bg-orange-600 text-xs font-bold text-white"
                            >
                                -{{ product.discount }}%
                            </div>
                        </div>
                        <CardHeader class="p-4 pb-0">
                            <CardTitle class="text-base">{{ product.name }}</CardTitle>
                        </CardHeader>
                        <CardContent class="p-4 pt-2">
                            <p class="text-xs text-slate-500">
                                Артикул: {{ product.sku }}
                            </p>
                            <p
                                class="mt-2 text-sm font-medium text-blue-700 group-hover:underline"
                            >
                                Подробнее →
                            </p>
                        </CardContent>
                    </Card>
                </Link>
            </div>
        </div>
    </section>

    <!-- About teaser -->
    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div
                    class="flex aspect-video items-center justify-center rounded-xl bg-slate-100"
                >
                    <Factory class="h-24 w-24 text-slate-300" />
                </div>
                <div>
                    <h2 class="mb-4 text-3xl font-bold text-slate-900">
                        О компании
                    </h2>
                    <p class="mb-4 text-slate-600">
                        Mirum Textile — производитель текстильных аксессуаров и
                        готовых трикотажных изделий. С 2001 года мы
                        обеспечиваем фабрики и бренды качественной продукцией
                        для швейной и обувной промышленности.
                    </p>
                    <p class="mb-6 text-slate-600">
                        Наше производство оснащено современным оборудованием,
                        позволяющим изготавливать изделия любой сложности — от
                        стандартных воротников до уникальных жаккардовых лент с
                        логотипом.
                    </p>
                    <Button class="bg-blue-700 hover:bg-blue-800" as-child>
                        <Link :href="'/about'">Узнать больше о компании</Link>
                    </Button>
                </div>
            </div>
        </div>
    </section>
</template>
