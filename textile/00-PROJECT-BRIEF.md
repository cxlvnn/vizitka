# Sedat Triko Tashkent — Website Design Brief

## 1. Overview

| Field | Value |
|-------|-------|
| **Company Name** | ИП ООО «Sedat Triko Tashkent» |
| **Website Domain** | sedattriko.uz |
| **Industry** | Textile Manufacturing / B2B Wholesale |
| **Primary Languages** | Russian (current site), likely Uzbek & English for new version |
| **Year Established** | 2001 |
| **Location** | Tashkent, Uzbekistan |
| **Phone** | +(99871) 253 95 40 |
| **Email** | info@sedattriko.uz |

### Company Summary
Sedat Triko Tashkent is a **manufacturer** (not a reseller) of textile accessories for clothing and footwear, lanyards, badge ribbons, mobile phone straps, ready-made knitted garments, and scarves. They operate on a B2B wholesale model with corporate customization capabilities (logos, corporate identity, souvenirs).

---

## 2. Website Goals & Purpose

### Primary Goals
1. **Product Catalog Showcase** — Display extensive textile product range with photos, SKUs, and technical specs
2. **B2B Lead Generation** — Convert factory buyers, fashion brands, corporate clients into inquiries
3. **Corporate Trust Building** — Establish credibility through certificates, client list, 20+ year history
4. **Recruitment** — Fill industrial positions (seamstresses, equipment mechanics)

