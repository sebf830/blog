<?php

namespace App\Repository;

use App\core\Sql;
use App\Interface\EntityInterface;
use App\Interface\RepositoryInterface;

 
class PostsTagsRepository extends Sql implements RepositoryInterface{

    public function __construct()
    {
        parent::__construct();
    }

    public function persist(EntityInterface $user): void
    {
        $this->save($user);
    }

    public function findOneBy(array $criterias):array{
        return $this->getBy($criterias);
    }

    public function findAll(): array
    {
        return $this->getAll();
    }

    public function findBy(array $criterias): array
    {
        return $this->getBy($criterias);
    }
}