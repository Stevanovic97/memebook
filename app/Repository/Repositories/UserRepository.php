<?php
namespace App\Repository\Repositories;

use App\User;
use App\Repository\IRepositories\UserIRepository;

class UserRepository implements UserIRepository{
protected $model;
public function __construct(User $model)
{
$this->model=$model;
}

public function getUser($user_id)
{
return $this->model->getUser($user_id);
}
}
