# Functions for dealing with falsy and truthy values in PHP.

- Tiny library (< 200 lines total, adds 2 functions to the global namespace)
- No dependencies
- Fully tested
- Requires PHP version ^7.0

## Functions

### falsy(...$vars) : bool
Returns false whenever a variable is falsy.

### truthy(...$vars) : bool
Returns true only when all variables are truthy (opposite of falsy).

## Usage

```php
    // Returns true
    falsy(
        false,
        null,
        0,
        0.0,
        '0',
        [],
        [''],
        ['' => ''],
        [false, null],
        ['' => '', 0 => ['key' => null, 'foo' => [''], 'empty' => []]
        ],
        new stdClass
    );

    $class = new stdClass;
    $class->foo = 'bar';

    // Returns true
    truthy(
        true,
        1,
        0.1,
        '1',
        ['1'],
        ['foo' => 'bar'],
        [true],
        $class
    );
```

## Contributing

Contributions are welcomed! Feel free to submit a pull request anytime.

## Licence

MIT License

Copyright © 2019 Angle Software
