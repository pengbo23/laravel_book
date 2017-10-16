<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 17:41
 */

namespace App\Http\Controllers;

use App\Eloquent\Manager;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class BackendLoginController
 * @package App\Http\Controllers
 * 后台登录
 */
class BackendLoginController extends Controller
{
    public function index()
    {
        return view('backend.login.login');
    }

    /**
     * 设置验证码
     */
    public function createCaptcha()
    {
        $builder = new CaptchaBuilder;
        $builder->build($width = 116, $height = 36);
        session(['phrase' => $builder->getPhrase()]); //将验证码存入session，方便登陆验证
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /**
     * @param Request $request
     * 登录操作
     */
    public function signIn(Request $request)
    {
        if ($request->isMethod('post')) {
            $code = $request->input('code');//post提交后的验证码
            $phrase = session('phrase');
            if ($phrase == $code) {
                $userName = $request->input('username');
                if (!trim($userName)) {
                    return response()->json(array('code' => 1, 'msg' => '用户不能为空'));
                }
                $password = $request->input('password');
                $manager = Manager::where('user_name', $userName)->first()->toArray();
                if (!$manager) {
                    return response()->json(array('code' => 1, 'msg' => '用户不存在'));
                }
                if ($manager['password'] != md5($password . $manager['salt'])) {
                    return response()->json(array('code' => 1, 'msg' => '密码错误'));
                }
                $request->session()->put('backend_user', $manager['id']);
                $request->session()->put('backend_user_data', $manager);
                return response()->json(array('code' => 2, 'msg' => '登录成功'));
            } else {
                return response()->json(array('code' => 1, 'msg' => '验证码错误'));
            }

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 退出登录
     */
    public function logout(Request $request)
    {
         $request->session()->flush();
         return redirect(route('backendLogin'));
    }
}