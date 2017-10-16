<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/19
 * Time: 16:43
 */

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {


        return view('backend.index.index');
    }
}