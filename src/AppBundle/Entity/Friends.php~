<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friends
 *
 * @ORM\Table(name="friends")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FriendsRepository")
 */
class Friends
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="follower", type="integer", nullable=true)
     */
    private $follower;

    /**
     * @var integer
     *
     * @ORM\Column(name="following", type="integer", nullable=true)
     */
    private $following;



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
     * Set follower
     *
     * @param integer $follower
     *
     * @return Friends
     */
    public function setFollower($follower)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return integer
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set following
     *
     * @param integer $following
     *
     * @return Friends
     */
    public function setFollowing($following)
    {
        $this->following = $following;

        return $this;
    }

    /**
     * Get following
     *
     * @return integer
     */
    public function getFollowing()
    {
        return $this->following;
    }
}
