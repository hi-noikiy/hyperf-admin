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
     * @return html
     */
    public function render(string $view, array $data = [], bool $direct_render = false)
    {
        if (!$direct_render) {
            $data['_view'] = $view;
            $view = 'layout.content';
        }
        $data['_csrf_token'] = $this->session->regenerateToken();
        $data['toastr'] = [];
        if ($this->session->has('toastr')) {
            $data['toastr'] = $this->session->remove('toastr');
        }

        return $this->render->render($view, compact('data'));
    }

    /**
     * Flash a toastr message bag to session.
     *
     * @param string    $message   提示消息
     * @param string    $type      消息类型: success,info,warning,danger,maroon
     * @param array     $options   其他参数[timeout:超时自动隐藏(ms), title:标题, subtitle:子标题, icon:图标, image:图片, imageAlt: 图片说明]
     */
    public function admin_toastr(string $message = '', string $type = 'success', array $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());
        $this->session->flash('toastr', $toastr);
    }
}