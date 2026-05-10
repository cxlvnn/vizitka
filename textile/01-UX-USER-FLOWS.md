# Sedat Triko — User Experience & User Flow

## 1. User Personas

### Persona 1: "Factory Buyer Oksana"
- **Role**: Procurement manager at a garment factory in Almaty, Kazakhstan
- **Goal**: Source 5,000 woven collar cuffs for spring shirt production
- **Pain Points**: Needs exact specs, reliable delivery timelines, competitive MOQs
- **Tech**: Desktop Chrome, reads Russian
- **Journey**: Homepage → Products → Collars & Cuffs → Views specs → Requests quote → Gets callback within 24h

### Persona 2: "Brand Manager Dmitry"
- **Role**: Marketing director at a Uzbek corporate bank
- **Goal**: Order branded lanyards and badge holders for 500 employees
- **Pain Points**: Needs logo integration, color matching, proof/sample before bulk
- **Tech**: Mobile Safari, prefers WhatsApp
- **Journey**: Homepage → Sees "Корпоративная продукция" → Cords → Decorative → Requests customization quote via WhatsApp

### Persona 3: "Distributor Firuza"
- **Role**: Small retail chain owner buying ready-made knit scarves
- **Goal**: Purchase mixed lot of women's and children's knitwear
- **Pain Points**: Wants to see variety, needs price tiers by volume
- **Tech**: Mobile Chrome, Uzbek language preferred
- **Journey**: Homepage → Knitted Garments → Women's → Views gallery → Switches to Children's → Sends bulk inquiry

### Persona 4: "Job Seeker Nodir"
- **Role**: Experienced seamstress looking for factory work
- **Goal**: Find reliable employer near Tashkent with stable pay
- **Pain Points**: Needs clear requirements, easy application
- **Tech**: Basic Android phone
- **Journey**: Footer link → Jobs → Views seamstress posting → Calls phone number directly

---

## 2. Core User Flows

### Flow A: Product Discovery & Quote Request (Primary)
```
[Entry: Google / Direct]
    ↓
Homepage
    ↓
Product Category Grid / Mega Menu
    ↓
Subcategory Listing (e.g., "Воротники")
    ↓
Product Detail Page
    ↓
"Запросить коммерческое предложение" (Request Quote)
    ↓
Quote Form (Product pre-filled, Quantity, Customization notes)
    ↓
Confirmation + WhatsApp fallback
    ↓
[Sales team follows up within 24 hours]
```

### Flow B: Corporate Customization Inquiry
```
[Entry: Homepage "Корпоративная продукция" banner]
    ↓
Custom Products Landing Page
    ↓
Customization Options (Logo upload, color picker, material selector)
    ↓
Quote Form with Attachment
    ↓
Sample request option
    ↓
[Project manager assigned]
```

### Flow C: Job Application
```
[Entry: Footer or "Вакансии" in nav]
    ↓
Jobs Listing Page
    ↓
Job Detail (Requirements, responsibilities)
    ↓
Application Form or Direct Call/Email
    ↓
[HR receives notification]
```

### Flow D: Trust Verification (Certifications/Clients)
```
[Entry: Homepage → "Наши клиенты" or "Сертификаты"]
    ↓
Partner logos grid / Certificate gallery
    ↓
[User confidence increases → returns to product flow]
```

---

## 3. Information Architecture — Homepage Priority

### Above the Fold (0–100vh)
1. **Navbar**: Logo left, mega-menu products center, phone/WhatsApp right
2. **Hero**: Brand promise + factory imagery + 2 CTAs
3. **Trust Bar**: 5 advantage icons (horizontal row)

### Scroll Zone 1: Product Categories
- Visual 5-card grid with hover effects
- Each card = category photo + title + item count

### Scroll Zone 2: New Products
- 4–6 item carousel or masonry grid
- Each item = photo + name + SKU
- Quick-view modal on click

### Scroll Zone 3: About Teaser + CTA
- 2-column: Factory photo left, text right
- "Узнать больше о компании" button

### Scroll Zone 4: News + Discounts
- Split layout: latest article left, discount card right

### Footer
- 4 columns: Contact, Products, Company, Social
- Copyright + developer credit

---

## 4. Navigation Patterns

### Desktop
- **Sticky header** with mega-menu dropdown for Products
- **Breadcrumbs** on all interior pages
- **Back to top** button on long product lists

### Mobile
- **Hamburger menu** with accordion submenus
- **Click-to-call phone button** floating bottom-right
- **WhatsApp quick-action** floating button
- **Simplified mega-menu** → category list page instead of hover dropdown

---

## 5. Interaction Design Notes

| Element | Behavior |
|---------|----------|
| Product thumbnail | Hover: zoom 1.1x, shadow appears. Click: detail page |
| Category card | Hover: overlay with "Перейти →". Click: subcategory listing |
| Quote button | Primary action color. On click: smooth scroll to form or open modal |
| Discount badge | Eye-catching red/orange circle. Wiggle animation on scroll-into-view |
| Certificate thumbnails | Click: lightbox full-size PDF/image viewer |
| Phone number | Clickable `tel:` link. On mobile, triggers call. On desktop, shows "Call now" tooltip |

---

## 6. Conversion Optimization

1. **Every product page** has a visible quote request CTA
2. **WhatsApp Business integration** — "Написать в WhatsApp" on every page
3. **Exit-intent modal** on product pages: "Не нашли нужный товар? Оставьте запрос — найдем решение!"
4. **MOQ displayed prominently** — B2B buyers need to know minimums immediately
5. **Sample request checkbox** in quote form — lowers commitment barrier
