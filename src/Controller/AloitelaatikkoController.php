<?php
namespace App\Controller;
use App\Entity\Aloitelaatikko;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AloitelaatikkoController extends AbstractController{
   /**
    * @Route("aloitelaatikko", name="aloitelaatikko")
    */
   public function aloitelaatikko(Request $request){
       $aloitelaatikko = new Aloitelaatikko();
       $aloitelaatikko->setEmail("");
       $form = $this->createFormBuilder($aloitelaatikko)
           ->setAction($this->generateUrl('aloitelaatikko'))
           ->add('Etunimi',null,['required' => false])
           ->add('Sukunimi', TextType::class)
           ->add('Email', TextType::class)
           ->add('Kirjauspvm',DateType::class, ['label' => 'Kirjauspäivämäärä'])
           ->add('Save', SubmitType::class, ['label' => 'Tallenna', 'attr' =>array('class' => 'btn btn-info mt-3')])
           ->getForm();

           //lomakkeen käsittely
           $form->handleRequest($request);
           //Painettiinko lähetä nappia
           if($form->isSubmitted()){
               //if true , käsitellään lomaketiedot
              // var_dump($henkilo);
              $aloitelaatikko = $form->getData();
                // return new Response($henkilo->getEtunimi());

                // return new JsonResponse((Array)$henkilo);
              // return $this->redirectToRoute('valmis');
              return $this->render('lomakeLahetetty.hmtl.twig', [
                  'pvm' => $aloitelaatikko->getKirjauspvm()   ]
              );
           }
           //Luo näkymän joka näyttää lomakkeen
           return $this->render("aloitelomake.html.twig",[
               'form1' => $form->createView()
           ]);
   }

}

?>