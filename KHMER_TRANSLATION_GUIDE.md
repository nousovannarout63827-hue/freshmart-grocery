# Khmer Translation Implementation Guide

## ✅ Completed Translations

### Language Files Updated
All three language files have been updated with comprehensive translations:

1. **`lang/en/messages.php`** - English (Base language)
2. **`lang/km/messages.php`** - Khmer (ភាសាខ្មែរ) 
3. **`lang/zh/messages.php`** - Chinese (中文)

### Translation Categories

#### Navigation (15 keys)
- home, shop, about, contact, cart, wishlist, login, register, logout, profile, orders, etc.

#### Hero Section (8 keys)
- fresh_groceries, delivered, shop_now, browse_categories, fresh_organic_groceries_delivered, etc.

#### Products (15 keys)
- products, categories, add_to_cart, view_details, product_details, description, reviews, etc.

#### Cart (25 keys)
- your_cart, cart_empty, continue_shopping, subtotal, shipping, total, checkout, etc.

#### Checkout (15 keys)
- delivery_address, first_name, last_name, email, phone, address, city, postal_code, etc.

#### Order Status (8 keys)
- pending, preparing, ready_for_pickup, out_for_delivery, arrived, delivered, cancelled

#### Messages (8 keys)
- success, error, warning, product_added, cart_updated, order_placed, not_enough_stock

#### Search & Filter (10 keys)
- search, filter, sort_by, price_asc, price_desc, name_asc, name_desc, latest, rating

#### Home Page (30+ keys)
- browse_by_category, shop_by_category, why_choose_us, fast_delivery, 100_organic, etc.

#### About Page (10 keys)
- about_us, our_story, our_mission, our_values, our_team, about_freshmart, etc.

#### Contact Page (15 keys)
- contact_us, get_in_touch, send_message, name, subject, message, opening_hours, etc.

#### Shop Page (8 keys)
- all_products, showing, of, results, no_products_found, per_page, etc.

#### Product Detail (10 keys)
- price, availability, in_stock, out_of_stock, quantity, add_to_wishlist, sku, category

#### Orders (15 keys)
- my_orders, order_history, order_date, order_number, status, total_amount, actions, etc.

#### Profile (12 keys)
- my_profile, account_settings, personal_information, change_password, notifications, etc.

#### Authentication (15 keys)
- sign_in, sign_up, remember_me, forgot_password, reset_password, create_account, etc.

#### Admin Section (30+ keys)
- admin_dashboard, inventory, manage_products, add_product, edit_product, orders, etc.

#### Common (20+ keys)
- yes, no, ok, cancel, save, delete, edit, add, update, create, view, close, back, etc.

#### Time (12 keys)
- today, yesterday, this_week, this_month, this_year, ago, just_now, minutes, hours, etc.

#### And many more...

## 📝 How to Use Translations in Blade Files

### Basic Usage
```blade
{{ __('messages.key_name') }}
```

### Examples
```blade
<!-- Navigation -->
{{ __('messages.home') }}           {{-- ទំព័រដើម --}}
{{ __('messages.shop') }}            {{-- ហាង --}}
{{ __('messages.cart') }}            {{-- កន្ត្រក --}}

<!-- Hero Section -->
{{ __('messages.fresh_organic_groceries_delivered') }}
{{ __('messages.shop_now') }}
{{ __('messages.browse_categories') }}

<!-- Cart -->
{{ __('messages.your_cart') }}
{{ __('messages.checkout') }}
{{ __('messages.continue_shopping') }}

<!-- Checkout -->
{{ __('messages.delivery_address') }}
{{ __('messages.first_name') }}
{{ __('messages.place_order') }}
```

## 🔧 Files That Need Manual Updates

### Frontend Views
1. `resources/views/frontend/home.blade.php`
2. `resources/views/frontend/shop.blade.php`
3. `resources/views/frontend/cart.blade.php`
4. `resources/views/frontend/checkout.blade.php`
5. `resources/views/frontend/product.blade.php`
6. `resources/views/frontend/about.blade.php`
7. `resources/views/frontend/contact.blade.php`
8. `resources/views/frontend/layouts/app.blade.php` (Partially updated)

