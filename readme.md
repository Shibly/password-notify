# Laravel Password Notification Package

[![Latest Version](https://img.shields.io/packagist/v/shibly/password-notify.svg)](https://packagist.org/packages/shibly/password-notify)
[![PHP Version](https://img.shields.io/badge/php-8.x-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/laravel-11.x|12.x-orange.svg)](https://laravel.com)

This Laravel package automatically sends a notification to users when their password is changed. It does **not** store or email the new password.

---

## Installation

You can easily install this package via Composer:

```bash
composer require shibly/password-notify
```

---

## Publish Configuration (Optional)

Publish the configuration file to customize package behavior:

```bash
php artisan vendor:publish --tag=config
```

This will publish `passwordnotify.php` into your application's `config` directory.

---

## Configuration

Modify `config/passwordnotify.php` to define the password field:

```php
return [
    'password_field' => 'password',
];
```

You can customize this field if your application uses a different naming convention.

---

## Usage

When changing a user's password, the notification will automatically be sent if the configured password field changes:

```php
use Illuminate\Support\Facades\Hash;

$user = auth()->user();
$user->update([
    'password' => Hash::make('MySecurePassword123'),
]);
```

You don't need to do anything else. The package listens for password changes and sends a notification automatically.

---

## Example Email Notification

The user will receive a notification similar to:

```markdown
Hello, John Doe!

Your password has been successfully changed.

If you did not change your password, please contact support immediately.
```

---

## Queueing Notifications (Recommended)

By default, notifications will be queued. Ensure your Laravel queue worker is running:

```bash
php artisan queue:work
```

---

## Requirements

* PHP `^8.1`
* Laravel `^11.0|^12.0`

---

## Contributing

Feel free to submit issues or pull requests to improve this package!

---

## License

This package is open-source and licensed under the [MIT license].
