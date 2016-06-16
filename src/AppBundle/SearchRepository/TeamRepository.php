<?php

namespace AppBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class TeamRepository extends Repository {

    public function findTeamsByName($searchText) {
        $search = new \Elastica\Query\QueryString($searchText);
        $search->setFields(array("initials", "wording"));
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addShould($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }

    public function findTeamById($id) {
        $search = new \Elastica\Query\Match('id', $id);
        $boolQuery = new \Elastica\Query\BoolQuery();
        $boolQuery->addMust($search);
        $resultSet = $this->find($boolQuery);

        return $resultSet;
    }

}