### Customer Views
9. `resources/views/customer/auth/login.blade.php`
10. `resources/views/customer/auth/register.blade.php`
11. `resources/views/customer/profile/index.blade.php`
12. `resources/views/customer/orders/index.blade.php`

### Admin Views
13. `resources/views/admin/dashboard.blade.php`
14. `resources/views/admin/products/index.blade.php`
15. `resources/views/admin/orders/index.blade.php`
16. `resources/views/admin/staff/index.blade.php`

### Driver Views
17. `resources/views/driver/dashboard.blade.php`
18. `resources/views/driver/order-details.blade.php`

## 🎯 Step-by-Step Translation Process

### For Each Blade File:

1. **Identify Hardcoded Text**
   - Look for any English text in the blade file
   - Common locations: buttons, labels, headings, messages

2. **Find or Create Translation Key**
   - Check if key exists in `lang/en/messages.php`
   - If not, add it to all three language files

3. **Replace with Translation Helper**
   ```blade
   <!-- Before -->
   <button>Add to Cart</button>
   
   <!-- After -->
   <button>{{ __('messages.add_to_cart') }}</button>
   ```

4. **Handle Dynamic Content**
   ```blade
   <!-- Variables remain unchanged -->
   <h1>{{ $product->translated_name }}</h1>
   ```

5. **Test in All Languages**
   - Switch to Khmer (ភាសាខ្មែរ)
   - Verify text displays correctly
   - Check for missing translations

## 🌟 Special Considerations for Khmer

### Font Support
Khmer text uses the Battambang font, automatically applied when Khmer is selected:

```blade
<body class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
```

### Text Direction
Khmer is LTR (Left-to-Right), same as English, so no RTL adjustments needed.

### Text Length
Khmer text can be longer than English. Ensure buttons and containers have flexible sizing.

### Number Formatting
For currency and numbers:
```blade
{{ number_format($price, 2) }}  {{-- Works for all languages --}}
```

## 🧪 Testing Checklist

- [ ] Homepage displays correctly in Khmer
- [ ] Navigation menu translates properly
- [ ] Product cards show Khmer text
- [ ] Cart page is fully translated
- [ ] Checkout form labels are in Khmer
- [ ] Login/Register pages work in Khmer
- [ ] Admin panel is translatable (optional)
- [ ] Error messages appear in Khmer
- [ ] Success notifications in Khmer
- [ ] Mobile menu translates correctly

## 🚀 Quick Test Commands

```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Start server
php artisan serve
```

## 📊 Translation Coverage

| Section | Status | Coverage |
|---------|--------|----------|
| Language Files | ✅ Complete | 100% |
| Layout (app.blade.php) | 🟡 Partial | ~30% |
| Homepage | ⭕ Pending | 0% |
| Shop | ⭕ Pending | 0% |
| Cart | ⭕ Pending | 0% |
| Checkout | ⭕ Pending | 0% |
| Auth Pages | ⭕ Pending | 0% |
| Admin Panel | ⭕ Pending | 0% |

## 💡 Tips for Efficient Translation

1. **Work Section by Section** - Don't try to translate everything at once
2. **Use Find & Replace** - Most IDEs support multi-file search and replace
3. **Test Frequently** - Switch languages often to catch issues early
4. **Keep Keys Organized** - Group related translations together in the file
5. **Use Comments** - Add comments in translation files for context

## 🔗 Useful Resources

- [Laravel Localization Documentation](https://laravel.com/docs/localization)
- [Khmer Unicode](https://en.wikipedia.org/wiki/Khmer_alphabet)
- [Google Fonts - Battambang](https://fonts.google.com/specimen/Battambang)

## 📞 Need Help?

If you encounter any issues:

1. Check that the key exists in all three language files
2. Verify the syntax: `{{ __('messages.key') }}`
3. Clear Laravel caches
4. Check browser console for errors
5. Ensure session is working properly

---

**Last Updated:** March 15, 2026
**Version:** 1.0.0
**Status:** Language Files Complete - Blade Updates In Progress
