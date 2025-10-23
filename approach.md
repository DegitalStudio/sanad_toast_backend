# The Good Salad - Nutrition Label Project
## Implementation Plan - 3-4 Weeks

---

## Project Overview

**Goal:** Automate the generation and printing of QR codes containing nutritional information for each Toast POS order.

**Workflow:**
```
Toast Order → Laravel Backend (Calculate Nutrition + Generate QR) → Wix Website (Display to Customer)
```

**Complete System Flow:**
```
1. Customer orders via Toast/Incentivio
2. Toast sends webhook to Laravel
3. Laravel calculates nutrition (Base + ADD modifiers - REMOVE modifiers)
4. Laravel generates QR code → thegoodsalad.com/nutrition?order=ABC123
5. Printer Manager downloads QR code from dashboard
6. Customer scans QR code
7. Wix page displays nutrition info (powered by Laravel API)
```

---

## Technology Stack

**Backend (Laravel):**
- Laravel 11 with Vue.js (Inertia.js)
- MySQL 8.0
- Redis for caching and queues
- Laravel Cloud (Hosting - fully managed)

**Frontend:**
- Vue.js 3 (JavaScript - no TypeScript)
- Tailwind CSS
- Inertia.js for SPA experience

**Customer-Facing:**
- Wix website (thegoodsalad.com/nutrition)
- Wix Velo for dynamic content

**External Integrations:**
- Toast POS API (OAuth 2.0 + Webhooks)
- Incentivio (Toast online ordering platform)
- QR Code generation (SimpleSoftwareIO/simple-qrcode)
- Excel/CSV import/export

**Why Three Platforms:**
- **Toast**: Cannot be replaced - it's the client's POS system
- **Laravel**: Required because Wix cannot receive webhooks, handle OAuth 2.0, or do complex calculations
- **Wix**: Client's existing website - maintains brand consistency and customer trust

---

## User Roles (Simplified)

**Note:** Client requested simplified role system - no complex permissions needed.

### 1. ADMIN (Sanad & Management Team)
- Manage nutrition items (ingredients with nutritional values)
- Manage menu items and link to base ingredients
- Manage modifiers (ADD/REMOVE types)
- Import/export data from Excel/CSV
- View all orders and QR codes
- Download QR codes
- System statistics and reports

### 2. PRINTER MANAGER (Print Specialist) - Optional
- View all generated QR codes in dashboard
- Search/filter by date, customer, item, location
- Download/print QR codes directly
- Mark orders as printed/completed
- Mobile-responsive interface

**Implementation:** Simple role field in users table (admin/printer_manager). No complex permissions or ACL system needed.

---

## 3-4 Week Implementation Timeline

**Current Status:** Day 3 of Week 1 (Started 3 days ago)

**Access Confirmed:**
- ✅ GitHub repository access
- ✅ Wix account access (Developer Mode enabled)
- ✅ Laravel Cloud account access (cloud.laravel.com)
- ✅ Nutrition CSV available from Wix collection
- ⏳ Toast API approval pending

---

### **Week 1: Foundation & Authentication**
**Status: ✅ COMPLETED (Days 1-3)**

#### Days 1-3: Completed
- ✅ Laravel 11 project setup
- ✅ MySQL database configuration
- ✅ Laravel Breeze installation with Vue 3 + Inertia.js
- ✅ User authentication (register/login/logout)
- ✅ Basic role system (admin/printer_manager)
- ✅ Role-based middleware
- ✅ Admin dashboard UI (Vue component)
- ✅ Printer Manager dashboard UI (Vue component)
- ✅ GitHub repository initialized
- ✅ Project deployed to Laravel Cloud (development environment)

---

### **Week 2: Nutrition Data & Menu Management**
**Status: 🔄 IN PROGRESS (Days 4-10)**

**Goal:** Build complete admin system for managing nutrition data and menu items

