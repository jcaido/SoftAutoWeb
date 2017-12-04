<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



/**
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/login", name="usuario_login")
     */
    public function LoginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        
        return $this->render('inicio_login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }
    
    /**
     * @Route("/login_check", name="usuario_login_check")
     */
    public function loginCheckAction()
    {
        
    }
    
    /**
     * @Route("/logout", name="usuario_logout")
     */
    public function logoutAction()
    {
        
    }
}
