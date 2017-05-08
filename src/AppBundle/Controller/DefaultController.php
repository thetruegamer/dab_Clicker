<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/play", name="play")
     */
    public function indexAction(Request $request)
    {

        $userLoggedIn = $this->container->get('security.token_storage')->getToken()->getUser();
        $character = $userLoggedIn->getActiveChar();

        $massons = $character->calculateMassons();
        $dabs = $character->getDabs();
        $character->calculateCost();
        $cost = $character->getCost();
        $dank_meme = $character->getDankMemes();

        return $this->render('default/index.html.twig',
            array('massons' => $massons,
                'cost' => $cost,
                'dank_meme' => $dank_meme,
                'dabs' => $dabs,
                'dab_inc' => $character->getDabInc()
                ));
    }


    /**
     * @param User $entity
     *
     * @Route("/save/{dabs}", name="save")
     * @return RedirectResponse
     *
     */
    public function save($dabs)
    {
        $userLoggedIn = $this->container->get('security.token_storage')->getToken()->getUser();
        $character = $userLoggedIn->getActiveChar();
        $character->setDabs($dabs);

        $em = $this->getDoctrine()->getManager();

        $em->persist($character);
        $em->flush();

        return $this->redirectToRoute('play');
    }


    /**
     * @param User $entity
     *
     * @Route("/buy/{dabs}", name="buy")
     * @return RedirectResponse
     *
     */
    public function buy($dabs)
    {
        $userLoggedIn = $this->container->get('security.token_storage')->getToken()->getUser();
        $character = $userLoggedIn->getActiveChar();
        $character->setDabs($dabs);
        if($character->canBuy())
        {
            $character->buyOneDankMeme();

            $em = $this->getDoctrine()->getManager();

            $em->persist($character);
            $em->flush();
        }

        return $this->redirectToRoute('play');
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