### Target Audiences
| Audience | Needs |
|----------|-------|
| **Garment Manufacturers** | Bulk collars, cuffs, elastics for clothing production |
| **Fashion Brands** | Custom jacquard ribbons, branded lanyards, corporate souvenirs |
| **Footwear Companies** | Decorative and functional cords |
| **Corporate Buyers** | Branded lanyards, badge holders, promotional items |
| **Retail Distributors** | Ready-made knitwear (men's, women's, children's) |
| **Job Seekers** | Industrial sewing/textile equipment positions |

---

## 3. Sitemap & Page Structure

### Primary Navigation
```
├── Главная (Home)
├── О компании (About)
├── Продукция (Products) — MEGA MENU
│   ├── Воротники и манжеты (Collars & Cuffs)
│   │   ├── Воротники (Collars)
│   │   └── Манжеты (Cuffs)
│   ├── Ленты и тесьмы (Ribbons & Tapes)
│   │   ├── Ленты вязанные (Knitted ribbons)
│   │   ├── Ленты жаккардовые (Jacquard ribbons)
│   │   ├── Ленты тканые (Woven ribbons)
│   │   └── Ленты эластичные (Elastic ribbons)
│   ├── Вязанные изделия (Knitted Garments)
│   │   ├── Женские (Women's)
│   │   ├── Мужские (Men's)
│   │   └── Детские (Children's)
│   ├── Фасонная пряжа (Fancy Yarn)
│   └── Шнуры (Cords)
│       ├── Шнуры вязанные (Knitted cords)
│       ├── Шнуры декоративные (Decorative cords)
│       └── Шнуры плетельные (Braided cords)
├── Наши клиенты (Our Clients / Partners)
├── Сертификаты (Certificates)
├── Контакты (Contact)
└── Вакансии (Jobs) — secondary nav
```

### Content/News Sections
- **Новая продукция** (New Products) — product highlight grid
- **Это интересно** (Interesting / Industry News) — blog-style articles, trade show reports, textile chemistry education
- **Скидки** (Discounts) — promotional products with discount badges

---

## 4. Visual Identity Requirements

### Existing Brand Assets
- **Logo**: `sedat-logo.png` — needs to be preserved and likely modernized
- **Color Palette** (to be extracted/refined from existing site):
  - Primary brand color (likely deep blue or burgundy — common in textile industry)
  - Secondary accent for CTAs
  - Clean white backgrounds for product photography
- **Typography**: Professional, legible. Likely needs a modern font upgrade while keeping Cyrillic compatibility

### Photography Style
- **Products**: Shot on clean white/neutral backgrounds, consistent 210×155px thumbnails (as seen in current archive) but needs much higher resolution for modern retina displays
- **Factory/Production**: Behind-the-scenes manufacturing shots to reinforce "manufacturer" credibility
- **Trade Shows**: Event photography (Kazakhstan exhibition documented)
- **No stock-photo feel** — authentic factory-made aesthetic is a competitive advantage

---

## 5. Key Content Sections (Homepage Wireframe Logic)

### Hero Section
- Value proposition emphasizing **20+ years experience** + **manufacturer status** (not middleman)
- Primary CTA: "Смотреть продукцию" / "View Products"
- Secondary CTA: "Связаться с нами" / "Contact Us"
- Background: High-quality textile product imagery or subtle factory/loom video

### Company Advantages ("Преимущества компании")
4-5 icon cards:
1. ✅ **Quality** — "Качество изделий"
2. ✅ **Range** — "Богатый ассортимент"
3. ✅ **Custom Projects** — "Любой проект под заказ"
4. ✅ **Honest Timelines** — "Честные сроки"
5. ✅ **Fair Pricing** — "Разумные цены"

### Product Category Grid
Visual grid of 5 main categories with representative images:
- Collars & Cuffs
- Ribbons & Tapes  
- Cords
- Knitted Garments
- Fancy Yarn

### New Products Carousel/Grid
6 featured items with:
- Product photo (retina-ready)
- Product name
- SKU/Article number (Артикул №)
- Quick-view or detail page link

### Discounts/Promotions Section
3-4 items with:
- Product image
- Discount badge (-3%, -5%, -20%)
- Product name
- Link to category

### News/Industry Insights
- Trade show reports (Kazakhstan 2017 format)
- Textile chemistry/educational content
- "View All" link to blog archive

### Client Logos / Trust Bar
- Partner/client logo grid (black & white or muted color)
- Certificate icons

### Footer
- Contact info (phone + email)
- Social links: Facebook, Twitter, VK, Google+ (update to modern platforms if needed)
- Quick links sitemap
- Copyright: © 2001—2026 «SedatTriko»
- Developer credit: "Smart Soft Development" (ssd.uz)

---

## 6. Product Page Template Requirements

Every product page must include:
- **Breadcrumb navigation** (Home > Category > Subcategory > Product)
- **High-resolution product gallery** (multiple angles where applicable)
- **SKU / Article number** prominently displayed
- **Technical specifications table**:
  - Material composition
  - Width/diameter
  - Colors available
  - Minimum order quantity (MOQ)
  - Customization options (logo, color matching)
- **Related products** (cross-sell within same category)
- **"Request Quote" CTA** (not "Add to Cart" — this is B2B)
- **Downloadable spec sheet** (PDF)

---

## 7. Functional Requirements

### E-commerce vs. Catalog
- **NO direct online checkout** — This is B2B manufacturing with custom orders
- **"Request Quote" workflow**: Form → Product selection → Quantity → Customization needs → Contact details
- **WhatsApp/Telegram integration** for Uzbekistan market (critical)

### Multi-language
- Russian (primary, current)
- Uzbek (state language requirement)
- English (export/B2B international clients)

### Job Board
- Simple job posting system
- 2 current examples:
  - Seamstresses (швеи) — urgent
  - Textile equipment electromechanic — requires vehicle + vocational education

### SEO & Technical
- Clean URL structure: `/ru/category/products/`
- Product schema markup
- Fast loading (product-heavy site)
- Mobile-first (many Uzbekistan users on mobile)

---

## 8. Emotional Tone & Messaging

| Attribute | Expression |
|-----------|------------|
| **Trustworthy** | "20 years in the market", certificates, real factory photos |
| **Capable** | "Any project", "unique technologies", "full production cycle" |
| **Professional B2B** | No retail consumer language. Focus on wholesale, customization, timelines |
| **Uzbek Proud** | Tashkent-based manufacturer, export-capable |
| **Modern** | Must NOT look like a 2014 WordPress theme (current pain point) |

---

## 9. Competitive Differentiators to Design Around

1. **Full-cycle manufacturer** — Design should communicate "we make it here" with factory imagery
2. **Customization leader** — Logo application, corporate colors, jacquard weaving
3. **20-year track record** — Prominent date range (2001–2026)
4. **Technology edge** — "6-needle cords", "flat-knit collars", "jacquard" — these are technical terms that should be showcased as expertise badges

---

## 10. Deliverables for Designer

| Item | Description |
|------|-------------|
| **Logo file** | `sedattriko.uz/wp-content/themes/sedattriko/img/sedat-logo.png` — vector recreation needed |
| **Product photos** | 210×155px thumbnails exist, need reshoots at 800×600+ minimum |
| **Brand colors** | Extract from logo + current site, propose modernized palette |
| **Typography** | Cyrillic-safe font pair (headings + body) |
| **Icon set** | Custom or premium icon library for: quality, delivery, customization, support, factory |
| **Mockups needed** | Homepage, Product Category, Product Detail, About/Clients, Contact |

---

## 11. Open Questions for Stakeholder

1. Should social media links be updated? (Google+ is defunct, VK/Twitter may not be active)
2. Is there a need for an online "client portal" for order tracking?
3. What is the exact primary brand color hex code?
4. Are there high-resolution product photos available, or is a photoshoot budget needed?
5. Should the job board accept online applications, or just display postings?
6. Any export markets to prioritize for English version?

---

*Document prepared for web design & development team. All information extracted from sedattriko.uz archived content.*
