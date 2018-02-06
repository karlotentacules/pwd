<?php
/**
 * Created by PhpStorm.
 * User: karl
 * Date: 23/01/18
 * Time: 9:34
 */

namespace AdminBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserAdmin
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class UserAdmin extends BaseUser
{




    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */


    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * @param mixed $facebook_id
     */
    public function setFacebookId($facebook_id)
    {
        $this->facebook_id = $facebook_id;
    }

    /**
     * @return mixed
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * @param mixed $facebook_access_token
     */
    public function setFacebookAccessToken($facebook_access_token)
    {
        $this->facebook_access_token = $facebook_access_token;
    }
    /**
     * @return mixed
     */
    public function getFacebookEmail()
    {
        return $this->facebook_email;
    }

    /**
     * @param mixed $facebook_email
     */
    public function setFacebookEmail($facebook_email)
    {
        $this->facebook_email = $facebook_email;
    }




    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;
    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;


    /** @ORM\Column(name="facebook_email", type="string", length=255, nullable=true) */
    protected $facebook_email;
    /** @ORM\Column(name="birthDay", type="string", length=255, nullable=true) */
    protected $birthDay;
    /** @ORM\Column(name="gender", type="string", length=255, nullable=true) */
    protected $gender;
    /** @ORM\Column(name="searchingFor", type="string", length=255, nullable=true) */
    private $searchingFor;
    /** @ORM\Column(name="interest", type="array", length=255, nullable=true) */
    protected $interest;
    /**
     * @return mixed
     */
    public function getSearchingFor()
    {
        return $this->searchingFor;
    }

    /**
     * @param mixed $searchingFor
     */
    public function setSearchingFor($searchingFor)
    {
        $this->searchingFor = $searchingFor;
    }

    /**
     * @return mixed
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param mixed $interest
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
    }


    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param mixed $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
    }






    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }


    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }



    public function __construct()
    {
        parent::__construct();

    }

}
