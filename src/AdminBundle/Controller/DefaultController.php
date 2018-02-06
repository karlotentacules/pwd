<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use src\PublicBundle\Entity\Message;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {


        $users = $this->getDoctrine()->getRepository('AdminBundle:userAdmin')->findBy(array(
            'enabled' => true
        ));




            $messageReceives = $this->getDoctrine()->getRepository('PublicBundle:Message')->findBy(array(
                'flag' => true,
                'messageEnabled'=>true
            ));


        $messages = $this->get('knp_paginator')->paginate(
            $messageReceives,
            $request->query->get('page', 1),
            3
        );
        return $this->render('AdminBundle:Default:index.html.twig', array(
            'messages'=>$messages,
            'users'=>$users
    ));

    }
    public function loginRedirectAction(){
        return $this->redirect($this->generateUrl('home'));
    }

    public function banUserAction(Request $request){
        $idUserWhoGetBan = $request->query->get('id');
        $user = $this->getDoctrine()->getRepository('AdminBundle:UserAdmin')->find($idUserWhoGetBan);
        $user->setEnabled(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);

        $em->flush();


        $messagesFromUserBan = $this->getDoctrine()->getRepository('PublicBundle:Message')->findBy(array(
            'idSender' => $idUserWhoGetBan
        ));

        foreach ($messagesFromUserBan as $item){
            $item->setMessageEnabled(false);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($item);

        $em->flush();



        return $this->render('AdminBundle:ban:banConfirm.html.twig', array(
            'idUserWhoGetBan' =>$idUserWhoGetBan
        ));
    }


}
