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
        $id = $userLoggedIn->getId();
        
        $char = new Characters();

        $form = $this->createForm(SelectCharType::class, $userLoggedIn, array(
            'id' => $id
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            dump($form->getData());
            // 4) save the activeChar in User
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            // $userLoggedIn
            $em->flush();

            return $this->redirectToRoute('character_selection');
        }

        return $this->render(
            'default/charSelection.html.twig',
            array('form' => $form->createView())
        );
    }
}