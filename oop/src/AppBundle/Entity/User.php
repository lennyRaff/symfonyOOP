<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $email;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @var string
     */
    private $old_password;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set old_password
     *
     * @param string $oldPassword
     * @return User
     */
    public function setOldPassword($oldPassword)
    {
        $this->old_password = $oldPassword;

        return $this;
    }

    /**
     * Get old_password
     *
     * @return string 
     */
    public function getOldPassword()
    {
        return $this->old_password;
    }
}
