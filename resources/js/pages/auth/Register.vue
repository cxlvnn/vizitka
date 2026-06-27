<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { useTranslations } from '@/composables/useTranslations';
import { login } from '@/routes';
import { store } from '@/routes/register';

const { __ } = useTranslations();

defineOptions({
    layout: {
        title: __('Create account'),
        description: __('Join us and start shopping today'),
    },
});
</script>

<template>
    <Head :title="__('Register')" />

    <Form
        v-bind="store.form()"
        :reset-on-success="['password', 'password_confirmation']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-5">
            <div class="grid gap-2">
                <Label for="name">{{ __('Name') }}</Label>
                <Input
                    id="name"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    name="name"
                    :placeholder="__('Your full name')"
                />
                <InputError :message="errors.name" />
            </div>

            <div class="grid gap-2">
                <Label for="email">{{ __('Email') }}</Label>
                <Input
                    id="email"
                    type="email"
                    required
                    autocomplete="email"
                    name="email"
                    :placeholder="__('you@example.com')"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <Label for="password">{{ __('Password') }}</Label>
                <Input
                    id="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    name="password"
                    :placeholder="__('Choose a strong password')"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="grid gap-2">
                <Label for="password_confirmation">{{ __('Confirm password') }}</Label>
                <Input
                    id="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    name="password_confirmation"
                    :placeholder="__('Repeat your password')"
                />
                <InputError :message="errors.password_confirmation" />
            </div>

            <Button type="submit" class="w-full" :disabled="processing"
                >
                <Spinner v-if="processing" />
                {{ __('Create account') }}
            </Button>
        </div>

        <div class="text-center text-sm text-muted-foreground">
            {{ __('Already have an account?') }}
            <TextLink :href="login()">{{ __('Sign in') }}</TextLink>
        </div>
    </Form>
</template>
