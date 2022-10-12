<?php

namespace App\Repository;

use App\core\Sql;
use App\Interface\RepositoryInterface;
use App\Models\User;

 
class UserRepository extends Sql implements RepositoryInterface{

    private $table;
    public function __construct()
    {
        parent::__construct();
    }

    public function persist(User $user):void
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