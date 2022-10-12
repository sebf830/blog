<?php
namespace App\Interface;

use App\Interface\EntityInterface;

interface RepositoryInterface{

    /**
     * persist an entity in database
     * also update an existing entity
     */
    public function persist(EntityInterface $entity):void;

    /**
     * find many objects from an entity, with search criterias
     * @return array : collection
     */
    public function findBy(array $criterias): array;

    /**
     * find one object from entity, with search criterias
     * @return array : object
     */
    public function findOneBy(array $criterias): array;

    /**
     * find all entity objects
     */
    public function findAll(): array;

}