<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends Controller {

    /**
     * @Template("AppBundle:Search:search.html.twig")
     * @Route("/search/{page}", requirements={"view" = "list|grid|map", "page" = "\d+"}, defaults={"page" = 1}, name="search")
     */
    public function searchAction(Request $request, $page) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Publication');
        $teamRepository = $repositoryManager->getRepository('AppBundle:Team');

        $authors = $request->get('author');
        $researchers = $request->get('researcher');
        $categories = $request->get('category');
        $teams = $request->get('team');
        $dateofpublication = $request->get('year');
        $pageNum = intval($page);
        $limit = $request->query->get('l', 10);
        $paginator = $this->get('knp_paginator');


        $researchersTeam = NULL;
        if ($teams != NULL) {
            $researchersTeam = array();
            foreach ($teams as $t) {
                $team = $teamRepository->findTeamById($t)[0];
                array_push($researchersTeam, $team->getResearchers());
            }
        }

        $publications = $repository->findPublications($authors, $researchers, $categories, $researchersTeam, $dateofpublication, $paginator, $pageNum, $limit);
        $collaborators = $repository->findPublications($authors, $researchers, $categories, $researchersTeam, $dateofpublication, $paginator, $pageNum, $limit);

        return array(
            'publications' => $publications,
            'collaborators' => $collaborators
        );
    }

    /**
     * @Route("/searchterm", name="searchterm")
     */
    public function searchTermAction(Request $request) {
        $authors = $this->authorsAction($request);
        $researchers = $this->researchersAction($request);
        $categories = $this->categoriesAction($request);
        $teams = $this->teamsAction($request);
        $dateofpublication = $this->dateOfPublicationAction($request);

        if ($dateofpublication) {
            $json_data = array_merge($authors, $researchers, $categories, $teams, array($dateofpublication));
        } else {
            $json_data = array_merge($authors, $researchers, $categories, $teams);
        }
        return new JsonResponse(array("items" => $json_data));
    }

    /**
     * @Route("/searchparams", name="searchparams")
     */
    public function searchParamsAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $aRepository = $repositoryManager->getRepository('AppBundle:Author');
        $rRepository = $repositoryManager->getRepository('AppBundle:User');
        $cRepository = $repositoryManager->getRepository('AppBundle:Category');
        $tRepository = $repositoryManager->getRepository('AppBundle:Team');

        $authors = $request->get('author');
        $researchers = $request->get('researcher');
        $categories = $request->get('category');
        $teams = $request->get('team');
        $years = $request->get('year');

        $json_data = array();
        if ($authors != NULL) {
            foreach ($authors as $a) {
                $author = $aRepository->findAuthorById(intval($a));
                array_push($json_data, array("id" => 'a-' . $a, "text" => $author[0]->getFirstname() . ' ' . $author[0]->getLastname()));
            }
        }
        if ($researchers != NULL) {
            foreach ($researchers as $r) {
                $researcher = $rRepository->findResearcherById(intval($r));
                array_push($json_data, array("id" => 'r-' . $r, "text" => $researcher[0]->getFirstname() . ' ' . $researcher[0]->getLastname()));
            }
        }
        if ($categories != NULL) {
            foreach ($categories as $c) {
                $categories = $cRepository->findCategoryById($c);
                array_push($json_data, array("id" => $c, "text" => $categories[0]->getWording()));
            }
        }
        if ($teams != NULL) {
            foreach ($teams as $t) {
                $team = $tRepository->findTeamById(intval($t));
                array_push($json_data, array("id" => 't-' . $t, "text" => $team[0]->getInitials()));
            }
        }
        if ($years != NULL) {
            foreach ($years as $y) {
                array_push($json_data, array("id" => $y, "text" => $y));
            }
        }

        return new JsonResponse($json_data);
    }

    /**
     * @Route("/authors", name="authors")
     */
    public function authorsAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Author');
        $searchText = $request->query->get('q');
        $authors = $repository->findAuthorsByName($searchText);

        $json_data = array();
        foreach ($authors as $a) {
            array_push(
                    $json_data, array(
                'id' => 'a-' . $a->getId(),
                'text' => $a->getFirstname() . ' ' . $a->getLastname(),
                'type' => 'Author'
            ));
        }

        return $json_data;
    }

    /**
     * @Route("/researchers", name="researchers")
     */
    public function researchersAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:User');
        $searchText = $request->query->get('q');
        $researchers = $repository->findResearchersByName($searchText);

        $json_data = array();
        foreach ($researchers as $r) {
            array_push(
                    $json_data, array(
                'id' => 'r-' . $r->getId(),
                'text' => $r->getFirstname() . ' ' . $r->getLastname(),
                'type' => 'Researcher'
            ));
        }

        return $json_data;
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Category');
        $searchText = $request->query->get('q');
        $categories = $repository->findCategoriesByName($searchText);

        $json_data = array();
        foreach ($categories as $c) {
            array_push(
                    $json_data, array(
                'id' => $c->getInitials(),
                'text' => $c->getWording(),
                'type' => 'Category'
            ));
        }

        return $json_data;
    }

    /**
     * @Route("/teams", name="teams")
     */
    public function teamsAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Team');
        $searchText = $request->query->get('q');
        $teams = $repository->findTeamsByName($searchText);

        $json_data = array();
        foreach ($teams as $t) {
            array_push(
                    $json_data, array(
                'id' => 't-' . $t->getId(),
                'text' => $t->getInitials(),
                'type' => 'Research Lab'
            ));
        }

        return $json_data;
    }

    /**
     * @Route("/dateofpublication", name="dop")
     */
    public function dateOfPublicationAction(Request $request) {
        $repositoryManager = $this->container->get('fos_elastica.manager.orm');
        $repository = $repositoryManager->getRepository('AppBundle:Publication');
        $searchText = $request->query->get('q');
        $publications = $repository->findPublicationByDate($searchText);

        $json_data = array();
        if (isset($publications[0])) {
            $year = $publications[0]->getDateofpublication()->format('Y');
            $json_data = array(
                'id' => $year,
                'text' => $year,
                'type' => 'Date Of Publication'
            );
        }
        return $json_data;
    }

}
