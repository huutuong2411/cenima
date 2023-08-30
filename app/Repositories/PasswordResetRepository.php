<?php

namespace App\Repositories;

use App\Models\PasswordReset;

/**
 * Class ExampleRepository.
 */
class PasswordResetRepository extends BaseRepository implements PasswordResetInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return PasswordReset::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
}
