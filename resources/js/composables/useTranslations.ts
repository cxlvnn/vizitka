import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

/**
 * Returns a `__` function for translating strings using the
 * JSON translations shared from the backend via Inertia.
 *
 * Falls back to the key itself when no translation is found.
 */
export function useTranslations() {
    const translations = computed<Record<string, string>>(
        () => usePage().props.translations ?? {},
    );

    function __(key: string, replace: Record<string, string | number> = {}): string {
        let value = translations.value[key] ?? key;

        for (const [placeholder, replacement] of Object.entries(replace)) {
            value = value.replace(`:${placeholder}`, String(replacement));
        }

        return value;
    }

    return { __, translations };
}
