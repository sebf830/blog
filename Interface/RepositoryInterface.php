<?php
namespace App\Interface;

interface RepositoryInterface{

    public function persist(object $object): void;

    public function findBy(array $criterias): array;

    public function findOneBy(array $criterias): array;

    public function findAll(): array;

}