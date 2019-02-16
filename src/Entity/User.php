<?php

namespace App\Entity;

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

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUserpassword()
    {
        return $this->userpassword;
    }

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

    public function getDescription()
    {
        return $this->description;
    }

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
     * @param $requestContent
     * @param $errors
     * @return array
     */
    public static function passwordStrengthCheck($password)
    {
        $pwd = $password;
        $errors = "";
        $passwordStrength = false;

        if (strlen($pwd) < 8) {
            $errors = "!!! Password too short! Please try a new password !!!";
        } else if (!preg_match("#[0-9]+#", $pwd)) {
            $errors = "!!! Password must include at least one number! Please try a new password !!!";
        } else if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors = "!!! Password must include at least one letter! Please try a new password !!!";
        } else if (!preg_match("#[A-Z]+#", $pwd)) {
            $errors = "!!! Password must include at least one UPPER case letter! Please try a new password !!!";
        } else if (!preg_match("/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:\"\<\>,\.\?\\\]/", $pwd)) {
            $errors = "!!! Password must include at least one special character! Please try a new password !!!";
        } else {
            $passwordStrength = true;
        }

        return array(
            "password_strength" => $passwordStrength,
            "error" => $errors,
            "password" => "password : " . $pwd
        );
    }
}
