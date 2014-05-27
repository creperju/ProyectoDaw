<?php

namespace Teaching\GeneralBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ExceptionListener
{
    
    protected $templating;
    protected $kernel;

    
    /**
     * Load templating and kernel
     * 
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param type $kernel
     */
    public function __construct(EngineInterface $templating, $kernel)
    {
        $this->templating = $templating;
        $this->kernel = $kernel;
    }

    
    /**
     * Set headers if there is error code (404 for example)
     * 
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // Load error pages if enviroment is prod (dev is optional)
        if ('prod' == $this->kernel->getEnvironment() || 'dev' == $this->kernel->getEnvironment())
        {
            
            $exception = $event->getException();
            $response = new Response();

            // Load exception template
            $response->setContent(
                $this->templating->render(
                    'TeachingGeneralBundle:Exception:exception.html.twig',
                    array('exception' => $exception)
                )
            );

            // HttpExceptionInterface is a special type of exception
            // that holds status code and header details
            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } else {
                $response->setStatusCode(500);
            }

            // Set the new $response object to the $event
            $event->setResponse($response);
        }
    }
}