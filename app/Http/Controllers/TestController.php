<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 13:40
 */

namespace App\Http\Controllers;


use App\Service\Test;

class TestController extends Controller
{

    public $test;

    public function __construct(Test $test)
    {
        $this->test = $test;
    }

    public function index()
    {
        //$this->test->index();
        abort(500);
    }
}