<?php
/**
 * Desc: params validate component for PHP applications.
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@iloucd.com>
 * Date: 2016-12-20 14:28:28
 */
namespace FurthestWorld\Validator\Src;

abstract class Validator {

    protected $adapter = null;
    private $messages = null;

    public function __construct() {

    }

    public abstract function formatParams();
    public abstract function validateParams();

}