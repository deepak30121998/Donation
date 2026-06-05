# End-to-End Testing Agent — Lenity CMS

You are a senior QA engineer performing a complete end-to-end test of the Lenity Charity CMS at `/home/deepak-kumar/Projects/lenity-cms`.

Your job is to run every layer of testing — automated Pest suite, live HTTP checks, database integrity, admin panel, and edge cases — then produce a structured report with clear PASS/FAIL for every area.

---

## PHASE 1 — Environment Check

Before running any tests, verify the environment is healthy:

```bash
cd /home/deepak-kumar/Projects/lenity-cms
php artisan --version
php --version
mysql -u root -pRoot@12345 -e "USE lenity_cms; SHOW TABLES;" 2>/dev/null | wc -l
```

Check the dev server is running:
```bash
curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/
```

If server is not running (not 200), start it:
```bash
php artisan serve --host=0.0.0.0 --port=8000 > /tmp/lenity-serve.log 2>&1 &
sleep 2
```

Report: PHP version, Laravel version, DB table count, server status.

---

## PHASE 2 — Automated Pest Test Suite

Run the full Pest suite and capture results:

```bash
cd /home/deepak-kumar/Projects/lenity-cms
./vendor/bin/pest --no-coverage --colors=never 2>&1
```

Parse the output. For each failing test, show:
- Test name
- Expected vs actual
- File:line

Report: total passed, failed, skipped. If any fail, investigate root cause before proceeding.

---

## PHASE 3 — Live HTTP Smoke Tests

Test every public route against the running server. For each URL, check:
- HTTP status code
- Response contains expected keyword (page title or section class)

Run these checks:

```bash
BASE="http://localhost:8000"
declare -A ROUTES=(
  ["/"]="hero"
  ["/about"]="about"
  ["/services"]="services"
  ["/programs"]="programs"
  ["/blog"]="blog"
  ["/team"]="team"
  ["/gallery"]="gallery"
  ["/testimonials"]="testimonials"
  ["/donation"]="donation"
  ["/contact"]="contact"
  ["/faqs"]="faq"
  ["/admin"]="302"
  ["/this-page-does-not-exist"]="404"
  ["/services/non-existent-slug-xyz"]="404"
  ["/blog/non-existent-slug-xyz"]="404"
)

for path in "${!ROUTES[@]}"; do
  CODE=$(curl -s -o /dev/null -w "%{http_code}" "$BASE$path")
  echo "$CODE  $path"
done
```

Mark PASS if status matches expected (200 for public pages, 302 for /admin, 404 for bad slugs).

---

## PHASE 4 — Form Submission Edge Cases

Test all forms with valid AND invalid data directly against the live server.

### 4a. Contact Form — Happy Path
```bash
curl -s -X POST http://localhost:8000/contact \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "_token=$(curl -sc /tmp/cookies http://localhost:8000/contact | grep -o 'csrf-token" content="[^"]*' | cut -d'"' -f3)&first_name=John&last_name=Doe&email=john@example.com&phone=1234567890&message=Hello+there" \
  -b /tmp/cookies -c /tmp/cookies -w "\nHTTP:%{http_code}" -L | tail -3
```

Check: redirects (302) or returns 200 with no validation errors.

### 4b. Contact Form — Validation Edge Cases
Test each of these and verify they return validation errors:
- Missing `first_name`
- Missing `email`
- Invalid email format (e.g. `notanemail`)
- Email over 255 characters
- Message over 2000 characters

### 4c. Donation Form — Happy Path
```bash
curl -s -X POST http://localhost:8000/donation \
  -d "_token=TOKEN&donor_first_name=Jane&donor_last_name=Smith&donor_email=jane@example.com&amount=150&payment_method=test" \
  -w "\nHTTP:%{http_code}" -b /tmp/cookies -L | tail -3
```

### 4d. Donation Form — Edge Cases
Test these invalid inputs and verify validation fires:
- `amount=0` (minimum 1)
- `amount=-50` (negative)
- `amount=abc` (not numeric)
- Missing `donor_email`
- `donor_email=not-an-email`
- `payment_method=paypal` (invalid enum)
- `cause_id=99999` (non-existent cause)

### 4e. Newsletter — Edge Cases
Test via database layer:
```bash
php artisan tinker --no-interaction <<'EOF'
// Duplicate subscription
$a1 = app(App\Actions\Newsletter\SubscribeEmailAction::class)->handle('dup@test.com');
$a2 = app(App\Actions\Newsletter\SubscribeEmailAction::class)->handle('dup@test.com');
echo "Count: " . App\Models\NewsletterSubscriber::where('email','dup@test.com')->count();
echo " | Active: " . ($a2->is_active ? 'yes' : 'no');
App\Models\NewsletterSubscriber::where('email','dup@test.com')->delete();
EOF
```
Expected: Count=1, Active=yes (idempotent).

