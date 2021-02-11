<?php

namespace App\Domain\Auth;

use App\Core\Orm\AbstractRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}