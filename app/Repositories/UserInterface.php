<?php

namespace App\Repositories;

/**
 * Interface ExampleRepository.
 */
interface UserInterface extends RepositoryInterface
{
    public function getUsers($filter);

    public function createUser($filter);
    public function findUserByEmail($email);
    // public function createToken($user, $name); hàm này để làm passport
}
