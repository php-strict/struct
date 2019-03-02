# Struct

[![Software License][ico-license]](LICENSE.txt)

Implementation of composite type for PHP.

Contains methods to create from associated array, JSON string or another Struct, with/without type cast.

## Requirements
* PHP >= 7.1

## Install
Install with [Composer](http://getcomposer.org):
    
    composer require phpstrict/struct 

## Usage

```php
use PhpStrict\Struct

$book = new Book([
    'author' => 'Author Name',
    'title' => 'Book title',
    'isbn' => '000-0-000-00000-0',
    'pages' => 156,
    'publicated' => true,
    'tags' => ['drama', 'nature'],
]);
```

See src/example.php for more examples.

## Tests
To execute the test suite, you'll need [Codeception](https://codeception.com/).
```bash
vendor\bin\codecept run
```

[ico-license]: https://img.shields.io/badge/license-GPL-brightgreen.svg?style=flat-square
