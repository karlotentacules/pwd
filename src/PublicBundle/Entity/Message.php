<?php

namespace PublicBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 */
class Message
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $idSender;

    /**
     * @var string
     */
    private $idReceiver;
    /**
     * @var boolean
     */
    private $flag;
    /**
     * @var boolean
     */
    private $messageEnabled;

    /**
     * @var string
     */
    private $messageText;

    /**
     * @ORM\Column(type="string")
     *
    /**
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Please upload a valid type: jpeg,gif,png"
     * )
     */
    private $messageImage;


    /**
     * Set messageImage
     *
     * @param string $messageImage
     *
     * @return Message
     */
    public function setMessageImage($messageImage)
    {
        $this->messageImage = $messageImage;

        return $this;
    }

    /**
     * Get messageImage
     *
     * @return string
     */
    public function getMessageImage()
    {
        return $this->messageImage;
    }







    private $dateMessageSend;

    /**
     * @return mixed
     */
    public function getDateMessageSend()
    {
        return $this->dateMessageSend;
    }

    /**
     * @param mixed $dateMessageSend
     */
    public function setDateMessageSend($dateMessageSend)
    {
        $this->dateMessageSend = $dateMessageSend;
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
     * Set idSender
     *
     * @param string $idSender
     *
     * @return Message
     */
    public function setIdSender($idSender)
    {
        $this->idSender = $idSender;

        return $this;
    }

    /**
     * Get idSender
     *
     * @return string
     */
    public function getIdSender()
    {
        return $this->idSender;
    }

    /**
     * Set idReceiver
     *
     * @param string $idReceiver
     *
     * @return Message
     */
    public function setIdReceiver($idReceiver)
    {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    /**
     * Get idReceiver
     *
     * @return string
     */
    public function getIdReceiver()
    {
        return $this->idReceiver;
    }

    /**
     * Set messageText
     *
     * @param string $messageText
     *
     * @return Message
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;

        return $this;
    }

    /**
     * Get messageText
     *
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * @return bool
     */
    public function isFlag()
    {
        return $this->flag;
    }

    /**
     * @param bool $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return bool
     */
    public function isMessageEnabled()
    {
        return $this->messageEnabled;
    }

    /**
     * @param bool $messageEnabled
     */
    public function setMessageEnabled($messageEnabled)
    {
        $this->messageEnabled = $messageEnabled;
    }




}

