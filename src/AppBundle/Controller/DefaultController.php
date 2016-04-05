<?php

namespace AppBundle\Controller;

/*use Doctrine\DBAL\Types\TextType;*/
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    /**
     * @Route("/recipes", name="demo_recipes")
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
    public function webAction($suchbegriff)
    {
        if($suchbegriff != null)
        {
            $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?ingredients=".$suchbegriff."&limitLicense=false&number=5&ranking=1",
                array(
                    "X-Mashape-Key" => "Y225bSkW3BmshYm7JN2dRnyA0P1Xp1frv1bjsnq7xhpZ4CV05s",
                    "Accept" => "application/json"
                ));

            return $response->body[0]->sourceUrl;
        }
        return "Keine Suchbegriffe";

    }


    public function formrezeptAction($request){
        $form = $this->createFormBuilder()
            ->add('Suchbegriffe',TextType::class)
            ->add('Rezept suchen', SubmitType::class, array('label' => 'Rezept suchen'))
            ->getForm();
        $form->handleRequest($request);
        $suchbegriff= null;
        $title= null;
        $image= null;
        $sourceUrl = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $suchbegriff=$form["Suchbegriffe"]->getData();
            $title=$this->recipesAction($suchbegriff);
            $image =$this->imagesAction($suchbegriff);
            $sourceUrl =$this->webAction($suchbegriff);
        }
        return
        array('form' => $form->createView(),
            'title'=> $title,
            'image'=> $image

        );
    }

}
