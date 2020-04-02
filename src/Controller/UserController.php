<?php declare(strict_types=1);

namespace Oyhdd\Admin\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;
use Oyhdd\Admin\Model\AdminUser;
use Illuminate\Hashing\BcryptHasher;
use Hyperf\HttpServer\Annotation\Middleware;
use Oyhdd\Admin\Middleware\AuthMiddleware;
use Hyperf\HttpMessage\Cookie\Cookie;
use Hyperf\Utils\Context;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @Controller(prefix="admin/user")
 */
class UserController extends AdminController
{

    /**
     * @Inject
     * @var BcryptHasher
     */
    protected $hash;

    /**
     * @RequestMapping(path="login")
     * 
     * 登录
     * @author Eric
     * @param  string   $username   用户名
     * @param  string   $password   密码
     * @param  int      $remember   记住我: 1是 0否
     * @return view
     */
    public function login()
    {
        if ($this->request->isMethod("POST")) {
            $username = htmlspecialchars($this->request->input('username', ''));
            $password = htmlspecialchars($this->request->input('password', ''));
            $remember = intval($this->request->input('remember', 0));

            $user = AdminUser::where(['username' => $username, 'status' => AdminUser::STATUS_ENABLE])->first();
            if (!empty($user) && $this->hash->check($password, $user->password)) {
                $token = 'Bearer '.(string) $this->jwt->getToken(['id' => $user->id]);
                $cookie = new Cookie('Authorization', $token);
                return $this->response->withCookie($cookie)->redirect('/admin');
            }
            $this->admin_toastr("用户名或者密码错误", 'error', 0);
        } elseif ($token = $this->request->cookie('Authorization')) {
            try {
                $token = ucfirst($token);
                $arr = explode('Bearer ', ucfirst($token));
                $token = $arr[1] ?? '';
                if (!empty($token) && $this->jwt->checkToken($token)) {
                    $tokenObj = $this->jwt->getTokenObj($token);
                    $userId = $tokenObj->getClaim('id');
                    $user = AdminUser::where('id', $userId)->where('status', AdminUser::STATUS_ENABLE)->first();
                    if (empty($user)) {
                        throw new TokenValidException('登录态失效，请重新登录');
                    }

                    $request = $this->request->withAttribute('user', $user);
                    Context::set(ServerRequestInterface::class, $request);
                    return $this->response->redirect('/admin');
                }
            } catch (\Throwable $t) {
            }
        }

        return $this->render('user.login', [], true);
    }

    /**
     * @RequestMapping(path="logout")
     * @Middleware(AuthMiddleware::class)
     * 
     * 退出
     * @author Eric
     * @return view
     */
    public function logout()
    {
        $token = $this->request->cookie('Authorization', '');
        try {
            $this->jwt->logout($token);
        } catch (\Throwable $t) {
        }
        return $this->response->redirect('/admin/user/login');
    }


    /**
     * @RequestMapping(path="lockscreen")
     * @Middleware(AuthMiddleware::class)
     * 
     * 锁屏
     * @author Eric
     * @return view
     */
    public function lockscreen()
    {
        return $this->render('user.lockscreen', [], true);
    }

    /**
     * @RequestMapping(path="saveCustomizeStyle")
     * @Middleware(AuthMiddleware::class)
     * 
     * 自定义网站样式
     * @author Eric
     * @param  string   $selector   页面元素
     * @param  array    $styles     样式[class_name => enable]
     * @return array
     */
    public function saveCustomizeStyle()
    {
        $selector = htmlspecialchars($this->request->input('selector', ''));
        $styles = $this->request->input('styles', '');
        if (empty($selector) || empty($styles)) {
            return [];
        }
        $user = $this->request->getAttribute('user');
        $customize_style = !empty($user->customize_style) ? json_decode($user->customize_style, true) : [];
        foreach ($styles as $class_name => $enable) {
            $customize_style[$selector][$class_name] = intval($enable);
        }

        $user->customize_style = json_encode($customize_style);
        if ($user->save()) {
            return [];
        }

    }

    /**
     * @RequestMapping(path="clearCustomizeStyle")
     * @Middleware(AuthMiddleware::class)
     * 
     * 清除自定义网站样式
     * @author Eric
     * @param  string   $selector   页面元素
     * @return array
     */
    public function clearCustomizeStyle()
    {
        $selector = htmlspecialchars($this->request->input('selector', ''));
        if (empty($selector)) {
            return [];
        }

        $user = $this->request->getAttribute('user');
        $customize_style = !empty($user->customize_style) ? json_decode($user->customize_style, true) : [];
        if ($selector === 'all') {
            $customize_style = [];
        } elseif (isset($customize_style[$selector])) {
            $customize_style[$selector] = [];
        }

        $user->customize_style = json_encode($customize_style);
        if ($user->save()) {
            $this->admin_toastr("重置样式成功", 'success');
            return [];
        }
        return [];
    }
}