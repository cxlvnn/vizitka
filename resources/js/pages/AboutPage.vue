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
    Factory,
    Users,
    Award,
    Globe,
    ArrowRight,
    Check,
} from 'lucide-vue-next';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { contact, catalog } from '@/routes';

defineOptions({ layout: PublicLayout });

const stats = [
    { value: '25+', label: 'Лет на рынке', icon: Factory },
    { value: '5+', label: 'Категорий продукции', icon: Award },
    { value: '15+', label: 'Подкатегорий', icon: Globe },
    { value: '3', label: 'Страны экспорта', icon: Users },
];

const capabilities = [
    'Плосковязаные воротники и манжеты',
    'Жаккардовые ленты с логотипом',
    'Кругловязаные шнуры (включая 6-ти игольные)',
    'Готовые трикотажные изделия и шарфы',
    'Фасонная пряжа для ручного и машинного вязания',
    'Корпоративная и сувенирная продукция',
];
</script>

<template>
    <Head title="О компании — Mirum Textile" />

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-12 text-center">
            <Badge variant="outline" class="mb-4 border-blue-400 text-blue-600">
                О компании
            </Badge>
            <h1 class="mb-4 text-4xl font-bold text-slate-900">
                Mirum Textile
            </h1>
            <p class="mx-auto max-w-2xl text-lg text-slate-600">
                Производитель текстильных аксессуаров и готовых трикотажных
                изделий с 2001 года
            </p>
        </div>

        <!-- Stats -->
        <div class="mb-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <Card
                v-for="stat in stats"
                :key="stat.label"
                class="text-center"
            >
                <CardContent class="py-6">
                    <component
                        :is="stat.icon"
                        class="mx-auto mb-3 h-8 w-8 text-blue-600"
                    />
                    <div class="text-3xl font-bold text-slate-900">
                        {{ stat.value }}
                    </div>
                    <div class="text-sm text-slate-500">{{ stat.label }}</div>
                </CardContent>
            </Card>
        </div>

        <!-- Story -->
        <div class="mb-16 grid items-center gap-12 lg:grid-cols-2">
            <div
                class="flex aspect-video items-center justify-center rounded-xl bg-slate-100"
            >
                <Factory class="h-24 w-24 text-slate-300" />
            </div>
            <div>
                <h2 class="mb-4 text-2xl font-bold text-slate-900">
                    Наша история
                </h2>
                <p class="mb-4 text-slate-600">
                    Компания Mirum Textile была основана в 2001 году в Ташкенте
                    как небольшая швейная мастерская. За более чем два десятилетия
                    мы выросли до полноценного производства с современным
                    оборудованием и командой опытных специалистов.
                </p>
                <p class="mb-4 text-slate-600">
                    Сегодня мы обеспечиваем текстильными аксессуарами фабрики,
                    fashion-бренды и корпоративных клиентов по всему
                    Узбекистану и за его пределами.
                </p>
                <p class="text-slate-600">
                    Наше производство оснащено станками для плосковязания,
                    жаккардового плетения и кругловязания. Мы постоянно
                    расширяем парк оборудования и повышаем квалификацию
                    сотрудников.
                </p>
            </div>
        </div>

        <!-- Capabilities -->
        <div class="mb-16">
            <h2 class="mb-8 text-center text-2xl font-bold text-slate-900">
                Производственные возможности
            </h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="cap in capabilities"
                    :key="cap"
                    class="flex items-start gap-3 rounded-lg border bg-white p-4"
                >
                    <Check class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" />
                    <span class="text-slate-700">{{ cap }}</span>
                </div>
            </div>
        </div>

        <!-- Clients -->
        <div class="mb-16">
            <h2 class="mb-8 text-center text-2xl font-bold text-slate-900">
                Наши клиенты
            </h2>
            <div
                class="flex flex-wrap items-center justify-center gap-8 opacity-50 grayscale"
            >
                <div
                    v-for="i in 6"
                    :key="i"
                    class="flex h-16 w-32 items-center justify-center rounded-md bg-slate-100 text-sm font-medium text-slate-400"
                >
                    Клиент {{ i }}
                </div>
            </div>
            <p class="mt-4 text-center text-sm text-slate-400">
                Логотипы клиентов будут размещены после получения разрешения
            </p>
        </div>

        <!-- CTA -->
        <div class="rounded-2xl bg-slate-900 p-8 text-center text-white sm:p-12">
            <h2 class="mb-4 text-2xl font-bold">
                Хотите стать нашим партнером?
            </h2>
            <p class="mb-6 text-slate-300">
                Свяжитесь с нами — мы подготовим коммерческое предложение и
                образцы продукции.
            </p>
            <div class="flex flex-wrap justify-center gap-3">
                <Button class="bg-blue-600 hover:bg-blue-700" size="lg" as-child>
                    <Link :href="contact()">
                        Запросить КП
                        <ArrowRight class="ml-2 h-4 w-4" />
                    </Link>
                </Button>
                <Button
                    variant="outline"
                    class="border-white text-white hover:bg-white hover:text-slate-900"
                    size="lg"
                    as-child
                >
                    <Link :href="catalog()">Смотреть продукцию</Link>
                </Button>
            </div>
        </div>
    </div>
</template>
