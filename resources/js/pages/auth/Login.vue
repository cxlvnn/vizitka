<script lang="ts">
defineOptions({
    layout: {
        title: 'Welcome back',
        description: 'Sign in to your account to continue shopping',
    },
});
</script>

<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

const { __ } = useTranslations();

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head :title="__('Log in')" />

    <div
        v-if="status"
        class="mb-4 rounded-lg bg-green-50 p-3 text-center text-sm font-medium text-green-600 dark:bg-green-900/20"
    >
        {{ status }}
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-5">
            <div class="grid gap-2">
                <Label for="email">{{ __('Email') }}</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="email"
                    :placeholder="__('you@example.com')"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password">{{ __('Password') }}</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-xs"
                    >
                        {{ __('Forgot password?') }}
                    </TextLink>
                </div>
                <Input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Enter your password')"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center gap-2">
                <Checkbox id="remember" name="remember" />
                <Label for="remember" class="text-sm font-normal"
                    >{{ __('Remember me') }}</Label
                >
            </div>

            <Button type="submit" class="w-full" :disabled="processing"
                >
                <Spinner v-if="processing" />
                {{ __('Sign in') }}
            </Button>
        </div>

        <div
            class="text-center text-sm text-muted-foreground"
            v-if="canRegister"
        >
            {{ __("Don't have an account?") }}
            <TextLink :href="register()">{{ __('Create one') }}</TextLink>
        </div>
    </Form>
</template>
