<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

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

        $form = $this->createFormBuilder($publication)
                ->add('title', 'text', array(
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('dateofpublication', 'date', array(
                    'years' => range(date('Y'), date('Y') - 100),
                    'data' => new \DateTime("first day of january"),
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    ),
                    'format' => 'dd-MM-yyyy',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'required' => false
                ))
                ->add('category', 'entity', array(
                    'class' => 'AppBundle:Category',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                ->orderBy('c.wording', 'ASC');
                    },
                    'choice_label' => 'wording',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
//                ->add('authors', 'entity', array(
//                    'class' => 'AppBundle:PublicationAuthor',
//                    'query_builder' => function (EntityRepository $er) {
//                        return $er->createQueryBuilder('pa')
//                                ->orderBy('pa.author', 'ASC');
//                    },
//                    'choice_label' => 'author',
//                    'attr' => array(
//                        'class' => 'form-control'
//                    ),
//                    'required' => false
//                ))
                ->getForm();

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