#### Days 4-5: Database & CSV Import System
**Tasks:**
- Download nutrition CSV from Wix collection
- Analyze CSV structure (Item Name, Servings, Calories, Protein, Fat, Carbs, Fiber, Sodium, Sugar)
- Create database migrations:
  - `nutrition_items` (ingredients with nutritional values)
  - `menu_items` (Toast menu items)
  - `menu_item_ingredients` (pivot: base ingredients per menu item)
  - `modifiers` (ADD/REMOVE modifiers from Toast)
  - `modifier_ingredients` (pivot: ingredients affected by modifiers)
- Build CSV import functionality:
  - Upload CSV file through admin interface
  - Validate data (required fields, numeric values)
  - Bulk import to database
  - Error reporting for invalid rows
- Import real nutrition data from Wix CSV

**Deliverable:** Nutrition database populated with real data ✅

#### Days 6-8: Admin CRUD Interfaces
**Nutrition Items Management:**
- List all ingredients (table view with pagination)
- Search/filter by name, category
- Add new ingredient manually
- Edit ingredient (update nutrition values)
- Delete ingredient (with confirmation)
- Export to CSV/Excel
- Validation: ensure all nutrition fields are numeric and positive

**Menu Items Management:**
- List all menu items
- Add new menu item (name, description, category)
- Link base ingredients to menu item (multi-select interface)
- View ingredient composition for each menu item
- Edit/update menu items
- Delete menu items
- Categories: Salads, Bowls, Sides, etc.

**Modifiers System:**
- List all modifiers
- Create ADD modifier (links to ingredients to add)
- Create REMOVE modifier (links to ingredients to remove)
- Link modifiers to specific ingredients
- Edit/delete modifiers
- Test modifier logic with sample data

**Deliverable:** Complete admin panel for all nutrition management ✅

#### Days 9-10: Testing & Client Demo
**Tasks:**
- Test all CRUD operations thoroughly
- Create sample menu items (e.g., Blazing Bird Salad with base ingredients)
- Test modifiers (Add Tomato, Remove Avocado)
- Verify calculation logic manually
- Fix any bugs discovered
- Record demo video showing:
  - How to add/edit nutrition items
  - How to create menu items with ingredients
  - How to manage modifiers
  - How to import CSV data
- Send demo to client for feedback

**Deliverable:** Client can see and test admin panel functionality ✅

**Week 2 Milestones:**
- ✅ CSV import system working (future-proof for updates)
- ✅ All nutrition data imported
- ✅ Admin can manage ingredients, menu items, and modifiers
- ✅ Foundation ready for Toast integration

---

### **Week 3: Toast Integration & Calculation Engine**
**Status: ⏳ PENDING (Days 11-17)**

**Prerequisites:**
- ✅ Week 2 nutrition database complete
- ⏳ Toast API approval received (waiting)

**Goal:** Connect Toast API, receive orders automatically, and calculate nutrition with QR generation

#### Days 11-12: Toast OAuth & API Connection
**Tasks:**
- Implement Toast OAuth 2.0 authentication flow:
  - Authorization endpoint redirect
  - Token exchange on callback
  - Refresh token mechanism (tokens expire)
- Store access/refresh tokens securely in database (encrypted)
- Create Toast API service class for all API calls
- Test API connectivity with Toast sandbox environment
- Fetch restaurant locations from Toast API
- Fetch menu items from Toast API and sync to database
- Error handling and logging for API failures
- Retry logic for failed API calls

**Deliverable:** Successfully connected to Toast API with working OAuth ✅

#### Days 13-14: Webhook Implementation
**Tasks:**
- Create webhook endpoint: `POST /api/webhooks/toast`
- Implement webhook signature verification (security - validate requests are from Toast)
- Parse incoming order JSON payload:
  - Extract customer name
  - Extract dining option (dine-in, takeout, delivery)
  - Extract order date/time
  - Extract location
  - Extract items with modifiers (ADD/REMOVE)
