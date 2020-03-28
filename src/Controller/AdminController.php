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

        return $this->render->render($view, compact('data'));
    }

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     */
    public function admin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new MessageBag(get_defined_vars());
// var_dump($toastr);
        // session()->flash('toastr', $toastr);
    }
}