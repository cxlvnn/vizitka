# Sedat Triko — Product Database Structure

## 1. Product Taxonomy

### Main Categories (5)
```
01. Воротники и манжеты (Collars & Cuffs)
02. Ленты и тесьмы (Ribbons & Tapes)
03. Шнуры (Cords)
04. Вязанные изделия (Knitted Garments)
05. Фасонная пряжа (Fancy Yarn)
```

### Subcategories (15)
```
01.01 Воротники (Collars)
01.02 Манжеты (Cuffs)

02.01 Ленты вязанные (Knitted ribbons)
02.02 Ленты жаккардовые (Jacquard ribbons)
02.03 Ленты тканые (Woven ribbons)
02.04 Ленты эластичные (Elastic ribbons)

03.01 Шнуры вязанные (Knitted cords)
03.02 Шнуры декоративные (Decorative cords)
03.03 Шнуры плетельные (Braided cords)
03.04 Шнуры кругловязаные (Circular knitted cords) — SPECIAL FEATURE

04.01 Женские (Women's)
04.02 Мужские (Men's)
04.03 Детские (Children's)
```

### Special/Uncategorized Tags
- Корпоративная продукция (Corporate products)
- Сувенирная продукция (Souvenirs)
- С логотипом (With logo)
- Скидка (Discount)

---

## 2. Product Data Model

### Core Product Fields
```typescript
interface Product {
  id: string;              // UUID or slug
  sku: string;             // Артикул № (e.g., "DK 0001")
  name_ru: string;         // Russian name
  name_uz: string;         // Uzbek name
  name_en: string;         // English name
  slug: string;            // URL-friendly (e.g., "vorotnik-6")
  
  category_id: string;     // Main category
  subcategory_id: string;  // Subcategory
  tags: string[];          // Special tags
  
  description_ru: string;
  description_uz: string;
  description_en: string;
  
  images: Image[];         // Gallery
  thumbnail: string;       // Primary 210×155 equiv
  
  specifications: Spec[];  // Technical data
  
  moq: number;             // Minimum order quantity
  moq_unit: string;        // "шт", "м", "кг"
  lead_time_days: number;  // Production time
  
  customization: {
    available: boolean;
    options: string[];      // ["logo", "color", "width", "material"]
    min_quantity: number;
  };
  
  pricing: {
    has_discount: boolean;
    discount_percent: number;  // e.g., 3, 5, 20
    price_tier: "request";     // Always "request" for B2B
  };
  
  is_featured: boolean;      // Show on homepage
  is_new: boolean;           // "Новая продукция" badge
  is_active: boolean;        // Published?
  
  related_products: string[]; // IDs
  
  created_at: Date;
  updated_at: Date;
}

interface Image {
  url: string;
  alt_ru: string;
  alt_uz: string;
  alt_en: string;
  width: number;
  height: number;
  is_primary: boolean;
}

interface Spec {
  key_ru: string;    // e.g., "Состав"
  key_uz: string;
  key_en: string;
  value_ru: string;  // e.g., "100% хлопок"
  value_uz: string;
  value_en: string;
}
```

---

## 3. Category Detail Content

### Category: Шнуры кругловязаные (Circular Knitted Cords)
**From current site — featured specialty**

**Description:**
> Шнуры кругловязаные без наполнения, с наполнением, отделочные для верхней одежды и обуви, прыгалок, абажуров, специального назначения, 6-ти игольные шнуры.

**Technical Capabilities:**
- Without filling
- With filling
- Decorative finishing
- Special purpose
- 6-needle technology (unique offering)

**Applications:**
- Outerwear drawstrings
- Footwear laces
- Jump ropes (прыгалки)
- Lamp shades (абажуры)
- Special industrial uses

---

## 4. Sample Products (from archive)

### Product 1: Воротник-6
- **Category**: Collars & Cuffs → Collars
- **Slug**: vorotnik-6
- **Image**: `/wp-content/uploads/2017/02/IMG_4227-210x155.jpg`
- **SKU**: [Not specified in archive]
- **Status**: New product

