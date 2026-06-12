# Ujjawal Unnati Foundation — CMS (Laravel + Filament)

> NGO website for **Ujjawal Unnati Foundation** — women empowerment, cow protection, child
> labour eradication, education, and hunger-free India.
> Live: https://ujjawalunnati.com
> Admin: /admin

---

## Brand & Organisation Identity

| Field | Value |
|---|---|
| Organisation | Ujjawal Unnati Foundation |
| Tagline | Empowering Communities, Protecting Rights! |
| Address | Sector 12, Noida, Gautam Budh Nagar 201301, India |
| Phone | +91-8130789837 |
| Email | info@ujjawalunnati.com |
| Facebook | https://www.facebook.com/ujjawalunnati |
| YouTube | https://www.youtube.com/channel/UC2CLzRsHH2pkU_UHz3fjlYA |
| Cause | Women empowerment, Gau Sewa (Cow Care), Child labour, Education, Hunger |

### Real Stats (from live site)
| Key | Value | Label |
|---|---|---|
| supporters | 2500 | Supporters |
| cows_served | 22500 | Mother Cows Served |
| women_entrepreneurs | 115000 | Women Entrepreneurs |
| lives_transformed | 12000 | Lives Transformed |

---

## Tech Stack

- **PHP 8.3** / **Laravel 11** / **MySQL 8**
- **Filament 4** — Admin panel (namespace: `Filament\Schemas` for Schema/Tabs)
- **spatie/laravel-settings** — SiteSettings typed class
- **spatie/laravel-medialibrary** — All image uploads
- **spatie/laravel-permission** — Roles: super_admin, admin, editor, author
- **spatie/laravel-sluggable** — Auto slugs on Post, Service, Program, Cause

### Key Filament 4 Differences (DO NOT use Filament 3 syntax)
- `Filament\Schemas\Schema` (NOT `Filament\Forms\Form`)
- `Filament\Schemas\Components\Tabs` (NOT `Filament\Forms\Components\Tabs`)
- `SpatieMediaLibraryFileUpload` from `Filament\Forms\Components`

---

## Architecture

### Dynamic Content — Three Layers

```
Layer 1: SiteSettings        → Global: name, logo, phone, email, socials, nav, footer
Layer 2: PageSection         → Per-section: title, subtitle, body, image, button
Layer 3: Models              → CRUD data: Service, Program, Cause, TeamMember, etc.
```

**Rule: NOTHING is hardcoded. Every piece of text/link visible on the public site
must come from one of these three layers.**

### Global View Sharing (AppServiceProvider)
All views automatically receive:
- `$siteSettings` — SiteSettings instance
- `$sections` — Collection of all active PageSections, keyed as `"page.section_key"`
- `$navServices` — Top 4 active services (for header/footer nav)
- `$counters` — All SiteCounter records (for stats sections)

---

## Dynamic Navigation System (MUST IMPLEMENT)

The header navigation is currently **hardcoded** in `resources/views/components/header.blade.php`.
This MUST be made dynamic.

### Approach: NavigationItem Model

**Migration:** `create_navigation_items_table`
```sql
id, label (string), url (string nullable), route_name (string nullable),
route_params (json nullable), parent_id (FK nullable self),
target (enum: _self|_blank default _self),
order (int default 0), is_active (bool default true),
created_at, updated_at
```

**Model:** `app/Models/NavigationItem.php`
- `belongsTo` parent (self-referential)
- `hasMany` children
- `getHrefAttribute()` — returns `route(route_name)` if set, else `url`

**Filament Resource:** `app/Filament/Resources/NavigationItems/NavigationItemResource.php`
- Reorder with drag-and-drop
- Parent/child for dropdown menus
- NavigationGroup: 'Settings'

**AppServiceProvider:** Share nav globally
```php
View::composer('*', function ($view) {
    static $navItems = null;
    if ($navItems === null) {
        $navItems = NavigationItem::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('order')])
            ->orderBy('order')
            ->get();
    }
    $view->with('navItems', $navItems);
});
```

