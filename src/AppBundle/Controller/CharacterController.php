<?php
namespace AppBundle\Controller;

use AppBundle\Form\CharacterType;
use AppBundle\Entity\Characters;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CharacterController extends Controller
{
    /**
     * @Route("/createChar", name="character_creation")
     */
    public function createCharacterAction(Request $request)
    {
        // pour associer l'id d'utilisateur à un perso, on a besoin de l'user
        $userLoggedIn = $this->container->get('security.token_storage')->getToken()->getUser();

        // 1) build the form
        $character = new Characters();
        $form = $this->createForm(CharacterType::class, $character);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($character);
            $character->setUser($userLoggedIn);
            $em->flush();
            
            // à changer par "jeu" quand la page sera là
            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/createCharacter.html.twig',
            array('form' => $form->createView())
        );
    }
}