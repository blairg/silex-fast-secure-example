<?php

namespace SilexExample\Repository;

use MongoDB\Collection;
use MongoDB\Model\BSONDocument;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * UserRepository constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param $username
     * @param $password
     * @return mixed
     */
    public function checkUser($username, $password)
    {
        $document = $this->collection->findOne(
            [
                'username' => $username,
                'password' => $password
            ]
        );

        if ($document instanceof BSONDocument) {
            return $document;
        }

        //var_dump('here');
        //var_dump($document);

        return false;
    }
}