**header.blade.php** — Replace hardcoded menu with:
```blade
@foreach($navItems as $item)
    @if($item->children->isNotEmpty())
        <li class="nav-item submenu {{ ... }}">
            <a class="nav-link" href="#">{{ $item->label }}</a>
            <ul>
                @foreach($item->children as $child)
                    <li class="nav-item"><a class="nav-link" href="{{ $child->href }}">{{ $child->label }}</a></li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item {{ ... }}">
            <a class="nav-link" href="{{ $item->href }}">{{ $item->label }}</a>
        </li>
    @endif
@endforeach
```

### NavigationItem Seeder (actual UUF menu)
```
Home              → route: home
About Us          → route: about
Services          → route: services.index
Our Team          → route: team
Gallery           → route: gallery
Testimonials      → route: testimonials
Contact Us        → route: contact.index
Donate            → route: donation.index
```

---

## SiteSettings — Required Fields

`app/Settings/SiteSettings.php` — Add these missing fields:

```php
public string $youtube_url = '';
public string $whatsapp_number = '';
public string $footer_about_text = 'Ujjawal Unnati Foundation works tirelessly for the empowerment of communities across India.';
public string $footer_copyright = 'All Rights Reserved.';
public string $donate_button_text = 'Donate Now';
public string $donate_button_url = '/donation';
public string $hero_video_url = 'https://www.youtube.com/watch?v=Y-x0efG1seA';
```

Update `ManageSiteSettings.php` to expose these fields in the form under the right tabs.

### Settings Seeder — Real UUF Values
Update `database/settings/` migration to seed real values:
```
site_name       = Ujjawal Unnati Foundation
site_tagline    = Empowering Communities, Protecting Rights!
address         = Sector 12, Noida, Gautam Budh Nagar 201301, India
phone           = +91-8130789837
email           = info@ujjawalunnati.com
facebook_url    = https://www.facebook.com/ujjawalunnati
youtube_url     = https://www.youtube.com/channel/UC2CLzRsHH2pkU_UHz3fjlYA
instagram_url   = (get from client)
maps_embed_url  = Noida Sector 12 embed URL
admin_email     = deepak.kr@enterslice.com
```

---

## PageSection Keys — Complete Map

All sections below must exist in DB (seeded). Format: `page.section_key`

### Global (shared across all pages)
| Key | Used For |
|---|---|
| global.header | Phone label in header contact box |
| global.footer | Footer social heading, phone label, email label |
| global.footer_quick_links | Footer "Quick Links" heading |
| global.footer_services | Footer "Services" heading |
| global.footer_support | Footer "Support" heading + privacy URL |

### Home Page
| Key | Title | Subtitle | Body | Button |
|---|---|---|---|---|
| home.hero | Every life is important — we care for you | Welcome to UUF | Join us in empowering... | Donate Now → /donation |
| home.hero_features | Help Families In Need | Your gift can feed children | Education\nWomen Empowerment | — |
| home.about | United in compassion, changing lives | About Us | Driven by compassion... | About Us → /about |
| home.about_feature | Gau Sewa & Community Care | Providing care to cows and communities | — | — |
| home.services | Our Comprehensive Services | Services | We fight for rights... | — |
| home.causes | Supporting Community Causes | Our Causes | We focus on impactful causes... | — |
| home.programs | Empowering Our Programs | Our Program | Our programs create sustainable change... | — |
| home.counters | Our Impact | Impact Numbers | — | — |
| home.donate_cta | Donate Us | Donate Now | Your generous support enables our mission | — |
| home.testimonials | What People Say About Us | Testimonials | — | — |
| home.gallery | Our Image Gallery | Gallery | — | — |
| home.blog | Stories of Impact and Hope | Latest Post | Explore inspiring stories... | — |
| home.newsletter | Stay Connected With Us | Newsletter | Get updates on our work | — |

### About Page
| Key | Title | Subtitle | Body |
|---|---|---|---|
| about.hero | About Ujjawal Unnati Foundation | About Us | — |
| about.intro | Empowering Communities Since 2015 | Who We Are | We are a registered NGO working in UP/Delhi NCR region dedicated to women empowerment, cow protection, eradicating child labour, education for all, and fighting hunger in India. Our work touches thousands of lives every year through ground-level initiatives. |
| about.mission | Our Mission | Mission | To empower underprivileged women, protect cow rights, eliminate child labour, provide quality education, and ensure no one sleeps hungry. |
| about.vision | Our Vision | Vision | A society where every woman is empowered, every child is in school, every cow is safe, and every family has food on their plate. |
| about.values | Our Core Values | Values | Compassion • Integrity • Community • Action • Accountability |
| about.approach | Our Approach | How We Work | We work directly with communities through awareness drives, skill training, legal aid, and on-ground distribution campaigns. |
| about.facts | Impact Numbers | Our Facts | — |
| about.cta | Join Our Mission | Get Involved | Together we can build a better India. Volunteer, donate, or spread the word. |

