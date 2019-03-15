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
 * Example struct class, implements some configuration.
 */
class Config extends Struct
{
    /**
     * @var string
     */
    public $rootDir = '/';
    
    /**
     * @var string
     */
    public $cacheDir = '/cache';
    
    /**
     * @var string
     */
    public $tempDir = '/temp';
    
    /**
     * @var int
     */
    public $itemsOnPage = 10;
    
    /**
     * @var bool
     */
    public $showFullDates = false;
}
