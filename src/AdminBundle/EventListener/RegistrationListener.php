<?php
/**
 * Created by PhpStorm.
 * User: karl
 * Date: 23/01/18
 * Time: 12:22
 */

namespace AdminBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(){

        return array(
            FOSUserEvents::REGISTRATION_SUCCESS=>'onRegistrationSuccess'
        );
    }
    public function onRegistrationSuccess(FormEvent $event){
        $roles = array('ROLE_ADMIN');

        $user = $event->getform()->getData();
        $user->setRoles($roles);
    }
    public function __construct()
    {

    }
}