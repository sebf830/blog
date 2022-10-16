<?php

namespace App\Repository;

use PDO;
use App\core\Sql;
use App\Interface\EntityInterface;
use App\Interface\RepositoryInterface;

 
class CommentRepository extends Sql implements RepositoryInterface{

    protected $pdo;

    public function __construct()
    {
        parent::__construct();
    }

    public function persist(EntityInterface $entity): void
    {
        $this->save($entity);
    }

    public function findOneBy(array $criterias):array{
        return $this->getBy($criterias);
    }

    public function findAll(): array
    {
        return $this->getAll();
    }

    public function findBy(array $criterias, ?array $subcriterias = null): array
    {
        return $this->getBy($criterias,  $subcriterias);
    }

    public function getCommentsByPost($user, $post){
        $sql = 'SELECT u.firstname as firstname, u.lastname as lastname, 
        c.title as title, c.content as content, c.createdAt as createdAt
        FROM comment as c
        LEFT JOIN user as u
        ON u.id = c.author
        LEFT JOIN post as p
        ON p.id = c.post
        WHERE u.id = ?
        AND p.id = ?';

        $req = $this->pdo->prepareResquest($sql, [$user, $post]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}