### Services Page
| Key | Title | Subtitle |
|---|---|---|
| services.hero | Our Services | What We Do |
| services.intro | Comprehensive Community Services | Services |
| services.why_choose | Why Choose Us | Our Strength |

### Contact Page
| Key | Title | Subtitle | Body |
|---|---|---|---|
| contact.hero | Contact Us | Get In Touch | — |
| contact.intro | We'd Love to Hear From You | Contact | Reach out for volunteering, donations, partnerships, or any queries. |

### Team Page
| Key | Title |
|---|---|
| team.hero | Our Team |
| team.intro | The People Behind Our Mission |

### Gallery Page
| Key | Title |
|---|---|
| gallery.hero | Our Gallery |
| gallery.intro | Moments of Impact |

### Testimonials Page
| Key | Title |
|---|---|
| testimonials.hero | Testimonials |
| testimonials.intro | What Our Community Says |

### Donation Page
| Key | Title | Body |
|---|---|---|
| donation.hero | Make a Donation | — |
| donation.intro | Your Generosity Changes Lives | Every rupee donated goes directly to the people who need it most. |

### FAQ Page
| Key | Title |
|---|---|
| faqs.hero | Frequently Asked Questions |
| faqs.intro | Have Questions? We Have Answers |

---

## Model Data — Seeder Content (Real UUF Data)

### Services (6 services from live site)
1. **Advocacy for Women's Rights** — Fighting for legal rights, safety, and equal opportunities for women. We provide legal aid, counselling, and awareness.
2. **Protection of Cows (Gau Sewa)** — Running shelters for abandoned and injured cows. Providing medical care, feed, and shelter to thousands of cows.
3. **Child Labour Eradication** — Rescuing children from labour and bringing them back to school through rehabilitation and awareness programs.
4. **Women Empowerment** — Skill training, self-help groups, microfinance, and entrepreneurship support for women across UP and Delhi NCR.
5. **Education for Everyone** — Free tuition centres, notebook/stationary distribution, and scholarship support for underprivileged children.
6. **Fight for Hunger-Free India** — Regular ration distribution, food camps, and cooked meal drives for the homeless and destitute.

### Programs (4 programs)
1. **Gau Sewa Program** — Daily cow care, medical treatment, and fodder distribution at our gaushala. 22,500+ cows served.
2. **Women Entrepreneur Program** — 6-month skill training + microfinance support. 115,000+ women trained.
3. **Child Education Program** — Free coaching centres + school enrollment drives. Covers 50+ villages.
4. **Ration Distribution Drive** — Monthly ration kits to 500+ families. Runs during festivals and emergencies.

### Causes (3 causes with goals)
1. **Gau Sewa — Feed a Cow** — Goal: ₹10,00,000 | Raised: ₹3,64,950
2. **Education for Underprivileged Children** — Goal: ₹5,00,000 | Raised: ₹1,25,000
3. **Women Empowerment Fund** — Goal: ₹8,00,000 | Raised: ₹2,59,780

### Counters (real values)
| key | value | suffix | label |
|---|---|---|---|
| supporters | 2500 | + | Supporters |
| cows_served | 22500 | + | Mother Cows Served |
| women_entrepreneurs | 115000 | + | Women Entrepreneurs |
| lives_transformed | 12000 | + | Lives Transformed |

### Team Members (5 real members)
1. **Dipa Devi** — President — Founder and driving force of UUF. Has been working for women rights and cow protection for over 10 years.
2. **Deepak Kumar** — Secretary — Manages operations, finances, and digital outreach. Passionate about education and community development.
3. **Himanshu** — Volunteer Coordinator — Leads a network of 500+ volunteers across Noida and UP.
4. **Ravi Mishra** — Community Outreach Coordinator — Builds grassroots connections with villages and urban slums.
5. **Amit Kumar** — Volunteer Coordinator — Manages on-ground events, distribution drives, and cow shelter operations.

