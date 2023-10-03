<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class ExampleRepository.
 */
class UserRepository extends BaseRepository implements UserInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * getExamples
     *
     * @return mixed
     */
    public function getUsers($filter)
    {
        $data = $this->model
            ->when(!empty($filter->email), function ($q) use ($filter) {
                $q->where('email', '=', "$filter->email");
            })
            ->when(!empty($filter->name), function ($q) use ($filter) {
                $q->where('name', 'like', "%$filter->name%");
            })
            ->when(!empty($filter->start_at), function ($query) use ($filter) {
                $query->whereDate('created_at', '>=', $filter->start_at);
            })
            ->when(!empty($filter->end_at), function ($query) use ($filter) {
                $query->whereDate('created_at', '<=', $filter->end_at);
            });

        return $data;
    }

    public function createUser($filter)
    {
        $data = $this->model::create($filter);

        return $data;
    }

    public function findUserByEmail($email)
    {
        $data = $this->model::where('email', $email)->first();

        return $data;
    }

    // public function createToken($user, $name) hàm này để làm passport
    // {
    //     $factory = app(PersonalAccessTokenFactory::class);

    //     $token = $factory->make(
    //         $user, // Đối tượng người dùng
    //         $name // Tên của access token
    //     );

    //     return $token;
    // }
}
