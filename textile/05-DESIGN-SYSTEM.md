# Sedat Triko — Visual Design System (Starter)

## 1. Color Palette (Proposed — to be refined with designer)

### Primary Colors
| Token | Hex | Usage |
|-------|-----|-------|
| `--color-primary-900` | `#1a365d` | Hero backgrounds, dark sections |
| `--color-primary-700` | `#2c5282` | Primary buttons, active nav |
| `--color-primary-500` | `#3182ce` | Links, icons, accents |
| `--color-primary-300` | `#90cdf4` | Hover states, subtle backgrounds |
| `--color-primary-100` | `#ebf8ff` | Light section backgrounds |

### Secondary / Accent
| Token | Hex | Usage |
|-------|-----|-------|
| `--color-accent-600` | `#c05621` | Discount badges, urgency CTAs |
| `--color-accent-500` | `#dd6b20` | Secondary buttons, highlights |
| `--color-accent-100` | `#fffaf0` | Warm section backgrounds |

### Neutral
| Token | Hex | Usage |
|-------|-----|-------|
| `--color-gray-900` | `#1a202c` | Body text, headings |
| `--color-gray-700` | `#4a5568` | Secondary text |
| `--color-gray-500` | `#a0aec0` | Placeholder, disabled |
| `--color-gray-300` | `#e2e8f0` | Borders, dividers |
| `--color-gray-100` | `#f7fafc` | Page background |
| `--color-white` | `#ffffff` | Cards, content areas |

### Semantic
| Token | Hex | Usage |
|-------|-----|-------|
| `--color-success` | `#38a169` | Success messages, "in stock" |
| `--color-warning` | `#d69e2e` | Low stock, attention |
| `--color-error` | `#e53e3e` | Form errors, "out of stock" |

### Brand Context
- The current logo appears to be blue/dark themed. Designer should:
  1. Extract exact colors from existing logo PNG
  2. Propose modernized palette that respects heritage
  3. Test contrast ratios for WCAG AA compliance

---

## 2. Typography

### Font Family
- **Primary**: `Inter` or `Manrope` (Cyrillic + Latin support, modern geometric)
- **Fallback stack**: `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif`
- **Headings**: Same family, weight 600–700
- **Body**: Weight 400, line-height 1.6

### Type Scale
| Level | Size (Desktop) | Size (Mobile) | Weight | Line Height | Usage |
|-------|---------------|---------------|--------|-------------|-------|
| H1 | 48px | 32px | 700 | 1.2 | Homepage hero |
| H2 | 36px | 28px | 600 | 1.3 | Section titles |
| H3 | 24px | 20px | 600 | 1.4 | Card titles, product names |
| H4 | 20px | 18px | 600 | 1.4 | Subsection titles |
| Body Large | 18px | 16px | 400 | 1.6 | Lead paragraphs |
| Body | 16px | 16px | 400 | 1.6 | Main text |
| Body Small | 14px | 14px | 400 | 1.5 | Captions, metadata |
| Caption | 12px | 12px | 500 | 1.4 | Labels, badges |

### Cyrillic Safety Check
- Ensure chosen font has full Cyrillic character set
- Test with sample: "Воротники и манжеты — Шнуры кругловязаные"

---

## 3. Spacing System

Based on 4px grid:
```
--space-1: 4px
--space-2: 8px
--space-3: 12px
--space-4: 16px
--space-5: 24px
--space-6: 32px
--space-7: 48px
--space-8: 64px
--space-9: 96px
--space-10: 128px
```

### Section Padding
- Desktop: 96px top/bottom
- Tablet: 64px top/bottom
- Mobile: 48px top/bottom

### Container Widths
```
--container-sm: 640px
--container-md: 768px
--container-lg: 1024px
--container-xl: 1280px
--container-full: 100%
```
- Content max-width: 1280px, centered with `auto` margins
- Padding: 16px (mobile) / 24px (tablet) / 32px (desktop)

---

## 4. Component Primitives

### Buttons

#### Primary Button
```
Background: --color-primary-700
Text: white
Padding: 12px 24px
Border-radius: 6px
Font: Body, weight 600
Hover: --color-primary-900, shadow-md
Active: scale(0.98)
Disabled: --color-gray-300, --color-gray-500
```

#### Secondary Button
```
Background: transparent
Border: 2px solid --color-primary-700
Text: --color-primary-700
Hover: --color-primary-100
```

#### WhatsApp CTA (Special)
```
Background: #25D366 (WhatsApp green)
Text: white
Icon: WhatsApp icon left of text
Padding: 12px 24px
Border-radius: 6px
Hover: darken 10%
```

### Cards

#### Product Card
```
Background: white
Border: 1px solid --color-gray-200
Border-radius: 8px
Shadow: 0 1px 3px rgba(0,0,0,0.1)
Hover shadow: 0 4px 12px rgba(0,0,0,0.15)
Hover transform: translateY(-4px)
Transition: all 200ms ease
```

