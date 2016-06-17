<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\PublicationType;

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

    /**
     * @Template("AppBundle:Publication:new.html.twig")
     * @Route("/add/publication/", name="new-publication")
     */
    public function newAction(Request $request) {
        // create a task and give it some dummy data for this example
        $publication = new \AppBundle\Entity\Publication();

        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publicationResearcher = new \AppBundle\Entity\PublicationResearcher();
            $user = $this->container->get('security.context')->getToken()->getUser();
            $publication2 = $form->getData();
            $publicationResearcher->setPublication($publication2);
            $publicationResearcher->setResearcher($user);
            $publicationResearcher->setOwner(1);
            $publicationResearcher->setOrderindex(1);
            $publication2->addResearcher($publicationResearcher);

            $em = $this->getDoctrine()->getManager();
            $em->persist($publication2);
            $em->persist($publicationResearcher);
            $em->flush();
            return $this->redirectToRoute('my-publications');
        }

        return array('form' => $form->createView());
    }

    /**
     * @Template("AppBundle:Publication:update.html.twig")
     * @Route("/update/publication/{id}", name="update-publication")
     */
    public function updateAction(Request $request, $id) {
        if (is_null($id)) {
            $postData = $request->get('testimonial');
            $id = $postData['id'];
        }

        $em = $this->getDoctrine()->getEntityManager();
        $publication = $em->getRepository('AppBundle:Publication')->find($id);
        $form = $this->createForm(PublicationType::class, $publication);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication2 = $form->getData();
            $em->persist($publication2);
            $em->flush();

            return $this->redirect($this->generateUrl('my-publications'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Template("AppBundle:Publication:my-publications.html.twig")
     * @Route("/my-publications", name="my-publications")
     */
    public function myPublicationAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Publication');
        $user = $this->container->get('security.context')->getToken()->getUser();
        $publications = $repository->findPublicationsByResearcherId($user->getId());

        return array('publications' => $publications);
    }

}
