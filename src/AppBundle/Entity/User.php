<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     *
     * @ORM\Column(type="string", length=100, name="first_name")
     * @Assert\Regex(pattern="/^[a-z ùéàçè]+$/i", message="Pas de charactére speciaux dans ce champs")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     *
     * @ORM\Column(type="string", length=100, name="last_name")
     * @Assert\Regex(pattern="/^[a-z ùéàçè]+$/i", message="Pas de charactére speciaux dans ce champs")
     * @Assert\NotBlank()
     */
    private $lastName;



    public function __construct()
    {
        parent::__construct();
        $this->isEnabled(true);

    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRealRole()
    {
        if($this->hasRole('ROLE_ADMIN') || $this->hasRole('ROLE_SUPER_ADMIN'))  return 'ROLE_ADMIN';
        if($this->hasRole('ROLE_CHEF'))  return 'ROLE_CHEF';
        if($this->hasRole('ROLE_CONSULTANT'))  return 'ROLE_CONSULTANT';

    }
    /**
     * Get role
     *
     * @return string
     */
    public function getPlainRole()
    {
        if($this->hasRole('ROLE_ADMIN') || $this->hasRole('ROLE_SUPER_ADMIN'))  return 'Administrateur';
        if($this->hasRole('ROLE_CHEF'))  return 'Chef de parc';
        if($this->hasRole('ROLE_CONSULTANT'))  return 'Consultant';

    }

}
