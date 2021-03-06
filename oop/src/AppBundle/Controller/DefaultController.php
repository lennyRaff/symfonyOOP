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
        // if(strtoupper($this->getRequest()->getMethod()) === 'POST') {

            // get all POST data and find user from db
            $fields = $this->getRequest()->request->all();
            $em = $this->getDoctrine()->getManager();
            // $userRepo = $em->getRepository('AppBundle:User');
            $user = $em->getRepository('AppBundle:User')->findOneBy(array('email' => $fields['email'], 'password' => sha1($fields['password'])));

            if( is_null($user) === false ) {

                $session = $this->getRequest()->getSession();
                $session->set('user', $user);
                // return $this->redirectToRoute('adminpage');
                return new Response(json_encode(array(
                    'authent' => true
                )));
            }elseif( $fields['email'] == '' || $fields['password'] == '' ) {
                $errors['error'] = 'Please fill in all details';
            }else{
                $errors['error'] = 'The email and password supplied do not match';
            }
        // }else{
        //     $errors['error'] = 'The method you supplied is invalid';
        // }
        // return $this->redirectToRoute('homepage', array(json_encode($errors)));
        return new Response(json_encode(
            $errors
        ));
    }

    /**
     * @Route("/app/example/signup", name="signuppage")
     * @Method("POST")
     */
    public function signupAction()
    {
        // get all POST data and find user from db
        $fields = $this->getRequest()->request->all();
        $em = $this->getDoctrine()->getManager();

        $userRepo = $em->getRepository('AppBundle:User');

        $response = $userRepo->getLogin($em, $fields);

        return new Response(json_encode(
            $response
        ));
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
