<?php declare(strict_types=1);

namespace Oyhdd\Admin\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;
use Hyperf\Contract\SessionInterface;
use Hyperf\View\RenderInterface;
use Phper666\JwtAuth\Jwt;
use Illuminate\Support\MessageBag;
use Oyhdd\Admin\Model\AdminMenu;

class AdminController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject()
     * @var SessionInterface
     */
    protected $session;

    /**
     * @Inject()
     * @var RenderInterface
     */
    protected $render;

    /**
     * @Inject
     * @var Jwt
     */
    protected $jwt;

    /**
     * Render view contents for the given view.
     *
     * @param  string   $view
     * @param  array    $data
     * @param  bool     $direct_render
     * @return view
     */
    protected function render(string $view, array $data = [], bool $direct_render = false)
    {
        if (!$direct_render) {
            $data['_view'] = $view;
            $view = 'layout.content';
        }
        $data['_csrf_token'] = $this->session->regenerateToken();
        $data['_toastr'] = [];
        if ($this->session->has('toastr')) {
            $data['_toastr'] = $this->session->remove('toastr');
        }
        $user = $this->request->getAttribute('user');
        $data['_user'] = [];
        if (!empty($user)) {
            $data['_user'] = $user->toArray();
        }

        $uri = $this->request->getPathInfo();
        $data['_menu'] = AdminMenu::getMenuTree($uri);
        return $this->render->render($view, compact('data'));
    }

    /**
     * Flash a toastr message bag to session.
     *
     * @param string    $message   提示消息
     * @param string    $type      消息类型: success,info,warning,danger,maroon
     * @param int       $timeout   超时自动隐藏
     */
    protected function admin_toastr(string $message = '', string $type = 'success', int $timeout = 2)
    {
        $toastr = new MessageBag(get_defined_vars());
        $this->session->flash('toastr', $toastr);
    }

}