### Testimonials (4 real testimonials)
1. **Geeta Devi** (Partner, Child Education, Ghaziabad) — "Their expertise and dedication have been invaluable in advancing our shared goals. The foundation truly walks its talk."
2. **Sarita Chand** (Volunteer, Noida) — "Their team is passionate, knowledgeable, and genuinely cares about making a difference. It's an honour to volunteer here."
3. **Sunita Sharma** (Partner/Collaborator, Noida) — "They are truly dedicated to their mission with commitment to excellence and integrity. Proud to be associated."
4. **Dr Suraj Sharma** (Volunteer, Noida) — "Impressed by their professionalism, attention to detail, and transparency throughout. A model NGO."

### FAQ Categories & FAQs
**Category: General**
1. What is Ujjawal Unnati Foundation? — A registered NGO based in Noida working for women empowerment, cow protection, child welfare, education, and hunger eradication.
2. How can I volunteer? — Visit our Contact page or call +91-8130789837. We welcome volunteers for events, distribution drives, and awareness campaigns.
3. Is my donation tax-exempt? — Yes, donations to UUF are eligible for tax exemption under Section 80G of the Income Tax Act.

**Category: Donations**
1. How can I donate? — You can donate online via our Donation page using UPI, bank transfer, or card.
2. Where does my donation go? — 100% of donations go directly to programs: cow care, education, women empowerment, and ration distribution.
3. Can I donate for a specific cause? — Yes, you can select a specific cause (Gau Sewa, Education, Women Empowerment) when donating.

**Category: Programs**
1. Where do you operate? — Primarily in Noida, Gautam Budh Nagar, and surrounding districts of Uttar Pradesh.
2. How many cows do you care for? — We have served 22,500+ cows since our founding.
3. What kind of skill training do you provide? — Tailoring, beauty, handicrafts, digital literacy, and food processing.

### Gallery Categories
- **Gau Sewa** — Cow care and shelter activities
- **Education** — Coaching centres and notebook distribution
- **Ration Distribution** — Food/ration kit drives
- **Clothes Distribution** — Clothing drives in winter
- **Food Distribution** — Cooked meals and food camps
- **Women Empowerment** — Training and SHG activities

---

## Footer Dynamic Requirements

All footer sections are fed by `PageSection` and `SiteSettings`. Nothing hardcoded.

| Element | Source |
|---|---|
| Logo | `$siteSettings->logo_path` |
| Phone | `$siteSettings->phone` |
| Email | `$siteSettings->email` |
| About text | `$siteSettings->footer_about_text` |
| Social links | `$siteSettings->facebook_url`, `youtube_url`, `instagram_url` |
| Quick Links heading | `sections.get('global.footer_quick_links')->title` |
| Quick Links items | `$navItems` (NavigationItem model) OR hardcoded array |
| Services heading | `sections.get('global.footer_services')->title` |
| Services links | `$navServices` (top 4 active services) |
| Support heading | `sections.get('global.footer_support')->title` |
| Support links | PageSection button_url + hardcoded page routes |
| Copyright | `{{ date('Y') }} {{ $siteSettings->site_name }}. {{ $siteSettings->footer_copyright }}` |

---

## Image Requirements

All images go through **spatie/laravel-medialibrary**. No image paths in DB columns.

### Required images (upload to media library via Filament)
- Logo: `public/images/logo.svg` → replace with UUF logo PNG (200×60px)
- Footer Logo: same as header logo
- Hero background: striking community/NGO photo (1920×800px)
- About image 1 & 2: community work photos (800×600px each)
- Service icons: icon per service (SVG preferred, 64×64)
- Team member photos: square headshots (400×400px)
- Gallery images: actual event photos (800×600px, landscape)
- Program feature images: (800×500px)
- Cause images: (800×500px)

### Placeholder images strategy
Use Picsum/Unsplash-style URLs as `asset()` fallbacks in Blade templates until real images are uploaded.

---

## Missing Implementations (Priority Order)

### P0 — Must implement now

1. **NavigationItem model + migration + Filament resource + seeder** (header nav dynamic)
2. **Update SiteSettings** with `youtube_url`, `whatsapp_number`, `footer_about_text`, `footer_copyright`, `hero_video_url`
3. **Update all seeders** with real UUF content (PageSectionSeeder, SiteCounterSeeder, FaqCategorySeeder)
4. **Create database seeders** for: Services, Programs, Causes, TeamMembers, Testimonials, GalleryItems
5. **DonationReceiptMail** — `app/Mail/DonationReceiptMail.php` + update `DonationService::sendReceipt()`

