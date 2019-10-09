<?php

namespace App\EventListener;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;


class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    /**
     * LocaleListener constructor.
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @param RequestEvent $requestEvent
     */
    public function onKernelRequest(RequestEvent $requestEvent)
    {
        $request = $requestEvent->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // locale set as a _locale routing parameter will not be overwritten
        if (!$request->attributes->get('_locale')) {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            // must be registered after the default Locale listener
            'kernel.request' => [['onKernelRequest', 15]],
        ];
    }
}