# 🤥 Helpers for dealing with falsy and truthy values in PHP.

- Tiny library (< 200 lines total, adds 2 functions to the global namespace)
- No dependencies
- Fully tested
- Requires PHP version ^7.0

## Functions

### falsy(...$vars) : bool
Returns false whenever a variable is falsy.

### truthy(...$vars) : bool
Returns true only when all variables are truthy (opposite of falsy).

## Examples

If anything is falsy, the function returns true.

```php
falsy(true, false, null); // true
truthy(true, false, null); // false
```

If all variables are truthy, the function returns false.

```php
falsy(true, 1, [1]); // false
truthy(true, 1, [1]); // true
```

Null strings and empty arrays are falsy.

```php
falsy('0', '', [], ['']); // true
truthy('0', '', [], ['']); // false

// Note: (bool) [''] returns true in plain PHP. Falsy interprets it as false, as it should.
```

Arrays are recursively audited.

```php
$array = [
    'foo' => false,
    'bar'=> [
        'baz' => false
    ]
];

falsy($array); // true
truthy($array); // false

$array = [
    'foo' => true,
    'bar'=> [
        'baz' => 1
    ]
];

falsy($array); // false
truthy($array); // true
```

Objects are audited on their properties.

```php
$object = new stdClass;

falsy($object); // true
truthy($object); // false

$object->foo = false;
$object->bar = null;
$object->baz = 0;

falsy($object); // true
truthy($object); // false

$object->foo = true;
$object->bar = 'string';
$object->baz = 1;

falsy($object); // false
truthy($object); // true
```

Closures are audited on their return value.

```php
$void = function () { return; };

falsy($void); // true
truthy($void); // false

$false = function () { return false; };

falsy($false); // true
truthy($false); // false

$string = function () { return 'string'; };

falsy($string); // false
truthy($string); // true

falsy($void, $false, $string); // true
truthy($void, $false, $string); // false
```

Finally, you may pass as many statements as you need.

```php
falsy(
    false,
    null,
    0,
    0.0,
    '0',
    [],
    [''], // Php would consider this as being true, but really, is it? No.
    ['' => ''],
    [false, null],
    ['' => '', 0 => ['key' => null, 'foo' => [''], 'empty' => []]], // Array keys are ignored
    new stdClass, // Objects with empty attributes are falsy
    function () { return; }, // Void closures are falsy
    function () { return false; },
    function () { return null; },
    function () { return ''; },
    function () { return 0; },
    function () { return []; },
    function () { return ['']; }
); // true

$object = new stdClass;
$object->foo = 'bar';

truthy(
    true,
    1,
    0.1,
    '1',
    ['foo'],
    ['foo' => 'bar'],
    [true],
    $object,
    function () { return true; },
    function () { return 1; },
    function () { return 0.1; },
    function () { return '1'; },
    function () { return ['foo']; },
    function () { return ['foo' => 'bar']; },
    function () { return [true]; },
    function () use ($object) { return $object; }
); // true
```

## Testing

Run the test suite by executing:

```shell
    composer install
    ./vendor/bin/phpunit
```

## Contributing

Contributions are welcomed! Feel free to submit a pull request anytime.

## Licence

MIT License

Copyright © 2019 Angle Software
