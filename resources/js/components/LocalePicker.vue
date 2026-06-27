<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Globe } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';

const page = usePage();
const locale = computed(() => page.props.locale as string);

const locales = [
    { code: 'en', label: 'EN' },
    { code: 'ru', label: 'RU' },
    { code: 'uz', label: 'UZ' },
] as const;

function switchLocale(code: string) {
    router.get(`/locale/${code}`, {}, {
        preserveState: true,
        preserveScroll: true,
    });
}
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="ghost" size="sm" class="gap-1.5">
                <Globe class="h-4 w-4" />
                <span class="text-xs font-medium">{{ locale.toUpperCase() }}</span>
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end" class="min-w-0">
            <DropdownMenuItem
                v-for="l in locales"
                :key="l.code"
                :disabled="locale === l.code"
                @click="switchLocale(l.code)"
            >
                <span :class="locale === l.code ? 'font-semibold' : ''">{{ l.label }}</span>
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
