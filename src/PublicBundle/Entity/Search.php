<?php

namespace PublicBundle\Entity;

/**
 * Search
 */
class Search
{

    /**
     * @ORM\OneToOne(targetEntity="AdminBundle\Entity\UserAdmin", cascade={"persist"})
     * @ORM\JoinColumn(name="user_Id", referencedColumnName="id")

     */
    const FOR_LOVE = "LOVE";
    const FOR_FRIENDSHIP = "FRIENDSHIP";

    const FOR_CHOICES_FOR = [self::FOR_LOVE=>self::FOR_LOVE,self::FOR_FRIENDSHIP=>self::FOR_FRIENDSHIP];

    const FOR_MALE = "MALE";
    const FOR_FEMALE = "FEMALE";

    const  FOR_CHOICES_GENDER = [self::FOR_MALE=>self::FOR_MALE, self::FOR_FEMALE=>self::FOR_FEMALE];

    const FOR_ART = "ART";
    const FORT_SPORT = "SPORT";

    const  FOR_CHOICES_INTEREST = [self::FOR_ART=>self::FOR_ART, self::FORT_SPORT=>self::FORT_SPORT];

    CONST FOR_13_18 = "13-18";
    CONST FOR_18_25= "18-25";
    CONST FOR_25_35 = "25-35";
    CONST FOR_35_45= "35-45";

    const FOR_CHOICES_AGES = [self::FOR_13_18=>self::FOR_13_18,self::FOR_18_25=>self::FOR_18_25,self::FOR_25_35=>self::FOR_25_35,self::FOR_35_45=>self::FOR_35_45];


    private $user;

    /**
     * Search constructor.
     * @param $user
     */

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    private $date;








    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $searchingFor ;

    /**
     * @var string
     */
    private $searchingGender;

    /**
     * @var string
     */
    private $searchingDist;

    /**
     * @var string
     */
    private $searchingInterest;

    /**
     * @var string
     */
    private $searchingAge;


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
     * Set searchingFor
     *
     * @param string $searchingFor
     *
     * @return Search
     */
    public function setSearchingFor($searchingFor)
    {
        $this->searchingFor = $searchingFor;

        return $this;
    }

    /**
     * Get searchingFor
     *
     * @return string
     */
    public function getSearchingFor()
    {
        return $this->searchingFor;
    }

    /**
     * Set searchingGender
     *
     * @param string $searchingGender
     *
     * @return Search
     */
    public function setSearchingGender($searchingGender)
    {
        $this->searchingGender = $searchingGender;

        return $this;
    }

    /**
     * Get searchingGender
     *
     * @return string
     */
    public function getSearchingGender()
    {
        return $this->searchingGender;
    }

    /**
     * Set searchingDist
     *
     * @param string $searchingDist
     *
     * @return Search
     */
    public function setSearchingDist($searchingDist)
    {
        $this->searchingDist = $searchingDist;

        return $this;
    }

    /**
     * Get searchingDist
     *
     * @return string
     */
    public function getSearchingDist()
    {
        return $this->searchingDist;
    }

    /**
     * Set searchingInterest
     *
     * @param string $searchingInterest
     *
     * @return Search
     */
    public function setSearchingInterest($searchingInterest)
    {
        $this->searchingInterest = $searchingInterest;

        return $this;
    }

    /**
     * Get searchingInterest
     *
     * @return string
     */
    public function getSearchingInterest()
    {
        return $this->searchingInterest;
    }

    /**
     * Set searchingAge
     *
     * @param string $searchingAge
     *
     * @return Search
     */
    public function setSearchingAge($searchingAge)
    {
        $this->searchingAge = $searchingAge;

        return $this;
    }

    /**
     * Get searchingAge
     *
     * @return string
     */
    public function getSearchingAge()
    {
        return $this->searchingAge;
    }



}

