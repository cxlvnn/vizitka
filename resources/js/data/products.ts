// Static product data for MVP showcase — Mirum Textile
// TODO: Replace with real database content

export interface Product {
    id: number;
    slug: string;
    name: string;
    sku: string;
    category: string;
    subcategory: string;
    description: string;
    image?: string;
    specs: { label: string; value: string }[];
    moq: string;
    leadTime: string;
    customization: boolean;
    isNew: boolean;
    discount?: number;
}

export interface Category {
    slug: string;
    name: string;
    subcategories: { slug: string; name: string }[];
    itemCount: number;
    description: string;
}

export const categories: Category[] = [
    {
        slug: 'vorotniki-i-manzheti',
        name: 'Воротники и манжеты',
        subcategories: [
            { slug: 'vorotniki', name: 'Воротники' },
            { slug: 'manzheti', name: 'Манжеты' },
        ],
        itemCount: 24,
        description: 'Плосковязаные воротники и манжеты для рубашек, блуз, верхней одежды.',
    },
    {
        slug: 'lenty-i-tesmy',
        name: 'Ленты и тесьмы',
        subcategories: [
            { slug: 'vyazannye-lenty', name: 'Ленты вязанные' },
            { slug: 'zhakkardovye-lenty', name: 'Ленты жаккардовые' },
            { slug: 'tkanye-lenty', name: 'Ленты тканые' },
            { slug: 'elasticheskie-lenty', name: 'Ленты эластичные' },
        ],
        itemCount: 36,
        description: 'Вязанные, тканые, жаккардовые и эластичные ленты для одежды и сувениров.',
    },
    {
        slug: 'shnury',
        name: 'Шнуры',
        subcategories: [
            { slug: 'vyazannye-shnury', name: 'Шнуры вязанные' },
            { slug: 'dekorativnye-shnury', name: 'Шнуры декоративные' },
            { slug: 'pletenye-shnury', name: 'Шнуры плетельные' },
            { slug: 'kruglovyazanye-shnury', name: 'Шнуры кругловязаные' },
        ],
        itemCount: 18,
        description: 'Кругловязаные, декоративные и плетельные шнуры. 6-ти игольные — наше уникальное предложение.',
    },
    {
        slug: 'vyazannye-izdeliya',
        name: 'Вязанные изделия',
        subcategories: [
            { slug: 'zhenskie', name: 'Женские' },
            { slug: 'muzhskie', name: 'Мужские' },
            { slug: 'detskie', name: 'Детские' },
        ],
        itemCount: 42,
        description: 'Готовые трикотажные изделия и шарфы: мужские, женские, детские.',
    },
    {
        slug: 'fasonnaya-pryazha',
        name: 'Фасонная пряжа',
        subcategories: [],
        itemCount: 12,
        description: 'Фасонные нити для ручного и машинного вязания. Широкая палитра цветов.',
    },
];

