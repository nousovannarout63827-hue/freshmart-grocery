# 🌍 Multi-Language Support Documentation

## Overview

Your FreshMart grocery system now supports **3 languages**:
- 🇬🇧 **English** (en)
- 🇰🇭 **Khmer** (km)
- 🇨🇳 **Chinese** (zh)

Users can switch languages using the language selector in the navigation bar. The preference is saved in their session.

---

## 📁 File Structure

```
grocery-system/
├── lang/
│   ├── en/
│   │   └── messages.php      # English translations
│   ├── km/
│   │   └── messages.php      # Khmer translations
│   └── zh/
│       └── messages.php      # Chinese translations
├── app/
│   └── Http/
│       └── Middleware/
│           └── SetLanguage.php    # Language middleware
├── routes/
│   └── web.php               # Contains language switcher route
└── resources/
    └── views/
        └── frontend/
            └── layouts/
                └── app.blade.php    # Updated with language support
```

---

## 🛠️ How It Works

### 1. Language Files
All translations are stored in the `lang/` directory. Each language has its own folder containing PHP files with key-value pairs.

**Example:**
```php
// lang/en/messages.php
return [
    'checkout' => 'Checkout',
    'cart' => 'Cart',
];

// lang/km/messages.php
return [
    'checkout' => 'ទូទាត់ប្រាក់',
    'cart' => 'កន្ត្រក',
];
```

### 2. Middleware
The `SetLanguage` middleware checks the user's session on every request and sets the appropriate locale.

**File:** `app/Http/Middleware/SetLanguage.php`

### 3. Route
The language switcher route saves the selected locale to the session.

**Route:** `/lang/{locale}` (e.g., `/lang/km`)

### 4. Usage in Blade Files
Use Laravel's `__()` helper to display translated text:

```blade
<!-- Instead of this -->
<h1>Checkout</h1>

<!-- Use this -->
<h1>{{ __('messages.checkout') }}</h1>
```

---

## 🎨 Language Switcher UI

The language switcher appears in the navigation bar as a dropdown:

```
🌐 EN  ▼
    ├── 🇬🇧 English
    ├── 🇰🇭 ភាសាខ្មែរ
    └── 🇨🇳 中文
```

**Features:**
- Smooth hover animation
- Current language highlighted
- Flag emojis for visual identification
- Native language names

---

## 🔤 Khmer Typography

The system uses the **Battambang** font from Google Fonts for Khmer text, ensuring beautiful and readable typography.

**Automatic Font Switching:**
- When Khmer is selected, the `<body>` tag gets the `font-khmer` class
- This applies the Battambang font automatically
- English and Chinese continue using Poppins font

---

## 📝 Available Translations

### Navigation
- Home / ទំព័រដើម / 首页
- Shop / ហាង / 商店
- Categories / ប្រភេទ / 分类
- About / អំពីពួកយើង / 关于我们
- Contact / ទំនាក់ទំនង / 联系我们

### Cart & Checkout
- Cart / កន្ត្រក / 购物车
- Checkout / ទូទាត់ប្រាក់ / 结账
- Delivery Address / អាសយដ្ឋានដឹកជញ្ជូន / 送货地址
- Place Order / បញ្ជាទិញ / 下订单

### Messages
- Success / ជោគជ័យ / 成功
- Error / កំហុស / 错误
- Product added to cart! / ផលិតផលត្រូវបានបន្ថែមក្នុងកន្ត្រក! / 产品已加入购物车！

---

## ➕ Adding New Translations

### Step 1: Add Keys to All Language Files

**lang/en/messages.php:**
```php
return [
    'new_feature' => 'New Feature',
    // ... existing translations
];
```

**lang/km/messages.php:**
```php
return [
    'new_feature' => 'មុខងារថ្មី',
    // ... existing translations
];
```

**lang/zh/messages.php:**
```php
return [
    'new_feature' => '新功能',
    // ... existing translations
];
```

### Step 2: Use in Blade Files
```blade
<p>{{ __('messages.new_feature') }}</p>
```

---

## 🔄 Changing the Default Language

To change the default language, edit the `.env` file:

```env
APP_LOCALE=en
APP_FALLBACK_LOCALE=en
```

Available options:
- `en` - English
- `km` - Khmer
- `zh` - Chinese

---

## 🎯 Testing

1. **Visit the homepage**: http://127.0.0.1:8000/
2. **Click the language switcher** (🌐 EN) in the navigation bar
3. **Select a language** (e.g., ភាសាខ្មែរ)
4. **Navigate around** - the language persists across pages
5. **Check the URL** - remains the same, language is stored in session

---

## 🐛 Troubleshooting

### Language Not Changing?
1. Clear caches:
   ```bash
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```
2. Clear browser cache
3. Check session is working (try logging in)

### Translations Not Showing?
1. Verify the key exists in all language files
2. Check the syntax: `{{ __('messages.key') }}`
3. Ensure file is named `messages.php`
4. Check for PHP syntax errors in language files

### Khmer Font Not Loading?
1. Check internet connection (Google Fonts)
2. Verify `<body>` has `font-khmer` class when Khmer is active
3. Check browser developer tools for font loading errors

---

## 📊 Performance

- **Minimal overhead**: Only one extra middleware
- **Session-based**: No database queries for language detection
- **Cached**: Translation files are cached by Laravel
- **Fast**: Language switch is instant (redirect back)

---

## 🔐 Security

- **Validated input**: Only 'en', 'km', 'zh' are accepted
- **Session storage**: Language preference stored securely
- **No SQL injection**: Static locale values only

---

## 📱 Mobile Support

The language switcher is fully responsive:
- **Desktop**: Dropdown in navigation bar
- **Mobile**: Appears in mobile menu

---

## 🌐 Future Enhancements

### Suggested Additions:
1. **More languages**: Vietnamese, Thai, etc.
2. **RTL support**: For Arabic/Hebrew
3. **Number formatting**: Localized number formats
4. **Date formatting**: Localized date formats
5. **Admin panel translations**: Translate admin interface
6. **Email translations**: Translate system emails
7. **User language preference**: Save to database for logged-in users

### Adding More Languages:
```php
// 1. Create lang/vi/messages.php for Vietnamese
// 2. Add 'vi' to the allowed locales in routes/web.php
// 3. Add to language switcher dropdown
// 4. Update SetLanguage middleware if needed
```

---

## 📚 Resources

- [Laravel Localization Documentation](https://laravel.com/docs/localization)
- [Google Fonts - Battambang](https://fonts.google.com/specimen/Battambang)
- [Unicode Khmer](https://en.wikipedia.org/wiki/Khmer_alphabet)

---

## ✅ Checklist for Complete Translation

- [x] Language files created
- [x] Middleware created and registered
- [x] Language switcher route added
- [x] Language switcher UI added
- [x] Khmer font support added
- [x] Navigation menu translated
- [ ] Homepage content translated
- [ ] Shop page translated
- [ ] Product page translated
- [ ] Cart page translated
- [ ] Checkout page translated
- [ ] Contact page translated
- [ ] Admin panel translated (optional)

---

**Last Updated:** February 27, 2026
**Version:** 1.0.0
