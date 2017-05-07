<?php 

namespace AppBundle\Controller;

use AppBundle\Form\SelectCharType;
use AppBundle\Entity\User;
use AppBundle\Entity\Characters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SelectCharController extends Controller
{
    /**
     * @Route("/selectChar", name="character_selection")
     */
    public function selectCharacterAction(Request $request)
    {
        $userLoggedIn = $this->container->get('security.token_storage')->getToken()->getUser();

        // as the string says it, I have an error if PlainPassword == null so let's set it.
        $userLoggedIn->setPlainPassword("dumb value to prevent having errors");

        // fetch the array of characters associated to the logged in user
        $characters = $this->getDoctrine()->getRepository('AppBundle:Characters')->findBy(['user'=>$userLoggedIn]);

        // create and handle the form
        $form = $this->createForm(SelectCharType::class, $userLoggedIn, array(
            'characters' => $characters
        ));
        $form->handleRequest($request);
        
        dump($userLoggedIn);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($userLoggedIn);
            $em->flush();
    
            return $this->redirectToRoute('homepage');
            // return $this->redirectToRoute('play');
        }

        return $this->render(
            'default/charSelection.html.twig',
            array('form' => $form->createView())
        );
    }
}