# Livewire Dynamic RBAC (Role-Based Access Control) Management

A Laravel application built with Livewire and Flux UI featuring a **dynamic, module-based permission system** where permissions are stored in the database and automatically generated for new modules.

## 🎯 Key Features

### 🔐 Dynamic Permission System
- **Database-driven permissions**: All permissions stored in database, not hardcoded
- **Auto-module registration**: New modules automatically create their permissions
- **Module-based access control**: Users see only modules they have permission to access
- **Real-time UI updates**: Sidebar and navigation adapt to user permissions

### 👥 User Management
- Create, edit, and delete users with role assignment
- Search and filter users by name, email, and verification status
- Bulk operations for efficient user management
- Pagination support for large datasets

### 🏷️ Role Management
- Create, edit, and delete roles with color coding
- Dynamic permission assignment via checkboxes
- Search functionality for roles
- Visual permission management interface

### 🛡️ Security Features
- Middleware-based route protection
- Permission checking at controller and view levels
- Secure role-permission relationships
- CSRF protection on all forms

## 🏗️ Architecture

### Models
- **User**: Authenticated users with role relationships
- **Role**: User roles with many-to-many permission relationships
- **Permission**: Individual permissions organized by modules

### Services
- **PermissionService**: Handles dynamic permission registration and management

### Middleware
- **CheckPermission**: Validates user permissions for protected routes

### Livewire Components
- **Users/Index**: Complete user CRUD with bulk operations
- **Roles/Index**: Role management with dynamic permission editing

## 📋 Permission Structure

Permissions are organized by **modules** with standard CRUD operations:

### Current Modules

**Dashboard:**
- `view_dashboard`: Access main dashboard

**Users:**
- `view_users`, `create_users`, `edit_users`, `delete_users`

**Roles:**
- `view_roles`, `create_roles`, `edit_roles`, `delete_roles`

**Settings:**
- `view_settings`, `edit_profile`, `change_password`, `manage_appearance`, `manage_two_factor`

## 🚀 Usage Guide

### Adding New Modules (Super Easy!)

When you create a new module, permissions are automatically generated:

```php
// Option 1: Auto-generate CRUD permissions
use App\Services\PermissionService;
PermissionService::registerCrudModule('products', 'Products');

// Option 2: Custom permissions for a module
PermissionService::registerModulePermissions('reports', [
    'view_reports' => 'View Reports',
    'export_reports' => 'Export Reports',
    'generate_reports' => 'Generate Reports',
]);
```

### Managing Role Permissions
1. Navigate to **Roles** page
2. Click **⋮** (actions menu) on any role
3. Select **"Permissions"**
4. Check/uncheck permissions in the modal
5. Click **"Update Permissions"**

### Route Protection
Protect routes with permissions:

```php
// In routes/web.php
Route::get('admin/users', [UserController::class, 'index'])
    ->middleware('permission:view_users');

// Multiple permissions (user must have ANY of them)
Route::middleware(['permission:view_users|create_users'])->group(function () {
    // Routes here
});
```

### Checking Permissions in Code

```php
// In controllers/views
if (auth()->user()->hasPermission('create_users')) {
    // Show create button
}

// In Blade templates
@if(auth()->user()->hasPermission('view_users'))
    <a href="{{ route('users.index') }}">Users</a>
@endif
```

## 🧪 Testing

Run the complete test suite:
```bash
php artisan test
```

Test specific features:
```bash
php artisan test --filter=RoleIndexTest
php artisan test --filter=UserIndexTest
```

## 🔧 Development Commands

### Database Setup
```bash
# Fresh install with seeders
php artisan migrate:fresh --seed

# Run only migrations
php artisan migrate

# Run only seeders
php artisan db:seed
```

### Code Quality
```bash
# Format code with Pint
vendor/bin/pint

# Run tests
php artisan test
```

## 📊 Database Schema

```
users (id, name, email, role_id, ...)
roles (id, name, label, color, ...)
permissions (id, name, label, module, description, ...)
permission_role (id, role_id, permission_id, ...)
```

## 🎨 UI Features

- **Responsive design** with Tailwind CSS
- **Dark mode support**
- **Flux UI components** for consistent styling
- **Toast notifications** for user feedback
- **Modal dialogs** for permission management
- **Conditional navigation** based on permissions

## 🔒 Security Best Practices

- All permissions verified server-side
- CSRF protection on forms
- Route model binding for security
- Permission checks before data access
- Secure password hashing
- Input validation and sanitization

## 📈 Performance Optimizations

- **Eager loading** for role-permission relationships
- **Pagination** for large datasets
- **Database indexing** on frequently queried columns
- **Query optimization** in permission checks

## 🛠️ Tech Stack

- **Laravel 12** - PHP framework
- **Livewire 3** - Reactive components
- **Flux UI** - Component library
- **Tailwind CSS** - Styling
- **Pest** - Testing framework
- **Laravel Pint** - Code formatting
- **MySQL/SQLite** - Database

## 🚀 Future Enhancements

- **API permission checks** for AJAX endpoints
- **Permission groups** for easier management
- **Audit logging** for permission changes
- **Import/export** functionality for roles
- **Advanced filtering** in permission management
- **Role templates** for quick setup

---

**Ready to extend?** Adding new modules is as simple as calling `PermissionService::registerCrudModule('your_module')` and the permission system handles the rest!
