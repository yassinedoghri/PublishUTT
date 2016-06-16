<?php

namespace AppBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class AuthorRepository extends Repository {

    public function findAuthorsByName($searchText) {
        $search = new \Elastica\Query\QueryString($searchText);
        $search->setFields(array("firstname", "lastname"));
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addShould($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }
    
    public function findAuthorById($id) {
        $search = new \Elastica\Query\Match('id', $id);
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addMust($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }

}