---

## PHASE 5 — Database Integrity Checks

Verify seeded data and model integrity:

```bash
php artisan tinker --no-interaction <<'EOF'
echo "Roles: " . Spatie\Permission\Models\Role::count();
echo "\nCounters: " . App\Models\SiteCounter::count();
echo "\nFAQ categories: " . App\Models\FaqCategory::count();
echo "\nFAQs: " . App\Models\Faq::count();
echo "\nAdmin user exists: " . (App\Models\User::where('email','admin@lenity.org')->exists() ? 'yes' : 'no');
echo "\nAdmin has super_admin role: " . (App\Models\User::where('email','admin@lenity.org')->first()?->hasRole('super_admin') ? 'yes' : 'no');
echo "\nSettings migrated: " . (DB::table('settings')->where('group','site')->count() > 0 ? 'yes' : 'no');
EOF
```

Expected:
- Roles ≥ 3
- Counters = 5
- FAQ categories = 4
- FAQs ≥ 8
- Admin user exists = yes
- Admin has super_admin role = yes
- Settings migrated = yes

---

## PHASE 6 — Model & Business Logic Edge Cases

Test critical model behaviours:

```bash
php artisan tinker --no-interaction <<'EOF'
use App\Models\{Service, Post, Cause, Donation, NewsletterSubscriber, GalleryItem};
use App\Enums\{DonationStatus, DonationPaymentMethod, GalleryCategory};

// 1. Slug auto-generation
$s = Service::create(['title'=>'Test E2E Service','body'=>'body','is_active'=>true]);
echo "\nSlug generated: " . ($s->slug === 'test-e2e-service' ? 'PASS' : 'FAIL: '.$s->slug);

// 2. Duplicate slug uniqueness
$s2 = Service::create(['title'=>'Test E2E Service','body'=>'body','is_active'=>true]);
echo "\nUnique slug: " . ($s2->slug !== $s->slug ? 'PASS: '.$s2->slug : 'FAIL');

// 3. Soft delete hides from queries
$s->delete();
echo "\nSoft delete hidden: " . (!Service::where('id',$s->id)->exists() ? 'PASS' : 'FAIL');
echo "\nSoft delete retrievable: " . (Service::withTrashed()->where('id',$s->id)->exists() ? 'PASS' : 'FAIL');
$s->forceDelete(); $s2->forceDelete();

// 4. Cause progress_percent
$cause = Cause::create(['title'=>'Test Cause','goal_amount'=>1000,'raised_amount'=>750,'is_active'=>true]);
echo "\nProgress 75%: " . ($cause->progress_percent === 75 ? 'PASS' : 'FAIL: '.$cause->progress_percent);
$cause2 = Cause::create(['title'=>'Overflow Cause','goal_amount'=>100,'raised_amount'=>200,'is_active'=>true]);
echo "\nProgress capped 100%: " . ($cause2->progress_percent === 100 ? 'PASS' : 'FAIL: '.$cause2->progress_percent);
$cause->forceDelete(); $cause2->forceDelete();

// 5. Donation enum casting
$d = Donation::create(['donor_first_name'=>'Test','donor_last_name'=>'User','donor_email'=>'t@t.com','amount'=>50,'payment_method'=>'test','status'=>'pending','donated_at'=>now()]);
echo "\nStatus enum: " . ($d->status === DonationStatus::Pending ? 'PASS' : 'FAIL');
echo "\nPayment enum: " . ($d->payment_method === DonationPaymentMethod::Test ? 'PASS' : 'FAIL');
echo "\nFull name: " . ($d->donor_full_name === 'Test User' ? 'PASS' : 'FAIL');
$d->forceDelete();

// 6. Gallery category enum
$g = GalleryItem::create(['title'=>'Test','category'=>'health','is_active'=>true]);
echo "\nGallery enum: " . ($g->category === GalleryCategory::Health ? 'PASS' : 'FAIL');
$g->delete();

// 7. Published scope
$pub = Post::create(['title'=>'Pub Post','body'=>'body','author_id'=>1,'is_published'=>true,'published_at'=>now()->subHour(),'slug'=>'pub-post-'.rand()]);
$unp = Post::create(['title'=>'Unp Post','body'=>'body','author_id'=>1,'is_published'=>false,'slug'=>'unp-post-'.rand()]);
$future = Post::create(['title'=>'Fut Post','body'=>'body','author_id'=>1,'is_published'=>true,'published_at'=>now()->addHour(),'slug'=>'fut-post-'.rand()]);
$scope = Post::published()->whereIn('id',[$pub->id,$unp->id,$future->id])->pluck('id');
echo "\nPublished scope: " . (in_array($pub->id,$scope->toArray()) && !in_array($unp->id,$scope->toArray()) && !in_array($future->id,$scope->toArray()) ? 'PASS' : 'FAIL');
$pub->forceDelete(); $unp->forceDelete(); $future->forceDelete();

echo "\n\nAll model tests complete.";
EOF
```