- Image area: 3:2 aspect ratio, overflow hidden
- Content padding: 16px
- Title: H4
- SKU: Caption, --color-gray-500
- CTA link: "Подробнее →" with arrow animation on hover

#### Category Card
```
Background: white or --color-primary-100
Border-radius: 12px
Padding: 24px
Icon/illustration top
Title centered
Item count below
Hover: overlay with "Перейти →"
```

### Badges

#### Discount Badge
```
Background: --color-accent-600
Text: white
Shape: circle (40×40px) or pill
Font: Caption, bold
Position: absolute, top-right of product image
```

#### "New" Badge
```
Background: --color-success
Text: white
Shape: pill
Text: "Новинка"
```

---

## 5. Form Elements

### Input Fields
```
Background: white
Border: 1px solid --color-gray-300
Border-radius: 6px
Padding: 12px 16px
Focus: border --color-primary-500, shadow 0 0 0 3px --color-primary-100
Error: border --color-error, background --color-error (5% opacity)
```

### Select/Dropdown
Same as input + custom chevron icon

### Textarea
Same as input, min-height: 120px

### Checkbox/Radio
Custom styled, checked state uses --color-primary-500

---

## 6. Icons

### Icon Library Recommendation
- **Phosphor Icons** or **Lucide** (clean, modern, good Cyrillic compatibility)
- Stroke width: 1.5px or 2px
- Size: 20px (inline), 24px (buttons), 48px (feature icons)

### Required Icons
| Icon | Usage |
|------|-------|
| Phone | Click-to-call |
| Mail | Email link |
| MapPin | Address |
| ChevronRight | Navigation, breadcrumbs |
| ChevronDown | Dropdowns |
| Menu | Mobile hamburger |
| X | Close |
| Search | Product search |
| WhatsApp | Quick contact |
| ArrowRight | CTAs |
| Check | Success, advantages |
| Tag | Discounts |
| Clock | Lead time |
| Package | MOQ |
| Factory | About/manufacturing |
| Award | Certificates |
| Users | Clients |
| Briefcase | Jobs |

---

## 7. Layout Patterns

### Grid System
- CSS Grid with 12 columns
- Gap: 24px (desktop), 16px (mobile)

### Common Layouts

#### Homepage Product Grid
```
Desktop: 3 columns
Tablet: 2 columns
Mobile: 1 column
```

#### Category Cards
```
Desktop: 5 columns (one per category)
Tablet: 3 + 2 wrap
Mobile: 2 columns, then 1
```

#### Footer
```
Desktop: 4 columns
Tablet: 2×2 grid
Mobile: 1 column accordion
```

---

## 8. Motion & Animation

### Principles
- **Subtle**: Enhance, don't distract
- **Fast**: 150–300ms durations
- **Purposeful**: Guide attention, indicate state change

### Standard Transitions
| Element | Trigger | Effect | Duration |
|---------|---------|--------|----------|
| Button hover | mouseenter | Background darken, slight lift | 200ms |
| Card hover | mouseenter | Shadow increase, translateY(-4px) | 200ms |
| Link underline | mouseenter | Width 0→100% left-to-right | 200ms |
| Modal | open | Fade + scale(0.95→1) | 250ms |
| Page transition | navigation | Fade content | 150ms |
| Mobile menu | toggle | Slide from right | 300ms ease-out |

### Scroll Animations (Optional)
- Section fade-in + translateY(20px→0) on scroll into view
- Stagger delay for grid items: 50ms between each
- Trigger once, do not re-animate on scroll back

---

## 9. Shadows

```
--shadow-sm: 0 1px 2px rgba(0,0,0,0.05)
--shadow-md: 0 4px 6px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.05)
--shadow-lg: 0 10px 15px rgba(0,0,0,0.07), 0 4px 6px rgba(0,0,0,0.05)
--shadow-xl: 0 20px 25px rgba(0,0,0,0.1), 0 10px 10px rgba(0,0,0,0.04)
```

---

## 10. Design Deliverables Needed

1. **Logo vectorization**: SVG versions of current logo
2. **Color palette lock**: Final hex codes after designer review
3. **Typography specimens**: Font renderings with Cyrillic text
4. **Component library in Figma**:
   - All buttons (states: default, hover, active, disabled)
   - Product cards (default, hover, with badge)
   - Category cards
   - Form inputs (default, focus, error, success)
   - Navigation (desktop expanded, mobile collapsed)
   - Modals
5. **Page mockups**:
   - Homepage (desktop + mobile)
   - Product category (desktop + mobile)
   - Product detail (desktop + mobile)
   - About/Contact (desktop)
6. **Icon set**: Custom or selected library, all required icons
7. **Image treatment guidelines**: How product photos should be cropped, colored, displayed
