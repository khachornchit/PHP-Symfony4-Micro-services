<?php

namespace App\Entity;

use App\Model\Message;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $userpassword;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserpassword()
    {
        return $this->userpassword;
    }

    /**
     * @param string $userpassword
     * @return $this
     */
    public function setUserpassword(string $userpassword)
    {
        $this->userpassword = $userpassword;

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @return User
     */
    public static function create($username, $password): self
    {
        $created = new self();
        $created->setUsername($username);

        $hashed_password = sha1($password);
        $created->checkPassword($hashed_password);
        $created->setUserpassword($hashed_password);

        return $created;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @param User $updated
     * @return User
     */
    public static function update($username, $password, User $updated)
    {
        $updated->setUsername($username);
        $hashed_password = sha1($password);
        $updated->checkPassword($hashed_password);
        $updated->setUserpassword($hashed_password);

        return $updated;
    }

    /**
     * @param $hashPassword
     */
    public function checkPassword($hashPassword)
    {
        $first5Chars = substr($hashPassword, 0, 5);
        $url = "https://api.pwnedpasswords.com/range/" . $first5Chars;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response_data = curl_exec($curl);
        $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response_errors = curl_error($curl);
        curl_close($curl);

        if ($response_code == 200) {
            $this->setDescription("Password was verified correctly.");
        } else {
            $this->setDescription("Password was error checked in haveibeenpwned.com " + $response_code);
        }
    }

    /**
     * @param $password
     * @return Message
     */
    public static function passwordStrengthCheck($password)
    {
        if (strlen($password) < 8) {
            return Message::init(false, "Password too short !!!");
        } else if (!preg_match("#[0-9]+#", $password)) {
            return Message::init(false, "Password must include at least one number !!!");
        } else if (!preg_match("#[a-zA-Z]+#", $password)) {
            return Message::init(false, "Password must include at least one letter !!!");
        } else if (!preg_match("#[A-Z]+#", $password)) {
            return Message::init(false, "Password must include at least one UPPER case letter!!!");
        } else if (!preg_match("/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:\"\<\>,\.\?\\\]/", $password)) {
            return Message::init(false, "Password must include at least one special character !!!");
        } else {
            return Message::status(true);
        }
    }
}
