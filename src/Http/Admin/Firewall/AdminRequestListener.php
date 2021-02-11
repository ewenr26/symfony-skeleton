<?php


namespace App\Http\Admin\Firewall;


use App\Http\Admin\Controller\BaseController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class AdminRequestListener
 * @package App\Http\Admin\Firewall
 */
class AdminRequestListener implements EventSubscriberInterface
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private AuthorizationCheckerInterface $auth;

    public function __construct(AuthorizationCheckerInterface $auth)
    {
        $this->auth = $auth;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => "onController",
            RequestEvent::class => "onRequest"
        ];
    }

    public function onController(ControllerEvent $event): void
    {
        if (false === $event->isMasterRequest()) {
            return;
        }
        $controller = $event->getController();
        if (is_array($controller) && $controller[0] instanceof BaseController && !$this->auth->isGranted('ROLE_ADMIN')) {
            $exception = new AccessDeniedException();
            $exception->setSubject($event->getRequest());
            throw $exception;
        }
    }

    public function onRequest(RequestEvent $requestEvent)
    {
        if (!$requestEvent->isMasterRequest()) {
            return;
        }
        $uri = "/" . trim($requestEvent->getRequest()->getRequestUri(), '/') . "/";
        $prefix = "/admin/";
        if (substr($uri, 0, mb_strlen($prefix)) === $prefix && !$this->auth->isGranted('ROLE_ADMIN')) {
            $exception = new AccessDeniedException();
            $exception->setSubject($requestEvent->getRequest());
            throw $exception;
        }
    }


}