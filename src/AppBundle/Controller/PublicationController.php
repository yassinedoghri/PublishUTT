<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PublicationController extends Controller {

    /**
     * @Template("AppBundle:Publication:publication.html.twig")
     * @Route("/publication/{id}", name="show-publication")
     */
    public function showPublicationAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Publication');
        $publication = $repository->findOneBy(array(
            'id' => $request->get('id'),
        ));
        return array('publication' => $publication);
    }

}
