<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Games
 *
 * @ORM\Table(name="games")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GamesRepository")
 */
class Games
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
     * @var string
     *
     * @ORM\Column(name="session", type="string", length=255)
     */
    private $session;

    /**
     * @var int
     *
     * @ORM\Column(name="winner", type="integer")
     */
    private $winner;

    /**
     * @var int
     *
     * @ORM\Column(name="userChoice", type="integer")
     */
    private $userChoice;

    /**
     * @var int
     *
     * @ORM\Column(name="computerChoice", type="integer")
     */
    private $computerChoice;


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
     * Set session
     *
     * @param string $session
     *
     * @return Games
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set winner
     *
     * @param integer $winner
     *
     * @return Games
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return int
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set userChoice
     *
     * @param integer $userChoice
     *
     * @return Games
     */
    public function setUserChoice($userChoice)
    {
        $this->userChoice = $userChoice;

        return $this;
    }

    /**
     * Get userChoice
     *
     * @return int
     */
    public function getUserChoice()
    {
        return $this->userChoice;
    }

    /**
     * Set computerChoice
     *
     * @param integer $computerChoice
     *
     * @return Games
     */
    public function setComputerChoice($computerChoice)
    {
        $this->computerChoice = $computerChoice;

        return $this;
    }

    /**
     * Get computerChoice
     *
     * @return int
     */
    public function getComputerChoice()
    {
        return $this->computerChoice;
    }
}

