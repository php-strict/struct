<?php
/**
 * PHP Strict.
 * 
 * @copyright   Copyright (C) 2018 - 2019 Enikeishik <enikeishik@gmail.com>. All rights reserved.
 * @author      Enikeishik <enikeishik@gmail.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace PhpStrict\Struct\Examples;

use PhpStrict\Struct\Struct;

/**
 * Example struct class, implements book data in some books store.
 */
class Book extends Struct
{
    /**
     * @var string
     */
    public $author = '';
    
    /**
     * @var string
     */
    public $title = '';
    
    /**
     * @var string
     */
    public $isbn = '';
    
    /**
     * @var int
     */
    public $pages = 0;
    
    /**
     * @var bool
     */
    public $publicated = false;
    
    /**
     * @var array
     */
    public $tags = [];
}