- Create database tables:
  - `toast_orders` (store full order details)
  - `order_items` (individual items in each order)
  - `toast_webhooks` (log all webhook events for debugging)
- Implement queue system using Redis:
  - Webhook receives order → queue job
  - Background job processes order asynchronously
  - Prevents timeout issues (Toast webhooks have 30s timeout)
- Error handling:
  - Log failed webhooks
  - Alert admin on failures
  - Retry mechanism for transient errors

**Deliverable:** Orders flowing automatically from Toast to Laravel ✅

#### Days 15-17: Nutrition Calculation Engine & QR Generation
**Tasks:**
- Build Nutrition Calculator Service:

  **Algorithm:**
  ```
  1. Get menu item from order
  2. Fetch base ingredients for menu item
  3. Parse modifiers from order:
     - Identify ADD modifiers → get ingredients to add
     - Identify REMOVE modifiers → get ingredients to remove
  4. Build final ingredient list:
     - Start with base ingredients
     - Add ingredients from ADD modifiers
     - Remove ingredients from REMOVE modifiers
  5. Calculate nutrition:
     - Sum calories from all final ingredients
     - Sum protein, fat, carbs, fiber, sodium, sugar
     - Round to appropriate decimal places
  6. Store calculation in database
  ```

  **Example (Blazing Bird Salad):**
  ```
  Base: Romaine, Chipotle Ranch, Chicken, Avocado, Crispy Onion, Pico
  + ADD: Tomato (20 cal), Croutons (152 cal)
  - REMOVE: Avocado (160 cal)
  = Final: 757 calories, 39g protein, 36g fat, 76g carbs, 11g fiber, 1520mg sodium, 11g sugar
  ```

- Handle edge cases:
  - Missing ingredient data (log warning, exclude from calculation)
  - Invalid modifiers (log and skip)
  - Multiple quantities (multiply nutrition values)

- Generate unique order URLs:
  - Format: `thegoodsalad.com/nutrition?order={unique_id}`
  - Use UUID or hash for security (prevent guessing)

- QR Code Generation:
  - Install package: `composer require simplesoftwareio/simple-qrcode`
  - Generate QR code PNG image (300x300px)
  - Store in `storage/app/qr-codes/{order_id}.png`
  - Save file path to database
  - Make accessible via download endpoint

- Create database table:
  - `nutrition_calculations` (order_item_id, ingredients_json, nutrition_json, qr_code_path, url)

- Unit testing:
  - Test calculation with various modifier combinations
  - Test edge cases (all removed, all added, no modifiers)
  - Verify accuracy with known examples

**Deliverable:** Complete automated pipeline - Order → Calculation → QR Code ✅

**Week 3 Milestones:**
- ✅ Toast API integrated and authenticated
- ✅ Webhooks receiving real orders automatically
- ✅ Nutrition calculated accurately for all order types
- ✅ QR codes generated and stored
- ✅ System ready for customer-facing integration

---

### **Week 4: Wix Integration, Dashboards & Launch**
**Status: ⏳ PENDING (Days 18-24)**

**Prerequisites:**
- ✅ Week 3 complete (QR codes generating)
- ✅ Laravel API endpoints ready

**Goal:** Connect Wix, finalize dashboards, deploy to production, and go live

#### Days 18-19: Wix Integration & Customer Display Page
**Tasks:**
- Create Wix page: `thegoodsalad.com/nutrition`
- Enable Wix Developer Mode (Velo)

