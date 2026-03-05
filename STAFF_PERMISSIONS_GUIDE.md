# Staff Permission Requirements

## Quick Reference Guide

After assigning permissions to staff members, ensure they have the following permissions to access specific features:

### 📊 Reports Access
**Required Permission:** `view_reports`

- **Menu Item:** Reports (in sidebar)
- **Route:** `/admin/reports`
- **What it does:** Access to financial reports, driver analytics, and export functionality

### 🚚 Driver Tracking
**Required Permission:** `manage_drivers`

- **Menu Item:** 🚚 Driver Tracking (in sidebar)
- **Route:** `/admin/drivers/tracking`
- **What it does:** View all driver locations on map, track active deliveries

### 📈 Driver Performance
**Required Permission:** `view_reports`

- **Menu Item:** Driver Performance (in sidebar)
- **Route:** `/admin/driver-performance`
- **What it does:** View driver delivery statistics and performance metrics

### 📜 Activity Logs
**Required Permission:** `view_activity_logs`

- **Menu Item:** System Audit Logs (in sidebar)
- **Route:** `/admin/activity-logs`
- **What it does:** View system activity logs and audit trail

---

## Complete Permission List

| Permission | Description | Features Unlocked |
|------------|-------------|-------------------|
| `manage_inventory` | Manage products and stock | Add/edit/delete products, update inventory |
| `manage_categories` | Manage product categories | Create/edit/delete categories |
| `manage_orders` | Manage customer orders | View and process orders |
| `process_orders` | Process orders | Update order status, prepare orders |
| `manage_customers` | Manage customer accounts | View/edit customer information |
| `manage_staff` | Manage staff accounts | Add/edit staff, change roles |
| `manage_drivers` | Manage driver accounts | Driver tracking, assign deliveries |
| `manage_coupons` | Manage discount codes | Create/edit/delete coupons |
| `manage_reviews` | Moderate reviews | Approve/reject customer reviews |
| `view_reports` | View analytics | Financial reports, driver performance |
| `export_data` | Export reports | Download Excel/PDF reports |
| `view_activity_logs` | View system logs | Audit trail and activity history |
| `manage_settings` | System configuration | Modify system settings |
| `manage_roles` | Manage user roles | Create and edit user roles |

---

## Default Staff Permissions

When a staff member is created **without explicit permissions**, they automatically get these default permissions:

- `manage_inventory` ✅
- `manage_categories` ✅
- `manage_orders` ✅
- `process_orders` ✅
- `manage_customers` ✅

**Important:** The following permissions are **NOT** included by default and **must be explicitly assigned** by the admin:

- ❌ `view_reports` - Must assign for Reports & Driver Performance access
- ❌ `manage_drivers` - Must assign for Driver Tracking access
- ❌ `view_activity_logs` - Must assign for Activity Logs access

This ensures that **menu items only appear** when the admin explicitly grants access.

---

## Common Issues & Solutions

### Issue: Staff cannot access Driver Tracking (403 Error)
**Solution:** Assign the `manage_drivers` permission to the staff member.

1. Go to **Team Management** → Select the staff member → **Edit**
2. Scroll to **"Driver & Delivery Management"** section
3. Check **"🚗 Manage Drivers"**
4. Click **Update Staff**

### Issue: Staff cannot access Reports (403 Error)
**Solution:** Ensure the staff member has `view_reports` permission.

**Note:** This should be included by default for staff without explicit permissions. If you've assigned custom permissions, make sure to check:
- **"📊 View Reports"** permission in the **"Reports & Analytics"** section

### Issue: Staff cannot access Activity Logs (403 Error)
**Solution:** Assign the `view_activity_logs` permission.

1. Go to **Team Management** → Select the staff member → **Edit**
2. Scroll to **"Reports & Analytics"** section
3. Check **"📜 View Activity Logs"**
4. Click **Update Staff**

### Issue: Staff cannot access Driver Performance (403 Error)
**Solution:** Ensure the staff member has `view_reports` permission (same as Reports access).

### Issue: Staff sees menu item but gets 403 error
**Solution:** This happens when the sidebar shows a menu item but the route has stricter permission checks. All routes have been updated to match the sidebar permission checks.

After assigning permissions, clear caches:
```bash
php artisan route:clear
php artisan view:clear
```

---

## How to Assign Permissions to Staff

1. Login as **Admin**
2. Navigate to **Team Management** (sidebar)
3. Click on the staff member's name
4. Click **Edit Staff** button
5. Scroll to the **Permissions** section
6. Check the boxes for the permissions you want to grant
7. Click **Update Staff**

### Key Permissions for Common Staff Roles

**Store Manager:**
- All default permissions
- `manage_staff`
- `view_reports`
- `export_data`
- `view_activity_logs`

**Inventory Clerk:**
- `manage_inventory`
- `manage_categories`
- `process_orders`

**Customer Service:**
- `manage_orders`
- `process_orders`
- `manage_customers`
- `manage_reviews`
- `view_reports`

**Dispatcher:**
- `manage_orders`
- `manage_drivers` ← For Driver Tracking
- `view_reports` ← For Reports and Driver Performance
- `view_activity_logs` ← For Activity Logs

---

## Technical Notes

### Permission Check Locations

- **User Model:** `app/Models/User.php` - `hasPermission()` method
- **Sidebar Menu:** `resources/views/layouts/admin.blade.php`
- **Route Protection:** `app/Http/Middleware/CheckPermission.php`
- **Controller Access:** Use `$user->hasPermission('permission_name')`

### Route Protection Updates (March 5, 2026)

The following routes were updated to use permission-based middleware instead of role-based:

| Route | Old Middleware | New Middleware |
|-------|---------------|----------------|
| `/admin/reports` | `role:admin,super_user` | `permission:view_reports` |
| `/admin/driver-performance` | `role:admin,super_user` | `permission:view_reports` |
| `/admin/drivers/tracking` | (inside manage_staff group) | `permission:manage_drivers` |
| `/admin/activity-logs` | (inside manage_staff group) | `permission:view_activity_logs` |

### Files Modified

1. **routes/web.php** - Updated route middleware for Reports, Driver Tracking, Activity Logs
2. **app/Http/Controllers/Driver/DriverLocationController.php** - Changed to permission check
3. **resources/views/layouts/admin.blade.php** - Added permission checks to sidebar menu items

---

## Testing

To verify permissions are working correctly:

1. Login as the staff member
2. Check if the menu items appear in the sidebar
3. Try accessing the routes directly:
   - Reports: `/admin/reports` (requires `view_reports`)
   - Driver Tracking: `/admin/drivers/tracking` (requires `manage_drivers`)
   - Driver Performance: `/admin/driver-performance` (requires `view_reports`)
   - Activity Logs: `/admin/activity-logs` (requires `view_activity_logs`)

If you get a 403 error, the staff member is missing the required permission.

---

## Troubleshooting Checklist

If staff still cannot access features after assigning permissions:

- [ ] Did you save the staff member after checking the permissions?
- [ ] Did you clear the route cache? (`php artisan route:clear`)
- [ ] Did you clear the view cache? (`php artisan view:clear`)
- [ ] Is the staff account status set to "active"?
- [ ] Are you testing with the correct staff account?
- [ ] Check database: `SELECT permissions FROM users WHERE email = 'staff@grocery.com'`

---

## Cache Clear Commands

After making permission changes, always run:

```bash
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
```

This ensures all changes take effect immediately.
