import type { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
};

export type Product = {
    id: number;
    name: string;
    description: string | null;
    price: number;
    image: string | null;
    category: string | null;
    quantity?: number;
};

export type PaginatedProducts = {
    data: Product[];
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
    links: { url: string | null; label: string; active: boolean }[];
};

export type Category = string;

export type CartItem = Product & { quantity: number };
