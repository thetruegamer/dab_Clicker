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
        $userLoggedIn->setPlainPassword("osef");
        // dump($userLoggedIn);
        $characters = $this->getDoctrine()->getRepository('AppBundle:Characters')->findBy(['user'=>$userLoggedIn]);

        $form = $this->createForm(SelectCharType::class, $userLoggedIn, array(
            'characters' => $characters
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // 4) save the activeChar in the logged in user
            $em = $this->getDoctrine()->getManager();
            $em->persist($userLoggedIn->getActiveChar());
            var_dump($em->persist($userLoggedIn));
            var_dump($em->flush());
            die;
            // dump($form);
            return $this->redirectToRoute('character_selection');
        }

        return $this->render(
            'default/charSelection.html.twig',
            array('form' => $form->createView())
        );
    }
}