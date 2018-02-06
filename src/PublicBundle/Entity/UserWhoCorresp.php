<?php

namespace PublicBundle\Entity;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * UserWhoCorresp
 */
class UserWhoCorresp
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $userWhoSearch;

    /**
     * @var array
     */
    private $userWhorCorresp;

    /**
     * @var dateTime
     */
    private $resultDate;

    /**
     * @return DateTime
     */
    public function getResultDate()
    {
        return $this->resultDate;
    }

    /**
     * @param DateTime $resultDate
     */
    public function setResultDate($resultDate)
    {
        $this->resultDate = $resultDate;
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
     * Set userWhoSearch
     *
     * @param string $userWhoSearch
     *
     * @return UserWhoCorresp
     */
    public function setUserWhoSearch($userWhoSearch)
    {
        $this->userWhoSearch = $userWhoSearch;

        return $this;
    }

    /**
     * Get userWhoSearch
     *
     * @return string
     */
    public function getUserWhoSearch()
    {
        return $this->userWhoSearch;
    }

    /**
     * Set userWhorCorresp
     *
     * @param array $userWhorCorresp
     *
     * @return UserWhoCorresp
     */
    public function setUserWhorCorresp($userWhorCorresp)
    {
        $this->userWhorCorresp = $userWhorCorresp;

        return $this;
    }

    /**
     * Get userWhorCorresp
     *
     * @return array
     */
    public function getUserWhorCorresp()
    {
        return $this->userWhorCorresp;
    }
}



