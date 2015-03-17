<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{
    /**
     * @Route("/app/example/ajax/{name}", defaults={"name" = "dialogue"}, name="ajaxcall")
     */
    public function indexAction($name)
    {
        if( !isset($name) ) {

            return false;
        }

        $template = $this->render('AppBundle:Ajax:' . $name . '.html.twig')->getContent();
        $json = json_encode($template);
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
