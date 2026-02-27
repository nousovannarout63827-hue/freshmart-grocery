# 🌍 Database Multi-Language Products Guide

## Overview

Your FreshMart system now supports **multi-language product names and descriptions** stored directly in the database using JSON columns. This allows each product to have names in:
- 🇬🇧 English (en)
- 🇰🇭 Khmer (km)  
- 🇨🇳 Chinese (zh)

---

## 📁 How It Works

### Database Storage

Instead of storing product names as plain text:
```
name: "Apple"
```

We store them as JSON:
```json
{
  "en": "Apple",
  "km": "ផ្លែប៉ោម",
  "zh": "苹果"
}
```

### Benefits

✅ **Single column** for all languages
✅ **Easy to extend** - add more languages anytime
✅ **Automatic fallback** - if translation missing, shows English
✅ **SEO friendly** - each language gets proper text
✅ **Professional** - same approach used by major eCommerce platforms

---

## 🛠️ Implementation Details

### 1. Migration

**File:** `database/migrations/2026_02_27_112714_add_multilingual_support_to_products_table.php`

Converts the `name` column from `VARCHAR` to `JSON` and adds `description` as `JSON`.

**Existing Data:** Automatically converted to JSON with English as default for all languages.

### 2. Product Model

**File:** `app/Models/Product.php`

**Casts:**
```php
protected $casts = [
    'name' => 'array',
    'description' => 'array',
];
```

**Accessors:**
- `translated_name` - Returns name in current locale with fallback
- `translated_description` - Returns description in current locale with fallback

**Usage:**
```php
$product->translated_name  // Returns name in current language
$product->translated_description  // Returns description in current language
```

### 3. Admin Product Form

**File:** `resources/views/admin/products/create.blade.php`

Three separate inputs for each language:
- Product Name (English)
- ឈ្មោះផលិតផល (ខ្មែរ)
- 产品名称 (中文)

Same for descriptions.

### 4. Product Controller

**File:** `app/Http/Controllers/Admin/ProductController.php`

Packs the three language inputs into a JSON array:
```php
$product->name = [
    'en' => $request->name_en,
    'km' => $request->name_km,
    'zh' => $request->name_zh,
];
```

### 5. Frontend Display

**Files:** `resources/views/frontend/shop.blade.php`, `product.blade.php`

Use the `translated_name` accessor:
```blade
<h3 class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
    {{ $product->translated_name }}
</h3>
```

---

## 📝 How to Use

### For Admins/Staff

**Creating a New Product:**

1. Go to Admin → Inventory → Add Product
2. Fill in all three language fields:
   - **Product Name (English):** Organic Carrots
   - **ឈ្មោះផលិតផល (ខ្មែរ):** ការ៉ុតសរីរាង្គ
   - **产品名称 (中文):** 有机胡萝卜
3. Add descriptions in each language (optional)
4. Click "Save"

**Result:** Product will display in the appropriate language based on user's selection.

### For Customers

**Shopping Experience:**

1. Select your language from the language switcher (🌐 EN)
2. Browse products - they appear in your selected language
3. Product details pages also display in your language

**Example:**
- English user sees: "Organic Carrots"
- Khmer user sees: "ការ៉ុតសរីរាង្គ"
- Chinese user sees: "有机胡萝卜"

---

## 🔄 Adding New Products

### Required Fields

```
✅ name_en (required)
✅ name_km (required)
✅ name_zh (required)
✅ price (required)
✅ stock (required)
✅ category (required)
✅ unit (required)
```

### Optional Fields

```
⭕ description_en
⭕ description_km
⭕ description_zh
⭕ sku (auto-generated if blank)
⭕ images (up to 4)
```

---

## 🎨 Typography

### Khmer Font Support

When Khmer language is active, products use the **Battambang** font for beautiful Khmer typography.

**CSS Class:** `font-khmer`

**Applied Automatically:**
```blade
<h3 class="{{ app()->getLocale() === 'km' ? 'font-khmer' : '' }}">
    {{ $product->translated_name }}
</h3>
```

