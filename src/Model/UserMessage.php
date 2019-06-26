<?php
/**
 * Class/file UserMessage.php
 *
 * @author Khachornchit Songsaen
 * Date: 2/19/2019
 * Time: 1:13 PM
 */

namespace App\Model;


use App\Entity\User;

/**
 * Class UserMessage
 * @package App\Model
 */
class UserMessage extends Message
{
    /**
     * @param User $user
     * @return string
     */
    public static function getErrorMessageCreateUser(User $user)
    {
        return self::formatError(sprintf("Cannot create user : %s !!!", $user->getUsername()));
    }

    /**
     * @param User $user
     * @return string
     */
    public static function getErrorMessageUpdateUser(User $user)
    {
        return self::formatError(sprintf("Cannot update user : %s !!!", $user->getUsername()));
    }

    /**
     * @param $id
     * @return string
     */
    public static function getErrorMessageFindNotFoundId($id)
    {
        return self::formatError(sprintf("Find not found user id : %s !!!", $id));
    }

    /**
     * @param $id
     * @return string
     */
    public static function getErrorMessageDeleteId($id)
    {
        return self::formatError(sprintf("Cannot delete user id : %s !!!", $id));
    }
}
