<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function create(User $user) {
        try {
            $this->_em->persist($user);
            $this->_em->flush();
        } catch (\Exception $ex) {
            Throws::create($ex);
        }
    }

    public function update(User $user) {
        try {
            $this->_em->persist($user);
            $this->_em->flush();
        } catch (\Exception $ex) {
            Throws::create($ex);
        }
    }

    public function delete(User $user) {
        try {
            $id = $user->getId();
            $this->_em->remove($user);
            $this->_em->flush();

            return "Deleted user id : ".$id." completely !";
        } catch (\Exception $ex) {
            Throws($ex);
        }
    }
}
