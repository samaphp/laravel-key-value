## Laravel Key Value

Use `samaphp/laravel-key-value` to store key value pair settings in the database.
The database table has three fields only. (collection, key, value).

### Installation

1. Require the package: `composer require samaphp/laravel-key-value`
2. You can directly start using it, please refer to usage examples section below.

### Usage

```php
// The alias already defined but you can use the service from this path
use Samaphp\LaravelKeyValue\LaravelKeyValue;
// system.stats is a collection name. (aka variables group name)
$keyValue = new LaravelKeyValue('system.stats');
$keyValue->set('last_success_sms', time());
print $keyValue->get('last_success_sms', 'DEFAULT_VALUE_HERE');

// Print all variables from the targeted collection (system.stats)
print_r($keyValue->all());

// Delete a specific variable
$keyValue->delete('last_success_sms');

// Shortcut
print (new LaravelKeyValue('system.stats'))->get('last_success_sms');

// You can save an array, which will be encoded in JSON to be saved into the database
$value = ['hi', 'hello'];
$keyValue->set('test', $value);

// Will be decoded and returned as an array
dd($keyValue->set('test'));
```

### Alternatives

This package was inspired by [laravel-settings](https://github.com/qcod/laravel-settings) package by [Mohd Saqueib Ansari](https://github.com/saqueib), but made to be simple and straightforward solution to provide a key/value store functionality.
If you are looking for alternatives, you can consider laravel-settings package.

### Security

If you discover any security related issues, please [open a new issue](https://github.com/samaphp/laravel-key-value/issues/new) using the issue tracker.

### License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