### P1 — Implement next

6. **About page** — complete all sections (intro, mission, vision, values, approach, team preview, facts)
7. **Services show page** — complete content with features, FAQs, sidebar
8. **Programs show page** — complete content with timeline, why-choose, sidebar
9. **Blog** — at least 3 seeded posts about UUF work
10. **Footer navigation** — wire Quick Links to NavigationItem or PageSection

### P2 — Improve quality

11. **ContactMail** — upgrade from `Mail::raw()` to proper Mailable using `contact-notification.blade.php`
12. **NewsletterWelcomeMail** — implement Mailable using `newsletter-welcome.blade.php`
13. **ViewModels** — use `HomeViewModel`, `PostViewModel`, `ServiceViewModel` in controllers
14. **Observers** — add cache-clear logic in ServiceObserver, PostObserver
15. **Sitemap** — verify `GenerateSitemapCommand` schedule runs daily

---

## Blade Conventions

- `$sections->get('page.key')` — always use this pattern
- Always provide fallback: `?->title ?? 'default text'`
- Images: `$model->getFirstMediaUrl('conversion') ?: asset('images/fallback.jpg')`
- Never `@php` blocks in views (use controller/ViewModel for logic)
- Named routes always: `route('services.show', $service->slug)`
- All HTML from `body` field: `{!! $section->body !!}` (body stores rich HTML from Filament)

---

## Filament Admin Panel Structure

### Navigation Groups
| Group | Resources |
|---|---|
| Content | Posts, Services, Programs, Causes, Gallery Items |
| Community | Team Members, Testimonials, FAQs |
| Engagement | Donations, Contact Submissions, Newsletter Subscribers |
| Structure | Page Sections, Navigation Items |
| Settings | Site Settings, Manage Homepage |

### Admin Panel URL
- Path: `/admin`
- Default admin: `admin@lenity.org` / see AdminUserSeeder

---

## Dev Commands

```bash
# Start dev server
php artisan serve --host=0.0.0.0 --port=8080

# Run all migrations fresh + seed
php artisan migrate:fresh --seed

# Run specific seeder
php artisan db:seed --class=PageSectionSeeder
php artisan db:seed --class=NavigationItemSeeder

# Clear all caches
php artisan optimize:clear

# Generate sitemap
php artisan sitemap:generate

# Run tests
php artisan test
```

---

## Key Files Quick Reference

| What | Where |
|---|---|
| Global settings | `app/Settings/SiteSettings.php` |
| Manage settings (Filament) | `app/Filament/Pages/ManageSiteSettings.php` |
| Homepage manager | `app/Filament/Pages/ManageHomepage.php` |
| PageSection model | `app/Models/PageSection.php` |
| PageSection seeder | `database/seeders/PageSectionSeeder.php` |
| Counter seeder | `database/seeders/SiteCounterSeeder.php` |
| Header component | `resources/views/components/header.blade.php` |
| Footer component | `resources/views/components/footer.blade.php` |
| App layout | `resources/views/components/layouts/app.blade.php` |
| View sharing | `app/Providers/AppServiceProvider.php` |
| Repository bindings | `app/Providers/RepositoryServiceProvider.php` |
| Home page view | `resources/views/home/index.blade.php` |

---

## Rules (Non-Negotiable)

1. **ALL content dynamic** — no hardcoded strings in Blade except fallback defaults
2. **Navigation dynamic** — header menu comes from NavigationItem model
3. **Footer dynamic** — all links/text from SiteSettings or PageSection
4. **Real UUF content** — all seeders use actual Ujjawal Unnati Foundation data
5. **Images via media library** — never `src="{{ asset('images/hardcoded.jpg') }}"` for content images
6. **Filament 4 syntax only** — `Filament\Schemas\Schema`, `Filament\Schemas\Components\Tabs`
7. **No raw queries** — always Eloquent/Repository
8. **No `@php` blocks** in Blade views
9. **Named routes** always: `route('home')`, `route('services.show', $slug)`
10. **Test admin panel** after every resource change
