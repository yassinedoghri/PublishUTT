<?php

namespace AppBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class ResearcherRepository extends Repository {

    public function findResearchersByName($searchText) {
        $search = new \Elastica\Query\QueryString($searchText);
        $search->setFields(array("firstname", "lastname"));
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addShould($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }
    
    public function findResearcherById($id) {
        $search = new \Elastica\Query\Match('id', $id);
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addMust($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }
}
