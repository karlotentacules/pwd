<?php

namespace PublicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
use PublicBundle\Entity\Search;
use PublicBundle\Entity\Message;
use PublicBundle\Entity\UserWhoCorresp;
use PublicBundle\Form\SearchType;
use PublicBundle\Form\MessageType;
use PublicBundle\PublicBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class DefaultController extends Controller
{
    public function indexAction()
    {
        $currentUser = $this->getUser();
        if($currentUser == null){
        return $this->render('PublicBundle:Home:home.html.twig');
        }else{
            return $this->redirect($this->generateUrl('profil'));
        }

    }

    public function profilAction(Request $request){
//     noOneFOund me servira plus tard pour rajouter : recherche non fructueuse avec ces parametres
        $noOneFound= null;
        $userWhoCorresps = array();
        $userId=$this->getUser()->getId();
        $currentUser = $this->getUser();

        // On crée un objet search
        $search = new Search();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(SearchType::class, $search);

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $search contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                $search->setUser($userId);
                $date=$this->date = new \DateTime();
                $search->setDate($date);
                $genderSearch= $search->getSearchingGender();
                $interestSearch = $search->getSearchingInterest();
                $forSearching = $search->getSearchingFor();
                $ageSearching = $search->getSearchingAge();
//                $currentInterest =$search->getSearchingInterest();
                $currentUser->setInterest($interestSearch);
                $currentUser->setsearchingFor($forSearching);
                // On enregistre notre objet  dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($search);

                $em->flush();

                /*Methode pour faire ma recherche sur le param age */
                /*date of the day*/
                $actualDate = new \ DateTime();
                $actualDateString = $date->format('Y-m-d');
                $ageSearchingMin='';
                $ageSearchingMax='';
                $ageMin='';
                $ageMax='';
//                je recupere toutes les cases cochées et recupere le max et le min
                foreach ($ageSearching as $key => $value){
                    if($ageSearchingMin == ''){
                    $ageSearchingMin = $value;
                    $ageMin = explode("-", $ageSearchingMin);
                    $ageMin= $ageMin[0];
                    }
                    $ageSearchingMax = $value;
                    $ageMax = explode("-", $ageSearchingMax);
                    $ageMax = $ageMax[1];
                };
//                var_dump($ageMin);
//                var_dump($ageMax);
                //Je recupere la date d auj et l eclate pour pouvoir recuperer les années, mois, jours
                $actualDateExplode = explode("-", $actualDateString);
//                var_dump($actualDateExplode);
                $oldestYearOfBirth=$actualDateExplode[0]-$ageMax;
                $youngestYearOfBirth=$actualDateExplode[0]-$ageMin;
               /* var_dump($youngestYearOfBirth);
                var_dump($oldestYearOfBirth);
                die();*/
                $monthOfBirthToCorresp=$actualDateExplode[1];
                $dayOfBirthToCorresp=$actualDateExplode[2];



//                var_dump($interestSearch);
                //Une premiere selection est effectuée sans prendre l'age en compte
                $userWhoCorresps= $this->getDoctrine()->getRepository('AdminBundle:UserAdmin')->findBy(array(
                    'interest'=>$interestSearch,
                    'gender'=>$genderSearch,
                    'searchingFor' =>$forSearching,

                 ));

                //transfomration de la date de naissance en l explosant pour pouvoir la comparer a la date actuelle
                $userWhoCorrespFinally=array();
                foreach ($userWhoCorresps as $item) {
                    $userWhoCorresp = $item;
                    $userWhoCorrespBirthDay=$userWhoCorresp->getBirthDay();
                    $userWhoCorrespBirthDayExplode = explode("/",$userWhoCorrespBirthDay);
                    $userWhoCorrespBirthDayDay = $userWhoCorrespBirthDayExplode[0]  ;
                    $userWhoCorrespBirthDayMonth = $userWhoCorrespBirthDayExplode[1]  ;
                    $userWhoCorrespBirthDayYear = $userWhoCorrespBirthDayExplode[2] ;
//                   var_dump($youngestYearOfBirth);
//                    var_dump($oldestYearOfBirth);
                    if (($oldestYearOfBirth < $userWhoCorrespBirthDayYear) && ($userWhoCorrespBirthDayYear < $youngestYearOfBirth) ){
                        $userWhoCorrespFinally[] =  $userWhoCorresp;
                    }elseif (($oldestYearOfBirth == $userWhoCorrespBirthDayYear || $userWhoCorrespBirthDayYear == $youngestYearOfBirth)&&($userWhoCorrespBirthDayMonth > $monthOfBirthToCorresp) ){
                            $userWhoCorrespFinally[] =   $userWhoCorresp;
                        }elseif (($oldestYearOfBirth == $userWhoCorrespBirthDayYear || $userWhoCorrespBirthDayYear == $youngestYearOfBirth)&&($userWhoCorrespBirthDayMonth = $monthOfBirthToCorresp)&&($userWhoCorrespBirthDayDay < $dayOfBirthToCorresp)){
                            $userWhoCorrespFinally[] =   $userWhoCorresp;

                    }

               }
//                    var_dump($userWhoCorrespFinally);

                $id= array();
                /*pas super propre je redefinis les utiliseur selectionnes par ceux selectionnés correspondant niv age , histoire de pas changer tout ds twig etc*/
                $userWhoCorresps = $userWhoCorrespFinally;

                //ne marche pas pour le moment je le fais a la main dans twig
                if(empty($userWhoCorresps)){
                    $noOneFound =  'no one found with there params';
                }else{
                    /*enregistre aussi celui qui effectue la recherche ds les correspondants*/
                    foreach ($userWhoCorresps as $item){

                       $userWhoCorresp = $item;
                       $userWhoCorrespId[] = $userWhoCorresp->getId();
                   }
                    var_dump($userWhoCorrespId);
                    /*Set de la table utilisateurs correspondants a la recherche*/
                    $userCorresp = new UserWhoCorresp();
                    $userCorresp->setUserWhorCorresp($userWhoCorrespId);
                    $userCorresp->setUserWhoSearch($userId);
                    $date=$this->date = new \DateTime();
                    $userCorresp->setResultDate($date);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($userCorresp);

                    $em->flush();
                }}





        }
        //recupere les messages recu pour l utilisateur connecté
        $messageReceives= $this->getDoctrine()->getRepository('PublicBundle:Message')->findBy(array(
            'idReceiver' => $userId,
            'messageEnabled'=>true
        ));

        $messages = $this->get('knp_paginator')->paginate(
            $messageReceives,
            $request->query->get('page', 1),
            1
        );


        return $this->render('PublicBundle:Profil:profil.html.twig', array(
            'searchForm' => $form->createView(),
            'userWhoCorresps' => $userWhoCorresps,
            'messageReceives' =>$messageReceives,
            'messages'=>$messages,
//            'noOneFound'=>$noOneFound

        ));


    }
    //function de signalement de message
    public function messageFlagAction(Request $request){
        $idMessageToFlag= $request->query->get('id');
        $messageFlag= $this->getDoctrine()->getRepository('PublicBundle:Message')->find($idMessageToFlag);
        $messageFlag->setFlag(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($messageFlag);

        $em->flush();

        return $this->render('PublicBundle:signalement:signalement.html.twig', array(
            'messageFlag' => $messageFlag



        ));


    }
    //fonction d'envois de message
    public function messageAction(Request $request){
        $currentUserId=$this->getUser()->getId();
        $message = new Message();
        $receiverUser = $request->query->get('id');

        $form = $this->createForm(MessageType::class, $message);

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                $message->setIdSender($currentUserId);
                $message->setIdReceiver($receiverUser);
                $messageTexteSend = $message->getMessageText();
                $message->setMessageText($messageTexteSend);
                $message->setFlag(false);
                $message->setMessageEnabled(true);
//                $messageImgSend = $message->getMessageImage();
                $file = $message->getMessageImage();
                if($file != null){
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // Move the file
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $message->setMessageImage($fileName);}

//                $message->setMessageImage($messageImgSend);
                $date=$this->date = new \DateTime();
                $message->setDateMessageSend($date);



                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);

                $em->flush();


                echo '

                    <div class="col-md-1"></div>

                    <div class="col-md-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2>Notification</h2>
                        </div>
                        <div class="panel-body">
                            <p>le message à bien été envoyé, vous pouvez clore cette page ou envoyer un autre message au même destinataire</p>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="clearfix"></div>';


            }}

                return $this->render('PublicBundle:form:messageForm.html.twig', array(
                'messageForm' => $form->createView(),
                    


                ));

    }



    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
