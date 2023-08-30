<?php

namespace App\Repositories;

use App\Models\UserVerify;

/**
 * Class ExampleRepository.
 */
class UserVerifyRepository extends BaseRepository implements UserVerifyInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return UserVerify::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
