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
     * @ORM\Column(name="dank_memes", type="integer")
     */
    private $dank_memes;

    /**
     * @var int
     *
     * @ORM\Column(name="dab_inc", type="integer")
     */
    private $dab_inc;

     /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer")
     */
    private $cost;

    /**
     * @var int
     *
     * @ORM\Column(name="used_massons", type="integer")
     */
    private $used_massons;

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
        $this->dabs = 0;
        $this->dab_inc = 1;
        $this->dank_memes = 0;
        $this->cost = 10;
        $this->createdAt = new \DateTime();
        $this->massons = 10;
        $this->used_massons = 0;
        $this->messages = "";
    }


    /**
     * Get id
     *
     * @return int
     */
    public function calculateMassons()
    {
        $actualDate = time();
        $maxMassonsPossible = ($actualDate - $this->createdAt->getTimestamp())/3600;

        $actualMassons = $maxMassonsPossible - $this->used_massons + $this->massons;

        return (int) $actualMassons;
    }


    // fonction similaire à un setUsedMassons(used_massons+1) mais pour la clarté c'est sympa
    public function useOneMasson()
    {
        $this->used_massons += 1;
    }

    // le prix des dank memes augmente de façon random décidée par moi, j'ai pas fait d'UE théorie des jeux, déso pas déso
    public function calculateCost()
    {
        $this->cost += $this->cost*2;
    }

    // petite fontion booléenne qui renvoie true si on peut acheter, false sinon
    function canBuy()
    {
        if ($this->cost > $this->dabs)
            return false;
        else if ($this->calculateMassons() > 0)
            return true;
        else
            return false;
    }

    // idem pour là, c'est plus du sucre syntaxique qu'un truc vraiment nécéssaire
    public function buyOneDankMeme()
    {
        $this->dank_memes += 1;
        $this->dabs = $this->dabs - $this->cost;
        $this->used_massons += 1;
        $this->updateInc();
        $this->calculateCost();
    }

    public function updateInc()
    {
        $this->dab_inc = $this->dab_inc + (2*$this->dank_memes);
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


    /**
     * Set usedMassons
     *
     * @param integer $usedMassons
     *
     * @return Characters
     */
    public function setUsedMassons($usedMassons)
    {
        $this->used_massons = $usedMassons;

        return $this;
    }

    /**
     * Get usedMassons
     *
     * @return integer
     */
    public function getUsedMassons()
    {
        return $this->used_massons;
    }

    /**
     * Set dankMemes
     *
     * @param integer $dankMemes
     *
     * @return Characters
     */
    public function setDankMemes($dankMemes)
    {
        $this->dank_memes = $dankMemes;

        return $this;
    }

    /**
     * Get dankMemes
     *
     * @return integer
     */
    public function getDankMemes()
    {
        return $this->dank_memes;
    }

    /**
     * Set dabInc
     *
     * @param integer $dabInc
     *
     * @return Characters
     */
    public function setDabInc($dabInc)
    {
        $this->dab_inc = $dabInc;

        return $this;
    }

    /**
     * Get dabInc
     *
     * @return integer
     */
    public function getDabInc()
    {
        return $this->dab_inc;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Characters
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }
}
