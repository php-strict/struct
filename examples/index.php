<?php
/**
 * PHP Strict.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Examples;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Example of usage Book class.
 */

//book with classic assign data to class fields
$book1 = new Book();
$book1->author = 'Author Name';
$book1->title = 'Book title 1';
$book1->isbn = '000-0-000-00000-0';
$book1->pages = 240;
$book1->publicated = true;
$book1->tags = ['fantastic', 'space', 'detective'];

//another book with data through array
$book2 = new Book([
    'author' => 'Author Name',
    'title' => 'Book title 2',
    'isbn' => '000-0-000-00000-0',
    'pages' => 156,
    'publicated' => true,
    'tags' => ['drama', 'nature'],
]);

//another book with data through JSON
$json = '{"author":"Author Name","title":"Book title 3","isbn":"000-0-000-00000-0","pages":156,"publicated":true,"tags":["comedy","city"]}';
$book3 = new Book($json);

//book, based on existing book
$book4 = new Book($book1);
$book4->title = 'Book title 4';

//book, based on existing book, using setter
$book5 = new Book();
$book5->set($book4);
$book5->title = 'Book title 5';

//book from array, using setter
$book6 = new Book();
$book6->setFromArray([
    'author' => 'Author Name',
    'title' => 'Book title 6',
    'isbn' => '000-0-000-00000-0',
    'pages' => 48,
    'publicated' => true,
    'tags' => ['science', 'nature'],
]);

//book from JSON, using setter
$json = <<<JSN
{
    "author": "Author Name",
    "title": "Book title 7",
    "isbn": "000-0-000-00000-0",
    "pages": 78,
    "publicated": true,
    "tags": ["history", "country"]
}
JSN;
$book7 = new Book();
$book7->setFromJson($json);

/*
You can compare structures fields, or use var_dump:
var_dump($book1);
var_dump($book2);
var_dump($book3);
var_dump($book4);
var_dump($book5);
var_dump($book6);
var_dump($book7);
*/


/**
 * Example of usage Config class.
 */

//default configuration, as defined in Config
$config = new Config();

//load new configuration from JSON file
$config->setFromJson(file_get_contents(__DIR__ . '/config.json'));

/*
Usage of $config may looks like this

passing cache directory path into Cache object
$cache = new Cache($config->cacheDir);

passing itemsOnPage config value into Paginator object
$paginator = new Paginator($config->itemsOnPage);
*/
