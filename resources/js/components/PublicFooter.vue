<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Phone, Mail, MapPin } from 'lucide-vue-next';
import { home, catalog, about, contact } from '@/routes';

const page = usePage();
const categories = computed(() => (page.props.sharedCategories as Array<{
    slug: string;
    name: string;
    itemCount: number;
}>) ?? []);
const settings = computed(() => (page.props.sharedSettings as Record<string, string>) ?? {});
</script>

<template>
    <footer class="border-t bg-slate-900 text-slate-300">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- Brand -->
                <div>
                    <div class="mb-4 flex items-center gap-2 text-lg font-bold text-white">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-700 text-sm font-bold text-white"
                        >
                            M
                        </div>
                        {{ settings.brand_name || 'Mirum Textile' }}
                    </div>
                    <p class="text-sm text-slate-400">
                        Производитель текстильных аксессуаров с 2001 года. Воротники,
                        ленты, шнуры, трикотаж — опт от производителя.
                    </p>
                </div>

                <!-- Products -->
                <div>
                    <h4 class="mb-4 text-sm font-semibold text-white">Продукция</h4>
                    <ul class="space-y-2">
                        <li v-for="cat in categories.slice(0, 5)" :key="cat.slug">
                            <Link
                                :href="catalog() + '?category=' + cat.slug"
                                class="text-sm text-slate-400 hover:text-white"
                            >
                                {{ cat.name }}
                            </Link>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="mb-4 text-sm font-semibold text-white">Компания</h4>
                    <ul class="space-y-2">
                        <li>
                            <Link :href="about()" class="text-sm text-slate-400 hover:text-white"
                                >О компании</Link
                            >
                        </li>
                        <li>
                            <Link
                                :href="contact()"
                                class="text-sm text-slate-400 hover:text-white"
                                >Контакты</Link
                            >
                        </li>
                        <li>
                            <span class="text-sm text-slate-400">Сертификаты</span>
                        </li>
                        <li>
                            <span class="text-sm text-slate-400">Вакансии</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="mb-4 text-sm font-semibold text-white">Контакты</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-sm">
                            <Phone class="h-4 w-4 text-blue-400" />
                            <a :href="'tel:' + settings.phone" class="hover:text-white"
                                >{{ settings.phone || '+(99871) 253 95 40' }}</a
                            >
                        </li>
                        <li class="flex items-center gap-2 text-sm">
                            <Mail class="h-4 w-4 text-blue-400" />
                            <a :href="'mailto:' + settings.email" class="hover:text-white"
                                >{{ settings.email || 'info@mirumtextile.uz' }}</a
                            >
                        </li>
                        <li class="flex items-start gap-2 text-sm">
                            <MapPin class="mt-0.5 h-4 w-4 shrink-0 text-blue-400" />
                            <span>{{ settings.address || 'г. Ташкент, Узбекистан' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-8 border-t border-slate-800 pt-8 text-center text-xs text-slate-500"
            >
                {{ settings.copyright || '© 2001—2026 «Mirum Textile». Все права защищены.' }}
            </div>
        </div>
    </footer>
</template>
