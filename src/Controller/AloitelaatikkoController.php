<?php
namespace App\Controller;
use App\Entity\Aloitelaatikko;
use App\Controller\AloiteController;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AloitelaatikkoController extends AbstractController{

      /**
    * @Route("aloitelaatikko", name="aloitteet")
    */
    public function index() {
       
        $repository = $this->getDoctrine()->getRepository(Aloitelaatikko::class);
        $aloitteet = $repository->findAll();

        return $this->render('index.html.twig', ['aloitteet' => $aloitteet]);
    }

   /**
    * @Route("aloitelaatikko/uusi", name="uusi")
    */
   public function aloitelaatikko(Request $request){

       $aloitelaatikko = new Aloitelaatikko();    
    
       $form = $this->createFormBuilder($aloitelaatikko)
          // ->setAction($this->generateUrl('uusi'))
           ->add('aihe', TextType::class, ['label' => 'Aloitteen aihe!'])
           ->add('kuvaus', TextType::class, ['attr' => ['maxlength' => 800], 'label' => 'Kirjoita aloitteesi!'])
           ->add('etunimi', TextType::class, ['required' => false])
           ->add('sukunimi', TextType::class, ['required' => false])
           ->add('email', TextType::class)
           ->add('kirjauspvm', DateType::class, ['label' => 'Kirjauspäivämäärä'])
           ->add('Save', SubmitType::class, ['label' => 'Tallenna', 'attr' =>array('class' => 'btn btn-info mt-3')])
           ->getForm();
           

           //lomakkeen käsittely
           $form->handleRequest($request);
           //Painettiinko lähetä nappia
           if($form->isSubmitted()){
               //if true , käsitellään lomaketiedot
              
              $aloitelaatikko = $form->getData();
 
              $entityManager = $this->getDoctrine()->getManager();

              // tell Doctrine you want to (eventually) save the aloite (no queries yet)
              $entityManager->persist($aloitelaatikko);
      
              // actually executes the queries (i.e. the INSERT query)
              $entityManager->flush();

      
              return $this->render('lomakeLahetetty.html.twig', [
                  'pvm' => $aloitelaatikko->getKirjauspvm(),
                  'etunimi' => $aloitelaatikko->getEtunimi()  ]
              );
           }
           
           //Luo näkymän joka näyttää lomakkeen
           return $this->render("aloitelomake.html.twig",[
               'form1' => $form->createView(),
           ]);
           
   }
      /**
    * @Route("aloitelaatikko/poista/{id}", name="poista")
    */
   public function poistaAloite($id) {
    $entityManager = $this->getDoctrine()->getManager();
    $poistettavaAloite = $entityManager->getRepository(Aloitelaatikko::class)->find($id);
    
    $entityManager->remove($poistettavaAloite);
    $entityManager->flush();

    return $this->redirectToRoute('aloitteet');

   }

         /**
    * @Route("aloitelaatikko/muokkaa/{id}", name="muokkaa")
    */
   public function muokkaaAloitetta(Request $request, $id) {
    $entityManager = $this->getDoctrine()->getManager();
    $muokattavaAloite = $entityManager->getRepository(Aloitelaatikko::class)->find($id);

    $form = $this->createFormBuilder($muokattavaAloite)
    //->setAction($this->generateUrl('aloitteet'))
    ->add('aihe', TextType::class, ['label' => 'Aloitteen aihe!'])
    ->add('kuvaus', TextType::class, ['attr' => ['maxlength' => 800], 'label' => 'Kirjoita aloitteesi!'])
    ->add('etunimi', TextType::class, ['required' => false])
    ->add('sukunimi', TextType::class, ['required' => false])
    ->add('email', TextType::class)
    ->add('kirjauspvm', DateType::class, ['label' => 'Kirjauspäivämäärä'])
    ->add('Save', SubmitType::class, ['label' => 'Tallenna', 'attr' =>array('class' => 'btn btn-info mt-3')])
    ->getForm();

    $form->handleRequest($request);
    if($form->isSubmitted()) {
        //Tallennetaan muokatut lomaketiedot muokattavaan aloitteeseen.
        $muokattavaAloite = $form->getData();
        //TAllennetaan tietokantaan
        $entityManager->flush();

        return $this->redirectToRoute('aloitteet');
    }
    
    return $this->render("muokkaaAloitetta.html.twig",[
        'form1' => $form->createView(),
    ]);
}

     /**
    * @Route("aloitelaatikko/nayta/{id}", name="nayta")
    */
    public function naytaAloite($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $muokattavaAloite = $entityManager->getRepository(Aloitelaatikko::class)->find($id);

        return $this->render('naytaAloite.html.twig', [
            'aloite' => $muokattavaAloite
            // 'id' => $id,
            // 'aihe' => $muokattavaAloite->getAihe(),
            // 'kuvaus' => $muokattavaAloite->getKuvaus(),
            // 'etunimi' => $muokattavaAloite->getEtunimi(),
            // 'sukunimi' => $muokattavaAloite->getSukunimi(),
            // 'email' => $muokattavaAloite->getEmail(),
            // 'pvm' => $muokattavaAloite->getKirjauspvm()
            ]
        );


    }


}

?>