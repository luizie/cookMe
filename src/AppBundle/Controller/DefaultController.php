<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
 * @Route("/user-dashboard", name="dashboard")
 */
    public function dashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('user-dashboard/dashboard.html.twig', [ ]);
    }

    /**
     * @Route("/recipes", name="demo_recipes")
     */
    public function recipesAction(Response $response)
    {
       # $response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/findByIngredients?ingredients=apples%2Cflour%2Csugar&limitLicense=false&number=5&ranking=1",
        #    array(
         #       "X-Mashape-Key" => "Y225bSkW3BmshYm7JN2dRnyA0P1Xp1frv1bjsnq7xhpZ4CV05s",
          #      "Accept" => "application/json"
           # )
            return $this->render('user-dashboard/dashboard.html.twig', []);

    }

}
