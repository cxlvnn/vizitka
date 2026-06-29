<script lang="ts">
defineOptions({
    layout: {
        title: 'Verify email',
        description:
            'Please verify your email address by clicking on the link we just emailed to you.',
    },
});
</script>

<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { logout } from '@/routes';
import { send } from '@/routes/verification';

const { __ } = useTranslations();

defineProps<{
    status?: string;
}>();
</script>

<template>
    <Head :title="__('Email verification')" />

    <div
        v-if="status === 'verification-link-sent'"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>

    <Form
        v-bind="send.form()"
        class="space-y-6 text-center"
        v-slot="{ processing }"
    >
        <Button :disabled="processing" variant="secondary">
            <Spinner v-if="processing" />
            {{ __('Resend verification email') }}
        </Button>

        <TextLink :href="logout()" as="button" class="mx-auto block text-sm">
            {{ __('Log out') }}
        </TextLink>
    </Form>
</template>
