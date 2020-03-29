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
     * @return array
     */
    public function login($username)
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
            $this->admin_toastr("用户名或者密码错误", 'danger', ['timeout' => 60, 'title' => "Error"]);
        }

        return $this->render('user.login', [], true);
    }
}