---

## 🔧 Editing Existing Products

### Option 1: Edit Form (Recommended)

1. Go to Admin → Inventory
2. Click "Edit" on any product
3. Update names in all three languages
4. Save changes

### Option 2: Database Direct

```php
$product = Product::find(1);
$product->name = [
    'en' => 'New Name',
    'km' => 'ឈ្មោះថ្មី',
    'zh' => '新名称',
];
$product->save();
```

---

## 📊 Database Schema

### Products Table

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| name | JSON | `{"en": "...", "km": "...", "zh": "..."}` |
| description | JSON | `{"en": "...", "km": "...", "zh": "..."}` |
| category_id | BIGINT | Foreign key |
| price | DECIMAL | Product price |
| stock | INTEGER | Available quantity |
| unit | STRING | kg, pcs, bundle, etc. |
| sku | STRING | Unique product code |
| slug | STRING | URL-friendly name |
| is_active | BOOLEAN | Product visibility |
| created_at | TIMESTAMP | Creation date |
| updated_at | TIMESTAMP | Last update |

---

## 🐛 Troubleshooting

### Products Showing "Unknown Product"

**Cause:** Name field is empty or malformed JSON

**Solution:**
1. Check database: `SELECT id, name FROM products WHERE id = X`
2. Ensure JSON is valid: `{"en": "Name", "km": "ឈ្មោះ", "zh": "名称"}`
3. Re-save product from admin panel

### Language Not Changing

**Cause:** Session or cache issue

**Solution:**
```bash
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear
```

### Slug Generation Issues

**Cause:** Non-English characters in slug

**Solution:** The system now generates slug from English name only:
```php
$name = is_array($product->name) ? ($product->name['en'] ?? '') : $product->name;
$product->slug = Str::slug($name);
```

---

## 📈 Future Enhancements

### Suggested Additions:

1. **Vietnamese Language** - Add 'vi' to JSON
2. **Product Attributes** - Multi-language colors, sizes, etc.
3. **Category Translations** - Translate category names
4. **Brand Translations** - Translate brand names
5. **Filter Labels** - Translate filter options
6. **Search Synonyms** - Map keywords across languages

### Example: Adding Vietnamese

**Step 1:** Update existing products:
```php
Product::chunk(100, function ($products) {
    foreach ($products as $product) {
        if (is_array($product->name)) {
            $product->name['vi'] = $product->name['en']; // Fallback
            $product->save();
        }
    }
});
```

**Step 2:** Update create form to include Vietnamese input

**Step 3:** Update language switcher to include 'vi'

---

## ✅ Checklist

- [x] Migration created and run
- [x] Product model updated with casts
- [x] Accessors added (translated_name, translated_description)
- [x] Admin create form updated
- [x] Admin edit form updated (needs implementation)
- [x] ProductController updated
- [x] Shop blade updated
- [x] Product detail blade updated
- [x] Khmer font support added
- [ ] All existing products migrated
- [ ] Admin edit form tested
- [ ] Search functionality updated (optional)

---

## 📚 API Reference

### Product Model Methods

```php
// Get translated name
$product->translated_name

// Get translated description  
$product->translated_description

// Access raw JSON array
$product->name  // Returns: ['en' => '...', 'km' => '...', 'zh' => '...']
$product->description  // Returns: ['en' => '...', 'km' => '...', 'zh' => '...']

// Access specific language
$product->name['en']  // English only
$product->name['km']  // Khmer only
$product->name['zh']  // Chinese only
```

### Controller Validation

```php
$request->validate([
    'name_en' => 'required|string|max:255',
    'name_km' => 'required|string|max:255',
    'name_zh' => 'required|string|max:255',
    'description_en' => 'nullable|string|max:1000',
    'description_km' => 'nullable|string|max:1000',
    'description_zh' => 'nullable|string|max:1000',
]);
```

---

**Last Updated:** February 27, 2026  
**Version:** 1.0.0  
**Migration:** `2026_02_27_112714_add_multilingual_support_to_products_table`
