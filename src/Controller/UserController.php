<?php declare(strict_types=1);

namespace Oyhdd\Admin\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Contract\SessionInterface;
use Oyhdd\Admin\Model\AdminUser;

/**
 * @Controller(prefix="admin/user")
 */
class UserController extends AdminController
{
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
        $username = htmlspecialchars($this->request->input('username', ''));
        $password = htmlspecialchars($this->request->input('password', ''));
        $remember = intval($this->request->input('remember', 0));

        $user = AdminUser::where(['username' => $username, 'status' => AdminUser::STATUS_ENABLE])->first();
        if (empty($user)) {
            // $this->admin_toastr('hehehe');
            // return $this->helper->error(Code::RECORD_NOT_FOUND, "用户{$username}不存在", []);
        }
        // if (!$this->hash->check($password, $user->password)) {
        //     return $this->helper->error(Code::VALIDATE_ERROR, "用户名或者密码错误", []);
        // }

        // $user->last_login_time = Carbon::now();
        // $user->save();
        // $token = (string) $this->jwt->getToken(['id' => $user->id]);
        // $user['menu'] = $user->getMenu();
        // $user['all_permissions'] = $user->getAllPermissions();

        // return $this->helper->success([
        //     'user' => $user, 
        //     'token' => $token, 
        //     'expires_in' => $this->jwt->getTTL()
        // ]);
        return $this->render('user.login', [], true);
    }
}