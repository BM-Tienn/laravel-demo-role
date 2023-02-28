<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Http\Requests\StoreUserRequest;

class UserService
{
    protected $userRepository;
    protected $storeUserRequest;

    public function __construct(UserRepository $userRepository, StoreUserRequest $storeUserRequest)
    {
        $this->userRepository = $userRepository;
        $this->storeUserRequest = $storeUserRequest;
    }

    public function saveUserData($data )
    {
        
        $validator = Validator::make($data , $this->storeUserRequest->rules());

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->userRepository->save($data);
        return $result;
    }
}