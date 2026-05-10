# Sedat Triko — Technical Requirements

## 1. Technology Stack Recommendations

### Option A: Modern Static Site (Recommended for speed + security)
- **Generator**: Next.js 14+ (App Router) or Astro
- **Styling**: Tailwind CSS + shadcn/ui components
- **CMS**: Sanity.io or Strapi for product/job management
- **Hosting**: Vercel or Netlify
- **Forms**: React Hook Form + Email API (Resend/SendGrid) or Telegram Bot
- **i18n**: next-intl (Next.js) or built-in Astro i18n

### Option B: WordPress (Familiar for client, but needs modernization)
- **Theme**: Custom block theme (FSE — Full Site Editing)
- **Plugins**: Advanced Custom Fields Pro, Polylang (multilingual), WPForms
- **Optimization**: WP Rocket, Imagify, Query Monitor
- **Hosting**: Dedicated Uzbekistan-friendly hosting or Cloudways

### Option C: Headless Commerce (If future e-commerce planned)
- **Frontend**: Next.js
- **Backend**: Shopify B2B or WooCommerce headless
- **CMS**: Same as Option A

**Recommendation**: Option A (Next.js) for:
- Superior performance in Uzbekistan (3G/4G networks)
- Better SEO control
- Modern developer experience
- Easier WhatsApp/Telegram integration

---

## 2. Performance Requirements

| Metric | Target | Why |
|--------|--------|-----|
| Lighthouse Performance | ≥ 90 | Mobile-first market |
| First Contentful Paint | < 1.5s | 3G network users |
| Time to Interactive | < 3.5s | B2B buyers won't wait |
| Image format | WebP with JPEG fallback | Product-heavy site |
| Lazy loading | All below-fold images | Critical for product grids |
| CDN | Cloudflare or Vercel Edge | Global B2B clients |

---

## 3. Responsive Breakpoints

| Name | Width | Notes |
|------|-------|-------|
| Mobile S | 320px | Minimum supported. Single column |
| Mobile M | 375px | iPhone SE / budget Androids |
| Mobile L | 425px | Large phones |
| Tablet | 768px | 2-column grids appear |
| Laptop | 1024px | Full nav visible |
| Desktop | 1440px | Maximum content width (1280px centered) |
| Wide | 1920px + | 4K monitors, extra padding |

---

## 4. Browser Support

- **Chrome**: Last 3 versions (primary in Uzbekistan)
- **Safari**: Last 2 versions (iPhone users)
- **Firefox**: Latest
- **Samsung Internet**: Latest (huge in Android market)
- **Edge**: Latest
- **IE11**: ❌ Not supported (End of life)

---

## 5. Accessibility (WCAG 2.1 AA)

### Requirements
- All images have descriptive alt text
- Color contrast ratio ≥ 4.5:1 for body text
- Focus indicators visible on all interactive elements
- Keyboard navigation support for mega-menu
- Form labels associated with inputs
- Skip-to-content link
- ARIA labels for icon-only buttons (WhatsApp, phone)

### Language Attribute
```html
<html lang="ru"> <!-- for Russian version -->
<html lang="uz"> <!-- for Uzbek version -->
<html lang="en"> <!-- for English version -->
```

---

## 6. SEO Technical Requirements

### URL Structure
```
/                    → Homepage (language selector or auto-detect)
/ru/                 → Russian homepage
/uz/                 → Uzbek homepage
/en/                 → English homepage
/ru/category/vorotniki-i-manzheti/  → Category
/ru/product/vorotnik-6/             → Product detail
/ru/about/           → About
/ru/contact/         → Contact
/ru/jobs/            → Job listings
```

### Meta Tags Template
```html
<title>[Page Title] | Sedat Triko Tashkent</title>
<meta name="description" content="[150-160 char description]">
<link rel="canonical" href="https://sedattriko.uz/ru/[page]/">
<meta property="og:title" content="[Page Title] | Sedat Triko">
<meta property="og:image" content="https://sedattriko.uz/og-image.jpg">
```

### Structured Data (Schema.org)
- **Organization** schema on homepage
- **Product** schema on product pages (name, SKU, image, brand)
- **BreadcrumbList** on all interior pages
- **LocalBusiness** on contact page
- **JobPosting** on individual job pages

---

## 7. Integrations

### Required
| Service | Purpose | Implementation |
|---------|---------|---------------|
| **WhatsApp Business** | Primary B2B communication | `wa.me/` links + WhatsApp Business API for notifications |
| **Telegram** | Uzbekistan market | Bot for quote notifications, channel for news |
| **Yandex.Metrika** | Analytics (CIS market standard) | Counter + goals for quote submissions |
| **Google Analytics 4** | Global analytics | Events for product views, quote requests |

### Recommended
| Service | Purpose |
|---------|---------|
| **Google reCAPTCHA v3** | Form spam protection (invisible) |
| **Cloudflare** | CDN + DDoS protection |
| **Sentry** | Error tracking |

### Retire (Current site has these — evaluate)
- Google+ (platform shut down)
- Twitter/X (verify if active)
- VK (verify if active for Uzbekistan market)

---

## 8. Form Handling

### Quote Request Form
```
POST /api/quote
Body: {
  name: string (required),
  company: string,
  phone: string (required, regex: /^\+?\d[\d\s-]{8,}$/),
  email: string (email format),
  product_interest: string[] (category IDs),
  product_sku: string (if from product page),
  quantity: string,
  customization_needed: boolean,
  customization_details: string,
  message: string,
  consent: boolean (required)
}
```

### Delivery Targets
1. **Primary**: Email to info@sedattriko.uz + sales team
2. **Secondary**: Telegram Bot notification to sales manager
3. **Tertiary**: CRM entry (if/when CRM adopted)

### Auto-response
- Instant: "Спасибо за обращение! Мы получили ваш запрос и свяжемся в течение рабочего дня."
- Follow-up (24h): If no human response, send reminder to internal team

---

## 9. Security Requirements

- HTTPS only (HSTS enabled)
- Secure contact forms (CSRF protection)
- No sensitive data in URLs
- Image upload validation (if client uploads)
- Regular dependency updates (automated with Dependabot)

---

## 10. Backup & Maintenance

- **Automated daily backups** of CMS database
- **Version control**: Git repository (GitHub/GitLab)
- **Staging environment**: `staging.sedattriko.uz`
- **Deployment**: CI/CD pipeline (GitHub Actions/Vercel)
- **Uptime monitoring**: UptimeRobot or Pingdom
- **Monthly report**: Traffic, quote requests, page performance

---

## 11. Third-Party Assets (from current site)

| Asset | Current Location | Action |
|-------|-----------------|--------|
| Logo | `/wp-content/themes/sedattriko/img/sedat-logo.png` | Vector recreation (SVG) |
| Product thumbs | `/wp-content/uploads/2017/02/` | Archive + request high-res |
| Theme files | `/wp-content/themes/sedattriko/` | Analyze, do not reuse design |

---

## 12. Hosting & Domain

| Item | Current | Recommended |
|------|---------|-------------|
| Domain | sedattriko.uz | Keep, renew |
| DNS | Current registrar | Cloudflare |
| Hosting | Unknown | Vercel (frontend) + CMS host |
| Email | info@sedattriko.uz | Keep current provider or Google Workspace |
| SSL | Let's Encrypt or existing | Auto-renew Let's Encrypt |