### Product 2: Воротник-5
- **Category**: Collars & Cuffs → Collars
- **Slug**: vorotnik-5
- **Image**: `/wp-content/uploads/2017/02/IMG_3349-копия-1-210x155.jpg`
- **SKU**: [Not specified]

### Product 3: Воротник-3
- **Category**: Collars & Cuffs → Collars
- **Slug**: vorotnik-3
- **Image**: `/wp-content/uploads/2017/02/IMG_0275-210x155.jpg`
- **SKU**: [Not specified]

### Product 4: Детские-3
- **Category**: Knitted Garments → Children's
- **Slug**: detskie-3
- **Image**: `/wp-content/uploads/2017/02/IMG_0778-2-210x155.jpg`
- **SKU**: [Not specified]

### Product 5: Воротник-2
- **Category**: Collars & Cuffs → Collars
- **Slug**: vorotnik-2
- **Image**: `/wp-content/uploads/2017/02/IMG_336-исправ-1-210x155.jpg`
- **SKU**: [Not specified]

### Product 6: Шнур-2
- **Category**: Cords → [subcategory unspecified]
- **Slug**: shnur-2
- **Image**: `/wp-content/uploads/2017/02/IMG_0206-210x155.jpg`
- **SKU**: DK 0001

### Discount Product 1: Шнуры кругловязаные
- **Discount**: 3%
- **Image**: `/wp-content/uploads/2014/10/P40400122-210x155.jpg`

### Discount Product 2: Ленты тканые
- **Discount**: 5%
- **Image**: `/wp-content/uploads/2014/10/P40400502-210x155.jpg`

### Discount Product 3: Манжет в полоску из нитей полиэстер
- **Discount**: 20%
- **Image**: `/wp-content/uploads/2014/09/p4030098-210x155.jpg`

---

## 5. Product Page URL Patterns

| Type | Pattern | Example |
|------|---------|---------|
| Category | `/ru/category/[slug]/` | `/ru/category/vorotniki-i-manzheti/` |
| Subcategory | `/ru/tag/[slug]/` | `/ru/tag/vorotniki/` |
| Product | `/ru/[slug]/` | `/ru/vorotnik-6/` |
| Discount | `/ru/discounts/` | `/ru/discounts/` |

---

## 6. Content Migration Notes

### From WordPress Archive
- **Total products visible**: 6 new products + 3 discounts = 9 featured items
- **Estimated total products**: 50–100 based on category depth
- **Image quality**: 210×155px thumbnails — **INSUFFICIENT for modern web**
- **Data completeness**: Many products lack SKUs, descriptions, full specs
- **Migration effort**: HIGH — requires content audit, photo reshoot, data entry

### Recommended Migration Approach
1. Export WordPress posts (products) to CSV
2. Audit: mark products as Active / Needs Update / Archive
3. Batch-process images: upscale best ones, flag for reshoot
4. Import to new CMS with new taxonomy
5. 301 redirects from old URLs to new structure

---

## 7. Product Display Rules

### Homepage "New Products" Section
- Max 6 items
- Priority: `is_new === true` + `is_active === true`
- Ordered by `created_at` DESC
- Each card: Image (3:2), Name, SKU, "Подробнее" link

### "Discounts" Section
- Max 4 items
- Priority: `has_discount === true` + `is_active === true`
- Ordered by `discount_percent` DESC
- Badge: Circle with "-{percent}%"

### Category Listing Page
- Grid: 3 columns desktop, 2 tablet, 1 mobile
- Pagination: 12 items per page
- Sort options: Newest, Name A-Z, SKU
- Filter: Subcategory (checkbox), Customization available (toggle)

### Product Detail Page
- Gallery: Main image large, thumbnails below
- Info block: SKU, specs table, MOQ, lead time
- CTA: "Запросить КП" button (sticky on mobile)
- Related products: 4 items from same category
- Breadcrumb: Home → Category → Subcategory → Product
