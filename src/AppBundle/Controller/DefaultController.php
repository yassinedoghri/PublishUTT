<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Template("AppBundle:Default:index.html.twig")
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Template("AppBundle:Default:signin.html.twig")
     * @Route("/signin", name="signin")
     */
    public function signInAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Template("AppBundle:Default:signup.html.twig")
     * @Route("/signup", name="signup")
     */
    public function signUpAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Template("AppBundle:Default:search.html.twig")
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Template("AppBundle:Default:my-publications.html.twig")
     * @Route("/account/publications", name="my-publications")
     */
    public function viewMyPublicationsAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

    /**
     * @Template("AppBundle:Default:publication.html.twig")
     * @Route("/publication", name="my-publications")
     */
    public function publicationAction(Request $request) {
        // replace this example code with whatever you need
        return array();
    }

}
