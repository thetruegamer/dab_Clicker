<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Characters
 *
 * @ORM\Table(name="characters")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CharactersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Characters
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="dabs", type="integer")
     */
    private $dabs;

    /**
     * @var int
     *
     * @ORM\Column(name="double_dabs", type="integer")
     */
    private $double_dabs;

    /**
     * @var int
     *
     * @ORM\Column(name="massons", type="integer")
     */
    private $massons;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    // private $is_active;

    /**
     * @var string
     *
     * @ORM\Column(name="messages", type="string", length=255)
     */
    private $messages;


    /**
     * @ORM\PrePersist
     */
    // on rentre les valeurs par défaut : toutes à 0 lors de la création d'un perso
    public function setCreatedAtValue()
    {
        // $this->is_active = false;
        $this->dabs = 0;
        $this->createdAt = new \DateTime();
        $this->double_dabs = 0;
        $this->massons = 0;
        $this->messages = "";
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dabs
     *
     * @param integer $dabs
     *
     * @return Characters
     */
    public function setDabs($dabs)
    {
        $this->dabs = $dabs;

        return $this;
    }

    /**
     * Get dabs
     *
     * @return int
     */
    public function getDabs()
    {
        return $this->dabs;
    }

    /**
     * Set doubleDabs
     *
     * @param integer $doubleDabs
     *
     * @return Characters
     */
    public function setDoubleDabs($doubleDabs)
    {
        $this->doubleDabs = $doubleDabs;

        return $this;
    }

    /**
     * Get doubleDabs
     *
     * @return int
     */
    public function getDoubleDabs()
    {
        return $this->doubleDabs;
    }

    /**
     * Set massons
     *
     * @param integer $massons
     *
     * @return Characters
     */
    public function setMassons($massons)
    {
        $this->massons = $massons;

        return $this;
    }

    /**
     * Get massons
     *
     * @return int
     */
    public function getMassons()
    {
        return $this->massons;
    }


    /**
     * Set messages
     *
     * @param string $messages
     *
     * @return Characters
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
     * Get messages
     *
     * @return string
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Characters
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Characters
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * to String
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Characters
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
