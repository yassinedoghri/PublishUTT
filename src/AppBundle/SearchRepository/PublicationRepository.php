<?php

namespace AppBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;
use Symfony\Component\Validator\Constraints\DateTime;

class PublicationRepository extends Repository {

    public function findPublications($authorIds, $researcherIds, $categoryIds, $researchersTeam, $years, $paginator, $page) {
        $boolQuery = new \Elastica\Query\BoolQuery();

        // Authors
        if ($authorIds != NULL) {
            foreach ($authorIds as $a) {
                $nestedFilterA = new \Elastica\Query\Nested();
                $nestedFilterA->setPath("authors.author");
                $authorQuery = new \Elastica\Query\Term();
                $authorQuery->setTerm('authors.author.id', $a);
                $nestedFilterA->setQuery($authorQuery);
                $boolQuery->addMust($nestedFilterA);
            }
        }

        // Researchers
        if ($researcherIds != NULL) {
            foreach ($researcherIds as $r) {
                $nestedFilterR = new \Elastica\Query\Nested();
                $nestedFilterR->setPath("researchers.researcher");
                $researcherQuery = new \Elastica\Query\Term();
                $researcherQuery->setTerm('researchers.researcher.id', $r);
                $nestedFilterR->setQuery($researcherQuery);
                $boolQuery->addMust($nestedFilterR);
            }
        }

        // Categories
        if ($categoryIds != NULL) {
            foreach ($categoryIds as $c) {
                $categoryQuery = new \Elastica\Query\Match();
                $categoryQuery->setField('category', $c);
                $boolQuery->addShould($categoryQuery);
            }
        }

        // Teams Publications
        if ($researchersTeam != NULL) {
            foreach ($researchersTeam as $rt) {
                foreach ($rt as $r) {
                    $nestedFilterRT = new \Elastica\Query\Nested();
                    $nestedFilterRT->setPath("researchers.researcher");
                    $researcherQuery = new \Elastica\Query\Term();
                    $researcherQuery->setTerm('researchers.researcher.id', $r->getResearcher()->getId());
                    $nestedFilterRT->setQuery($researcherQuery);
                    $boolQuery->addShould($nestedFilterRT);
                }
            }
        }

        // Years
        if ($years != NULL) {
            $boolQuery2 = new \Elastica\Query\BoolQuery();
            foreach ($years as $y) {
                $yearsQuery = new \Elastica\Query\QueryString($y);
                $yearsQuery->setFields(array("dateofpublication"));
                $boolQuery2->addShould($yearsQuery);
            }
            $boolQuery->addMust($boolQuery2);
        }
        $resultSet = $paginator->paginate($this->createPaginatorAdapter($boolQuery), $page, 10);

        return $resultSet;
    }

    public function findPublicationByDate($searchText) {
        if (is_numeric($searchText)) {
            $search = new \Elastica\Query\QueryString($searchText);
            $search->setFields(array("dateofpublication"));
            $boolQuery = new \Elastica\Query\BoolQuery();
            $boolQuery->addShould($search);
            $resultSet = $this->find($boolQuery);

            return $resultSet;
        }
        return null;
    }

    public function findPublicationsByResearcherId($id) {
        $boolQuery = new \Elastica\Query\BoolQuery();
        $nestedFilterRT = new \Elastica\Query\Nested();
        $nestedFilterRT->setPath("researchers.researcher");
        $researcherQuery = new \Elastica\Query\Term();
        $researcherQuery->setTerm('researchers.researcher.id', $id);
        $nestedFilterRT->setQuery($researcherQuery);
        $boolQuery->addShould($nestedFilterRT);

        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }

}