**Wix Velo Code (JavaScript):**
```javascript
import wixLocation from 'wix-location';
import { fetch } from 'wix-fetch';

$w.onReady(function () {
    const orderId = wixLocation.query.order;

    if (!orderId) {
        $w('#errorMessage').text = 'Invalid QR code';
        return;
    }

    // Call Laravel API
    const apiUrl = 'https://api.thegoodsalad.com/api/nutrition/' + orderId;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Display order info
            $w('#orderNumber').text = data.order_number;
            $w('#customerName').text = data.customer_name;
            $w('#orderDate').text = data.order_date;
            $w('#location').text = data.location;

            // Display item and nutrition
            $w('#itemName').text = data.items[0].name;
            $w('#calories').text = data.items[0].nutrition.calories;
            $w('#protein').text = data.items[0].nutrition.protein + 'g';
            $w('#fat').text = data.items[0].nutrition.fat + 'g';
            $w('#carbs').text = data.items[0].nutrition.carbs + 'g';
            $w('#fiber').text = data.items[0].nutrition.fiber + 'g';
            $w('#sodium').text = data.items[0].nutrition.sodium + 'mg';
            $w('#sugar').text = data.items[0].nutrition.sugar + 'g';

            // Display ingredients and modifiers
            // ... (additional code for ingredients list)
        })
        .catch(error => {
            $w('#errorMessage').text = 'Unable to load nutrition information';
            console.error(error);
        });
});
```

**Laravel API Endpoint:**
```php
// routes/api.php
Route::get('/nutrition/{orderId}', [NutritionController::class, 'show']);

// Controller returns:
{
  "order_number": "12345",
  "customer_name": "John Smith",
  "order_date": "March 15, 2025 2:30 PM",
  "location": "Los Altos",
  "items": [
    {
      "name": "Blazing Bird Salad",
      "base_ingredients": [...],
      "modifiers": {
        "added": ["Tomato", "Croutons"],
        "removed": ["Avocado"]
      },
      "final_ingredients": [...],
      "nutrition": {
        "calories": 757,
        "protein": 39,
        "fat": 36,
        "carbs": 76,
        "fiber": 11,
        "sodium": 1520,
        "sugar": 11
      }
    }
  ]
}
```

**Design Tasks:**
- Design beautiful nutrition facts label (FDA format)
- Mobile-first responsive design
- Add The Good Salad logo and branding
- Color scheme matching main website
- Loading states and error handling
- Test on iPhone, Android, tablets

**CORS Configuration:**
- Configure Laravel to allow requests from thegoodsalad.com
- Set up proper CORS headers

**Deliverable:** Working Wix page that displays nutrition beautifully ✅

#### Days 20-21: Printer Manager Dashboard & Admin Enhancements
**Printer Manager Dashboard:**
- Real-time order list (auto-refresh every 30 seconds)
- Search functionality:
  - By customer name
  - By order date range
  - By location
  - By menu item
- Filter options:
  - Printed / Not printed
  - Today / This week / Custom range
- Pagination (20 orders per page)
- Download individual QR code (PNG download)
- Bulk download (select multiple → download ZIP)
- Mark as printed checkbox (updates status)
- Print preview modal
- Mobile-responsive table

**Admin Dashboard Enhancements:**
- Order statistics:
  - Total orders today/week/month
  - Total QR codes generated
  - Most popular items
  - Orders by location (chart)
- System health monitoring:
  - Last webhook received timestamp
  - Failed webhooks count
  - Database status
- Quick actions:
  - Refresh Toast menu items
  - Re-generate failed QR codes
  - Export all orders to Excel
- User management:
  - Simple list of users
  - Add/edit/delete users
  - Reset passwords

**Deliverable:** Complete operational dashboards ✅

#### Day 22: Deployment to Production
**Tasks:**
- Deploy to Laravel Cloud (production):
  1. Push code to GitHub main branch
  2. Connect repository to Laravel Cloud
  3. Configure environment variables:
     - APP_ENV=production
     - APP_DEBUG=false
     - DB credentials (auto-provisioned)
     - TOAST_CLIENT_ID, TOAST_CLIENT_SECRET
     - REDIS_HOST (auto-provisioned)
     - QUEUE_CONNECTION=redis
  4. Run migrations: `php artisan migrate --force`
  5. Seed initial admin user
  6. Test deployment