export const products: Product[] = [
    {
        id: 1,
        slug: 'vorotnik-6',
        name: 'Воротник-6',
        sku: 'DK 0001',
        category: 'Воротники и манжеты',
        subcategory: 'Воротники',
        description: 'Плосковязаный воротник для рубашек и блуз. Классический дизайн, стабильная форма после стирки.',
        specs: [
            { label: 'Состав', value: '100% хлопок' },
            { label: 'Ширина', value: '3.5 см' },
            { label: 'Цвета', value: 'Белый, молочный, голубой' },
            { label: 'Мин. заказ', value: '500 шт' },
            { label: 'Срок изготовления', value: '7–14 дней' },
            { label: 'Нанесение логотипа', value: 'Возможно (жаккард)' },
        ],
        moq: '500 шт',
        leadTime: '7–14 дней',
        customization: true,
        isNew: true,
    },
    {
        id: 2,
        slug: 'vorotnik-5',
        name: 'Воротник-5',
        sku: 'DK 0002',
        category: 'Воротники и манжеты',
        subcategory: 'Воротники',
        description: 'Плосковязаный воротник с фигурным краем. Идеально для женских блуз и детской одежды.',
        specs: [
            { label: 'Состав', value: '100% хлопок' },
            { label: 'Ширина', value: '4.0 см' },
            { label: 'Цвета', value: 'Белый, розовый, лавандовый' },
            { label: 'Мин. заказ', value: '500 шт' },
            { label: 'Срок изготовления', value: '7–14 дней' },
            { label: 'Нанесение логотипа', value: 'Возможно (жаккард)' },
        ],
        moq: '500 шт',
        leadTime: '7–14 дней',
        customization: true,
        isNew: true,
    },
    {
        id: 3,
        slug: 'vorotnik-3',
        name: 'Воротник-3',
        sku: 'DK 0003',
        category: 'Воротники и манжеты',
        subcategory: 'Воротники',
        description: 'Классический воротник для мужских рубашек. Усиленные края, премиальное качество вязки.',
        specs: [
            { label: 'Состав', value: '92% хлопок, 8% эластан' },
            { label: 'Ширина', value: '3.0 см' },
            { label: 'Цвета', value: 'Белый, голубой, серый' },
            { label: 'Мин. заказ', value: '1000 шт' },
            { label: 'Срок изготовления', value: '10–14 дней' },
            { label: 'Нанесение логотипа', value: 'Возможно' },
        ],
        moq: '1000 шт',
        leadTime: '10–14 дней',
        customization: true,
        isNew: false,
    },
    {
        id: 4,
        slug: 'manzhet-v-polosku',
        name: 'Манжет в полоску из нитей полиэстер',
        sku: 'DK 0010',
        category: 'Воротники и манжеты',
        subcategory: 'Манжеты',
        description: 'Декоративный манжет в полоску для женских блуз. Яркий акцентный элемент.',
        specs: [
            { label: 'Состав', value: '100% полиэстер' },
            { label: 'Ширина', value: '5.0 см' },
            { label: 'Цвета', value: 'Красно-белый, черно-белый' },
            { label: 'Мин. заказ', value: '300 шт' },
            { label: 'Срок изготовления', value: '5–10 дней' },
            { label: 'Нанесение логотипа', value: 'Нет' },
        ],
        moq: '300 шт',
        leadTime: '5–10 дней',
        customization: false,
        isNew: false,
        discount: 20,
    },
    {
        id: 5,
        slug: 'lenta-zhakkardovaya-1',
        name: 'Лента жаккардовая с логотипом',
        sku: 'DK 0020',
        category: 'Ленты и тесьмы',
        subcategory: 'Ленты жаккардовые',
        description: 'Жаккардовая лента с интегрированным логотипом. Идеально для корпоративных ланъярдов и сувениров.',
        specs: [
            { label: 'Состав', value: '100% полиэстер' },
            { label: 'Ширина', value: '10–25 мм' },
            { label: 'Цвета', value: 'По Pantone заказчика' },
            { label: 'Мин. заказ', value: '1000 м' },
            { label: 'Срок изготовления', value: '14–21 день' },
            { label: 'Нанесение логотипа', value: 'Жаккард (вплетение)' },
        ],
        moq: '1000 м',
        leadTime: '14–21 день',
        customization: true,
        isNew: true,
    },
    {
        id: 6,
        slug: 'shnur-kruglovyazanyy-1',
        name: 'Шнур кругловязаный 6-ти игольный',
        sku: 'DK 0030',
        category: 'Шнуры',
        subcategory: 'Шнуры кругловязаные',
        description: 'Уникальный 6-ти игольный кругловязаный шнур. Превосходная круглость и плотность.',
        specs: [
            { label: 'Состав', value: '100% хлопок / полиэстер' },
            { label: 'Диаметр', value: '3–8 мм' },
            { label: 'Цвета', value: 'Любые по запросу' },
            { label: 'Мин. заказ', value: '500 м' },
            { label: 'Срок изготовления', value: '10–14 дней' },
            { label: 'Нанесение логотипа', value: 'Возможно' },
        ],
        moq: '500 м',
        leadTime: '10–14 дней',
        customization: true,
        isNew: true,
        discount: 3,
    },
    {
        id: 7,
        slug: 'lenta-tkanaya-1',
        name: 'Лента тканая для упаковки',
        sku: 'DK 0025',
        category: 'Ленты и тесьмы',
        subcategory: 'Ленты тканые',
        description: 'Тканая лента для упаковки и декора. Прочная, с четким рисунком.',
        specs: [
            { label: 'Состав', value: '100% полиэстер' },
            { label: 'Ширина', value: '5–50 мм' },
            { label: 'Цвета', value: 'Стандартная палитра' },
            { label: 'Мин. заказ', value: '1000 м' },
            { label: 'Срок изготовления', value: '7–14 дней' },
            { label: 'Нанесение логотипа', value: 'Шелкография' },
        ],
        moq: '1000 м',
        leadTime: '7–14 дней',
        customization: true,
        isNew: false,
        discount: 5,
    },
    {
        id: 8,
        slug: 'detskie-3',
        name: 'Детские вязаные изделия — коллекция 3',
        sku: 'DK 0040',
        category: 'Вязанные изделия',
        subcategory: 'Детские',
        description: 'Мягкие вязаные изделия для детей: шапочки, шарфики, варежки. Гипоаллергенные материалы.',
        specs: [
            { label: 'Состав', value: '100% хлопок (гипоаллергенный)' },
            { label: 'Размеры', value: '0–12 лет' },
            { label: 'Цвета', value: 'Пастельные тона' },
            { label: 'Мин. заказ', value: '50 комплектов' },
            { label: 'Срок изготовления', value: '14–21 день' },
            { label: 'Нанесение логотипа', value: 'Возможно (вязка)' },
        ],
        moq: '50 комплектов',
        leadTime: '14–21 день',
        customization: true,
        isNew: true,
    },
    {
        id: 9,
        slug: 'shnur-dekorativnyy-1',
        name: 'Шнур декоративный с кисточками',
        sku: 'DK 0035',
        category: 'Шнуры',
        subcategory: 'Шнуры декоративные',
        description: 'Декоративный шнур с кисточками для верхней одежды, абажуров, интерьерного декора.',
        specs: [
            { label: 'Состав', value: 'Хлопок / полиэстер' },
            { label: 'Диаметр', value: '4–6 мм' },
            { label: 'Цвета', value: 'Натуральные, крашеные' },
            { label: 'Мин. заказ', value: '200 м' },
            { label: 'Срок изготовления', value: '7–10 дней' },
            { label: 'Нанесение логотипа', value: 'Нет' },
        ],
        moq: '200 м',
        leadTime: '7–10 дней',
        customization: false,
        isNew: false,
    },
];

export function getProductBySlug(slug: string): Product | undefined {
    return products.find((p) => p.slug === slug);
}

export function getProductsByCategory(categorySlug: string): Product[] {
    const category = categories.find((c) => c.slug === categorySlug);
    if (!category) return [];
    return products.filter((p) => p.category === category.name);
}

export function getNewProducts(): Product[] {
    return products.filter((p) => p.isNew).slice(0, 6);
}

export function getDiscountProducts(): Product[] {
    return products.filter((p) => p.discount !== undefined).slice(0, 4);
}
