<script setup lang="ts">
import PublicNav from '@/components/PublicNav.vue';
import PublicFooter from '@/components/PublicFooter.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <PublicNav />
        <main class="flex-1">
            <slot />
        </main>
        <PublicFooter />
    </div>
</template>
