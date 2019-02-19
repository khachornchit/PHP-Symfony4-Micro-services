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

use App\Model\UserMessage;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class UserManager
 * @package App\Manager
 */
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
     */
    public function update(User $user)
    {
        try {
            $this->em->persist($user);
            $this->em->flush();
        } catch (\Exception $exception) {
            throw new Exception(UserMessage::getErrorMessageUpdateUser($user));
        }
    }

    /**
     * @param $id
     * @return User | null | mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function find($id)
    {
        $user = $this->em->find('App\\Entity\\User', $id);
        if (!$user) {
            throw new Exception(UserMessage::getErrorMessageFindNotFoundId($id));
        } else {
            return $user;
        }
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete($id)
    {
        $user = $this->find($id);
        if ($user) {
            $this->em->remove($user);
            $this->em->flush();
        } else {
            throw new Exception(UserMessage::getErrorMessageDeleteId($id));
        }
    }
}
