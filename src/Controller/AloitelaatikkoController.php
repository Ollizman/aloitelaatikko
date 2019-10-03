<?php
namespace App\Controller;
use App\Entity\Aloitelaatikko;
use App\Controller\AloiteController;

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
       /* $aloite = new Aloitelaatikko();
        $aloite->setAihe('testi');
        $aloite->setKuvaus('asfadafs000');
        array_push($aloitteet, $aloite);*/
        return $this->render('index.html.twig', ['aloitteet' => $aloitteet]);
    }

   /**
    * @Route("aloitelaatikko/uusi", name="uusi")
    */
   public function aloitelaatikko(Request $request){

       $aloitelaatikko = new Aloitelaatikko();    
       $aloitelaatikko->setKirjauspvm(date("d / m / Y"));
       $form = $this->createFormBuilder($aloitelaatikko)
           ->setAction($this->generateUrl('uusi'))
           ->add('aihe', TextType::class, ['label' => 'Aloitteen aihe!'])
           ->add('kuvaus', TextType::class, ['label' => 'Kirjoita aloitteesi!'])
           ->add('etunimi',null,['required' => false])
           ->add('sukunimi', TextType::class)
           ->add('email', TextType::class)
           ->add('kirjauspvm', TextType::class, ['label' => 'Kirjauspäivämäärä'])
           ->add('Save', SubmitType::class, ['label' => 'Tallenna', 'attr' =>array('class' => 'btn btn-info mt-3')])
           ->getForm();

           //lomakkeen käsittely
           $form->handleRequest($request);
           //Painettiinko lähetä nappia
           if($form->isSubmitted()){
               //if true , käsitellään lomaketiedot
              
              $aloitelaatikko = $form->getData();
 
              $entityManager = $this->getDoctrine()->getManager();

              $entityManager->persist($aloitelaatikko);
      
              $entityManager->flush();
      
              return $this->render('lomakeLahetetty.html.twig', [
                  'pvm' => $aloitelaatikko->getKirjauspvm(),
                  'etunimi' => $aloitelaatikko->getEtunimi()   ]
              );
           }
           //Luo näkymän joka näyttää lomakkeen
           return $this->render("aloitelomake.html.twig",[
               'form1' => $form->createView()
           ]);
   }

}

?>