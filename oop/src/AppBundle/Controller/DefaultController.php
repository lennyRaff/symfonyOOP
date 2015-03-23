<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('app/index.html.twig');
    }

    /**
     * @Route("/app/example/login", name="loginpage")
     * @Method("POST")
     */
    public function loginAction()
    {
        if(strtoupper($this->getRequest()->getMethod()) === 'POST') {

            // get all POST data and find user from db
            $fields = $this->getRequest()->request->all();
            $em = $this->getDoctrine()->getManager();
            $userRepo = $em->getRepository('AppBundle:User');
            $user = $em->getRepository('AppBundle:User')->findOneBy(array('username' => $fields['username'], 'password' => sha1($fields['password'])));

            if( is_null($user) === false ) {

                $session = $this->getRequest()->getSession();
                $session->set('user', $user);
                // return $this->redirectToRoute('adminpage');
                return new Response(json_encode(array(
                    'authent' => true
                )));
            }else{
                $errors['error'] = 'The username and password supplied do not match';
                
            }
        }else{
            $errors['error'] = 'The method you supplied is invalid';
        }
        // return $this->redirectToRoute('homepage', array(json_encode($errors)));
        return new Response(json_encode(array(
            $errors
        )));
    }

    /**
     * @Route("/app/example/admin", name="adminpage")
     */
    public function adminAction()
    {
        $session = $this->getRequest()->getSession();
        $user = $session->get('user');
        return $this->render('AppBundle:Admin:index.html.twig', array('user' => $user));
    }
}
