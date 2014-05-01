<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/hello')) {
            // teaching_user_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'teaching_user_homepage')), array (  '_controller' => 'Teaching\\UserBundle\\Controller\\DefaultController::indexAction',));
            }

            // teaching_teacher_homepage
            if (preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'teaching_teacher_homepage')), array (  '_controller' => 'Teaching\\TeacherBundle\\Controller\\DefaultController::indexAction',));
            }

        }

        // teaching_admin_homepage
        if ($pathinfo === '/admin') {
            return array (  '_controller' => 'Teaching\\AdminBundle\\Controller\\AdminController::indexAction',  '_route' => 'teaching_admin_homepage',);
        }

        // teaching_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'teaching_homepage');
            }

            return array (  '_controller' => 'Teaching\\GeneralBundle\\Controller\\HomeController::indexAction',  '_route' => 'teaching_homepage',);
        }

        // exito
        if ($pathinfo === '/validado') {
            return array (  '_controller' => 'Teaching\\GeneralBundle\\Controller\\HomeController::finAction',  '_route' => 'exito',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            // login_check
            if ($pathinfo === '/login_check') {
                return array('_route' => 'login_check');
            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
