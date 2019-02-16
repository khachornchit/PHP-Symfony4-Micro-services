<?php
/**
 * Class/file UserManager.php
 *
 * @author John Pluto Solutions <john@pluto.solutions>
 * Date: 2/16/2019
 * Time: 10:17 AM
 */

namespace App\Manager;

use App\Entity\User;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class UserManager extends BaseManager
{
    private $em;

    /**
     * UserManager constructor.
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct()
    {
        parent::__construct();

        $this->em = EntityManager::create($this->connectionParameters, $this->configuration);
    }

    /**
     * @param User $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @param $id
     * @return User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function find($id): User
    {
        return $this->em->find('App\\Entity\\User', $id);
    }

    /**
     * @param $id
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete($id): string
    {
        $user = $this->find($id);
        if ($user) {
            $this->em->remove($user);
            $this->em->flush();
            return "Deleted used id : " . $id . " successfully !";
        } else {
            return "Find not found used id : " . $id . " please contact administrator !";
        }
    }
}
