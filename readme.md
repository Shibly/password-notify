# Laravel Password Notification Package

[![Latest Version](https://img.shields.io/packagist/v/shibly/password-notify.svg)](https://packagist.org/packages/shibly/password-notify)
[![PHP Version](https://img.shields.io/badge/php-8.x-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/laravel-11.x|12.x-orange.svg)](https://laravel.com)

This Laravel package automatically sends notifications to users when their passwords are changed, including the new
password in plain text.

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

### Important Security Notice ⚠️

**Sending plain-text passwords via email poses security risks.** Use this package only in controlled environments or
with explicit user consent.

### Basic Integration

When changing a user's password, temporarily store the plaintext password as follows:

```php
use Illuminate\Support\Facades\Hash;

// Example of updating user password and triggering notification:
$user = User::find($userId);
$newPassword = 'MySecurePassword123';

// Temporarily store the plaintext password to trigger notification
$user->password = Hash::make($newPassword);
$user->plain_password = $newPassword; // custom temporary attribute
$user->save();
```

The package automatically listens for updates and sends the email notification to the user.

---

## Example Email Notification

The user will receive a notification similar to:

```markdown
Hello, John Doe!

Your password has been successfully changed.

Your new password is:

**MySecurePassword123**

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

This package is open-source and licensed under the [MIT license](LICENSE.md).
