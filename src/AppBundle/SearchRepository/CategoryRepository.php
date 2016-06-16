<?php

namespace AppBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class CategoryRepository extends Repository {

    public function findCategoriesByName($searchText) {
        $search = new \Elastica\Query\QueryString($searchText);
        $search->setFields(array("initials", "wording"));
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addShould($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }
    
    public function findCategoryById($initials) {
        $search = new \Elastica\Query\Match('initials', $initials);
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addMust($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }

}
