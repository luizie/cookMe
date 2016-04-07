<?php

namespace AppBundle\Controller;

/*use Doctrine\DBAL\Types\TextType;*/
use AppBundle\Entity\rezept;
use Symfony\Component\Debug\Debug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Unirest;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/user-dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('user-dashboard/dashboard.html.twig',$this->formrezeptAction($request)
            );
    }

    public function formrezeptAction($request){
        $form = $this->createFormBuilder()
            ->add('Zutaten',TextType:: class, array('required' => false,
                'attr' => array('class' => 'form-control')))
            ->getForm();
        $form->handleRequest($request);
        $suchbegriff= null;
        $title= null;
        $image= null;
        #$sourceUrl = null;
        $id = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $suchbegriff = $form["Zutaten"]->getData();
            $title = $this->recipesAction($suchbegriff);
            $image = $this->imagesAction($suchbegriff);
            $id = $this ->getIdAction($suchbegriff);
            # $sourceUrl = $this->getUrlAction($id);
        }
        return
            array('form' => $form->createView(),
                'title'=> $title,
                'image'=> $image,
                #'sourceUrl' => $sourceUrl,
                'id' =>$id

            );
    }

    /**
     * Hier ist der Code für die Abfrage der API
     */

    /**
     * @Route("/search", name="demo_recipes")
     */
    public function recipesAction($suchbegriff)
    {
        if($suchbegriff != null)
        {
        $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?ingredients=".$suchbegriff."&limitLicense=false&number=5&ranking=1",
            array(
                "X-Mashape-Key" => "Y225bSkW3BmshYm7JN2dRnyA0P1Xp1frv1bjsnq7xhpZ4CV05s",
                "Accept" => "application/json"
            ));

            return $response->body[0]->title;
        }
        return "Keine Suchbegriffe";

    }

    public function imagesAction($suchbegriff)
    {
        if($suchbegriff != null)
        {
            $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?ingredients=".$suchbegriff."&limitLicense=false&number=5&ranking=1",
                array(
                    "X-Mashape-Key" => "Y225bSkW3BmshYm7JN2dRnyA0P1Xp1frv1bjsnq7xhpZ4CV05s",
                    "Accept" => "application/json"
                ));

            return $response->body[0]->image;
        }
        return "Keine Suchbegriffe";

    }

   /*  public function getUrlAction($id)
     {
         if($id != null) {
             $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/.$id./information?includeNutrition=false",
                 array(
                     "X-Mashape-Key" => "NC1TuLMWqWmshPVApoF33XxX3zfzp1lIkawjsn4XowAljjweAU",
                     "Accept" => "application/json"));
             return $response->body[]-sourceUrl;}

    return "Keine Suchbegriffe";
     }
   */

    public function getIdAction($suchbegriff)
    {
        if($suchbegriff != null)
        {
            $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?ingredients=".$suchbegriff."&limitLicense=false&number=5&ranking=1",
                array(
                    "X-Mashape-Key" => "Y225bSkW3BmshYm7JN2dRnyA0P1Xp1frv1bjsnq7xhpZ4CV05s",
                    "Accept" => "application/json"
                ));

            return $response->body[0]->id;
        }
        return "Keine Suchbegriffe";

    }




    /**
     * @Route("/rezeptErstellen", name="rezeptErstellen")
     */

   public function rezeptErstellenAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $rezept = new rezept();


        $recipeForm = $this->createFormBuilder()
            ->add('Titel', TextType::class, array('required' => true,
                                                    'attr' => array('class' => 'form-control')))
            ->add('Beschreibung', TextareaType::class,array('required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('Zutaten', TextType::class,array('required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('BildURL', UrlType::class,array('required' => false,
                'attr' => array('class' => 'form-control')))
            ->getForm();

        $recipeForm->handleRequest($request);

            if ($recipeForm->isSubmitted() && $recipeForm->isValid()) {

                $usr = $this->getUser();

                $rezept->setTitle($recipeForm["Titel"]->getData());
                $rezept->setDiscription($recipeForm["Beschreibung"]->getData());
                $rezept->setZutaten($recipeForm["Zutaten"]->getData());
                $rezept->setImage($recipeForm["BildURL"]->getData());
                if($recipeForm["BildURL"]-> getData() == "")
                {
                    $rezept->setImage("http://www.feuerwehr-andelsbuch.at/wp-content/uploads/2013/05/Platzhalter.jpg");
                }
                $rezept->setAuthor($usr->getUsername());

                $em=$this->getDoctrine()->getManager();
                $em->persist($rezept);
                $em->flush();
                return $this->redirectToRoute('rezepteAnzeigen');
               }

        return $this->render('rezeptseite/rezeptErstellen.html.twig', array('form'=>$recipeForm->createView()));
    }


    /**
     * @Route("/rezepteAnzeigen", name="rezepteAnzeigen")
     */


    public function rezepteAnzeigenAction()
    {
        $usr = $this->getUser();

        $repository = $this->getDoctrine()->getRepository('AppBundle:rezept');
        $rezepte = $repository->findAll();
        $userRezepte = array();
        foreach ($rezepte as $rezept){
            if($rezept->getAuthor()== $usr->getUserName())
            {
                array_push($userRezepte, $rezept);
            }

            else {
                throw $this->createNotFoundException(
                    'Keine erstellen Rezepte gefunden'
                );
            }

            };

        return $this->render('rezeptseite/rezepteAnzeigen.html.twig',
            array('userRezepte' => $userRezepte));
    }

    /**
     * @Route("/rezeptBearbeiten", name="rezeptBearbeiten")
     */


    public function rezeptBearbeitenAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getRepository('AppBundle:rezept');
        $rezept = $repository->find($id);

        $recipeForm = $this->createFormBuilder()

            ->add('Titel', TextType::class,array('data' => $rezept->getTitle(),
                                                    'attr' => array('class' => 'form-control')))
            ->add('Beschreibung', TextareaType::class,array('data' => $rezept->getDiscription(),
                                                    'attr' => array('class' => 'form-control')))
            ->add('Zutaten', TextType::class,array('data' => $rezept->getZutaten(),
                                                    'attr' => array('class' => 'form-control')))
            ->add('BildURL', TextType::class,array('data' => $rezept->getImage(),
                                                    'attr' => array('class' => 'form-control',
                                                                    'required' => false)))
            ->getForm();
        $recipeForm->handleRequest($request);

        if ($recipeForm->isSubmitted() && $recipeForm->isValid()) {
            $usr = $this->getUser();



            $rezept->setTitle($recipeForm["Titel"]->getData());
            $rezept->setDiscription($recipeForm["Beschreibung"]->getData());
            $rezept->setZutaten($recipeForm["Zutaten"]->getData());
            $rezept->setImage($recipeForm["BildURL"]->getData());
            $rezept->setAuthor($usr->getUsername());
        }

        $em=$this->getDoctrine()->getManager();
        $em->flush();

        return $this->render('rezeptBearbeiten/rezeptBearbeiten.html.twig',
                        array(
                            'userRezept' => $rezept,
                            'form' => $recipeForm->createView()
                        )
        );

    }


    /**
     * @Route("/rezepteAnzeigen", name="rezepteLoeschen")
     */


        public function rezepteLoeschenAction($id)
        {
            $repository = $this->getDoctrine()->getRepository('AppBundle:rezept');

            $rezept = $repository->findOneById($id);
            $em=$this->getDoctrine()->getManager();
            $em->remove($rezept);
            $em->flush();
            $userRezepte = $repository->findAll();



            return $this->render('rezeptseite/rezepteAnzeigen.html.twig',
                array('userRezepte' => $userRezepte));


        }


}