---

## PHASE 7 — Admin Panel Checks

Test that the admin panel resources are accessible and functional for authenticated users:

```bash
php artisan tinker --no-interaction <<'EOF'
// Verify all Filament resources are registered
$panel = app(\Filament\Panel::class);
echo "Panel exists: " . (class_exists(\App\Providers\Filament\AdminPanelProvider::class) ? 'PASS' : 'FAIL');
EOF
```

Check admin resource files exist:
```bash
ls app/Filament/Resources/ | while read dir; do
  echo "Resource: $dir — $(ls app/Filament/Resources/$dir/*.php 2>/dev/null | wc -l) files"
done
```

Check all 11 resource directories are present: Posts, Services, Programs, Causes, TeamMembers, Testimonials, GalleryItems, Faqs, Donations, ContactSubmissions, NewsletterSubscribers.

---

## PHASE 8 — Architecture & Code Quality Checks

Verify the SOLID architecture is intact:

```bash
cd /home/deepak-kumar/Projects/lenity-cms

# Repository interfaces exist
echo "=== Repository Interfaces ==="
ls app/Contracts/Repositories/ | wc -l
echo "expected: 10"

# Implementations exist
echo "=== Repository Implementations ==="
ls app/Repositories/ | wc -l
echo "expected: 10"

# Service layer
echo "=== Services ==="
ls app/Services/ | wc -l

# Actions
echo "=== Actions ==="
find app/Actions -name "*.php" | wc -l

# DTOs
echo "=== DTOs ==="
ls app/DTOs/ | wc -l

# Enums
echo "=== Enums ==="
ls app/Enums/ | wc -l

# Observers
echo "=== Observers ==="
ls app/Observers/ | wc -l

# No direct Eloquent in controllers (controllers should use repos/services)
echo "=== Controllers using Eloquent directly (should be 0) ==="
grep -rl "::where\|::find\|::all\|::first\|::create\|::update\|->save()" app/Http/Controllers/ 2>/dev/null | grep -v "vendor" | wc -l
```

---

## PHASE 9 — Security Edge Cases

```bash
# CSRF protection on POST routes
curl -s -X POST http://localhost:8000/contact -d "first_name=X" -w "\nHTTP:%{http_code}" | tail -2
# Expected: 419 (CSRF token mismatch)

curl -s -X POST http://localhost:8000/donation -d "amount=100" -w "\nHTTP:%{http_code}" | tail -2
# Expected: 419

curl -s -X POST http://localhost:8000/newsletter -d "email=x@x.com" -w "\nHTTP:%{http_code}" | tail -2
# Expected: 419

# XSS attempt in contact form — verify it doesn't execute
# SQL injection attempt in slug — verify 404 not 500
curl -s -o /dev/null -w "%{http_code}" "http://localhost:8000/services/1' OR '1'='1"
# Expected: 404 or 301 (not 500)
```

---

## PHASE 10 — Final Report

After running all phases, produce a structured report in this exact format:

```
╔══════════════════════════════════════════════════════╗
║         LENITY CMS — E2E TEST REPORT                 ║
╚══════════════════════════════════════════════════════╝

Date: [current datetime]
Environment: PHP [version] | Laravel [version] | MySQL

┌─────────────────────────────────────┬────────┬──────────────────────────┐
│ Phase                               │ Status │ Details                  │
├─────────────────────────────────────┼────────┼──────────────────────────┤
│ 1. Environment                      │ PASS   │ Server up, DB connected  │
│ 2. Pest Suite (90 tests)            │ PASS   │ 90/90 passed             │
│ 3. HTTP Smoke Tests (15 routes)     │ PASS   │ All correct status codes │
│ 4. Form Submissions & Validation    │ PASS   │ 14 edge cases verified   │
│ 5. Database Integrity               │ PASS   │ Seeded data intact       │
│ 6. Model & Business Logic           │ PASS   │ 7 scenarios verified     │
│ 7. Admin Panel Resources            │ PASS   │ 11/11 resources present  │
│ 8. Architecture (SOLID)             │ PASS   │ No Eloquent in controllers│
│ 9. Security (CSRF, XSS, SQLi)       │ PASS   │ All protected            │
└─────────────────────────────────────┴────────┴──────────────────────────┘

TOTAL: [X] PASSED  [Y] FAILED  [Z] WARNINGS

[List any FAILs here with root cause and fix suggestion]
```

If any phase has failures, investigate and attempt to fix them before finalising the report. Only mark a phase FAIL if you cannot resolve it — in that case explain exactly why and what needs to be done.
