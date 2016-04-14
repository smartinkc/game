<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Winner
 *
 * @ORM\Table(name="winner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WinnerRepository")
 */
class Winner
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
     * @ORM\Column(name="choice_id", type="integer")
     */
    private $choiceId;

    /**
     * @var string
     *
     * @ORM\Column(name="choice_lose", type="string")
     */
    private $choiceLose;


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
     * Set choiceId
     *
     * @param integer $choiceId
     *
     * @return Winner
     */
    public function setChoiceId($choiceId)
    {
        $this->choiceId = $choiceId;

        return $this;
    }

    /**
     * Get choiceId
     *
     * @return int
     */
    public function getChoiceId()
    {
        return $this->choiceId;
    }

    /**
     * Set choiceLose
     *
     * @param string $choiceLose
     *
     * @return Winner
     */
    public function setChoiceLose($choiceLose)
    {
        $this->choiceLose = $choiceLose;

        return $this;
    }

    /**
     * Get choiceLose
     *
     * @return string
     */
    public function getChoiceLose()
    {
        return $this->choiceLose;
    }
}

