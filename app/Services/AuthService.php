<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;
use App\Repositories\UserVerifyInterface;
use App\Repositories\PasswordResetInterface;

class AuthService
{
    protected  $userVerifyRepository;
    protected  $passwordResetRepository;

    /**
     * __construct
     */
    public function __construct(UserVerifyInterface $userVerifyRepository, PasswordResetInterface $passwordResetRepository)
    {
        $this->userVerifyRepository = $userVerifyRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function createUserVerify($data)
    {
        return $this->userVerifyRepository->create($data);
    }

    public function findToken($data)
    {
        $verifyUser = $this->userVerifyRepository->findOneBy($data);

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->is_email_verified) {
                $verifyUser->user->email_verified_at = now();
                $verifyUser->user->save();
                return true;
            }
        }
        return false;
    }

    public function createPasswordResset($data)
    {
        return $this->passwordResetRepository->create($data);
    }

    public function findResetPassword($data)
    {
        return $this->passwordResetRepository->findOneBy($data);
       
    }
}