- Configure custom domain (optional):
  - Point `api.thegoodsalad.com` to Laravel Cloud
  - Or use Laravel Cloud subdomain: `thegoodsalad.laravel.app`

- SSL certificate:
  - Automatic on Laravel Cloud (Let's Encrypt)

- Set up automatic backups:
  - Daily database backups (Laravel Cloud feature)
  - QR code storage backups

- Configure queue worker:
  - Laravel Cloud automatically runs queue workers
  - Set queue to process webhook jobs

**Deliverable:** Live production system running on Laravel Cloud ✅

#### Days 23-24: Testing, Training & Go Live
**End-to-End Testing:**
1. Place test order on Toast:
   - Order: Blazing Bird Salad + Add Tomato + Remove Avocado
2. Verify webhook received in Laravel logs
3. Check database for order record
4. Verify nutrition calculation is correct (757 cal, 39g protein, etc.)
5. Verify QR code generated and stored
6. Download QR code from printer dashboard
7. Print QR code on label
8. Scan QR code with phone
9. Verify Wix page loads correctly
10. Verify nutrition info displays correctly
11. Test on multiple devices (iPhone, Android, tablet)

**Performance Testing:**
- Simulate 100 concurrent orders (load testing)
- Verify response time < 30 seconds
- Check memory usage
- Verify queue processes all jobs
- Test error recovery (simulate Toast downtime)

**Create Documentation:**
1. **Admin User Guide:**
   - How to add/edit nutrition items
   - How to create menu items with ingredients
   - How to manage modifiers
   - How to import CSV data
   - How to download QR codes
   - Troubleshooting common issues

2. **Printer Manager Guide:**
   - How to log in
   - How to search for orders
   - How to download QR codes
   - How to mark orders as printed
   - How to bulk download

3. **Technical Documentation:**
   - System architecture diagram
   - Database schema
   - API endpoints
   - Toast webhook format
   - Deployment instructions

**Client Training Session (Video Call):**
- Walk through admin panel
- Demonstrate adding new ingredient
- Show how to upload CSV
- Explain modifier system
- Show printer manager dashboard
- Answer questions
- Provide login credentials

**Go Live Checklist:**
- ✅ All tests passing
- ✅ Documentation complete
- ✅ Client trained
- ✅ Production monitoring set up
- ✅ Support plan communicated
- ✅ Backup system verified

**🚀 GO LIVE!**

**Deliverable:** System fully operational, client trained, and ready for real customers ✅

**Week 4 Milestones:**
- ✅ Customers can scan QR and see nutrition on thegoodsalad.com
- ✅ Printer manager can download and print QR codes
- ✅ Admin can manage all data independently
- ✅ System is live and processing real orders
- ✅ Client is trained and confident

---

## Example Workflow: Blazing Bird Salad

**Order Received from Toast:**
- Blazing Bird Salad
- ADD Tomato
- ADD Croutons
- REMOVE Avocado

**System Processing:**

1. **Base Ingredients** (from database):
   - Romaine Lettuce
   - Chipotle Ranch Dressing
   - Chicken
   - Avocado
   - Crispy Onion
   - Pico De Gallo

2. **Apply Modifiers:**
   - ADD: Tomato, Croutons
   - REMOVE: Avocado

3. **Final Ingredients:**
   - Romaine Lettuce
   - Chipotle Ranch Dressing
   - Chicken
   - Crispy Onion
   - Pico De Gallo
   - Tomato
   - Croutons

4. **Calculate Nutrition:**
   - Calories: 757
   - Protein: 39g
   - Fat: 36g
   - Carbs: 76g
   - Fiber: 11g
   - Sodium: 1520mg
   - Sugar: 11g

5. **Generate:**
   - Webpage: `https://yourdomain.com/nutrition/order123/item456`
   - QR Code: Stored and ready for download

---

## Database Structure

### Core Tables

1. **users** - Admin and Printer Manager accounts
2. **nutrition_items** - All ingredients with nutritional values
3. **menu_items** - All menu items from Toast
4. **menu_item_ingredients** - Base ingredients for each menu item (pivot)
5. **modifiers** - All modifiers from Toast
6. **modifier_ingredients** - Ingredients affected by modifiers (pivot)
7. **toast_orders** - Orders received from Toast API
8. **order_items** - Individual items in each order
9. **nutrition_calculations** - Calculated nutrition + QR codes
10. **toast_webhooks** - Log all webhook events
11. **audit_logs** - Track all changes (who, what, when)

---

## Required from Client

### 1. Toast Account Details
- Restaurant name and all locations
- Toast admin account credentials
- Sample menu data

### 2. Initial Data (Week 2)
- Nutrition data in Excel/CSV format
  - All ingredients with nutritional values
  - Format: Item Name, Serving Size, Calories, Protein, Fat, Carbs, Fiber, Sodium, Sugar
- Menu items with base ingredients
- List of all possible modifiers

### 3. Hosting & Domain (Week 4)
- Hosting provider (we can recommend)
- Domain name for the application
- SSL certificate (or use Let's Encrypt free)

### 4. User Accounts
- Admin user details (name, email)
- Printer manager user details (name, email)

---

## Deliverables

### Complete Laravel + Vue Application
- Admin panel for nutrition & menu management
- Printer manager dashboard for QR codes
- Toast API integration with webhooks
- Automated nutrition calculation engine
- QR code generation system
- Excel/CSV import/export
- Role-based access control
- Audit logging
- Mobile-responsive design

### Documentation
- Admin user guide
- Printer manager user guide
- Technical documentation
- API integration guide
- Deployment guide

### Source Code
- GitHub repository
- Complete migrations and seeders
- Environment configuration examples
- Automated tests

### Deployment Support
- Production server setup assistance
- Database configuration
- SSL certificate setup
- Initial data migration

---

## Key Features Summary

✅ **Week 1 (COMPLETED):**
- User authentication & authorization
- Role-based dashboards (Admin & Printer Manager)
- Database foundation

🔄 **Week 2 (Upcoming):**
- Full nutrition & menu management
- Excel import/export
- Modifier system

🔄 **Week 3 (Upcoming):**
- Toast API integration
- Webhook processing
- Nutrition calculation engine

🔄 **Week 4 (Upcoming):**
- QR code generation
- Enhanced printer dashboard
- Testing & deployment

---

## Success Metrics

- ✅ **Processing Time**: < 30 seconds from order to QR code
- ✅ **Accuracy**: 100% correct nutrition calculations
- ✅ **Uptime**: 99.9% availability
- ✅ **User Experience**: Easy for both admin and printer manager
- ✅ **Data Integrity**: Zero data loss
- ✅ **Scalability**: Handle 1000+ orders/day

---

## Project Timeline Summary

**Total Duration:** 3-4 weeks (24 days)

**Current Status (Day 3):**
- ✅ Week 1: COMPLETED (Days 1-3)
- 🔄 Week 2: IN PROGRESS (Days 4-10)
- ⏳ Week 3: Pending Toast API approval (Days 11-17)
- ⏳ Week 4: Final integration & launch (Days 18-24)

**Weekly Milestones:**
- **Week 1:** ✅ Authentication & dashboards working
- **Week 2:** Admin can manage all nutrition data
- **Week 3:** Orders flow from Toast → QR codes generated
- **Week 4:** 🚀 GO LIVE - Customers can scan QR codes

**Risk Factors:**
- Toast API approval delay (mitigated by working on Week 2 first)
- Wix Velo limitations (mitigated by testing API early)
- Data quality issues (mitigated by CSV validation)

**Acceleration Opportunities:**
- If Toast API approves early, can start Week 3 sooner
- Simple role system saves development time
- Laravel Cloud deployment is fast (no VPS setup needed)

**Expected Completion:** End of Week 3 to Week 4 (21-24 days from start)
