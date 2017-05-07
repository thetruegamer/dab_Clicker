<?php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
   	public function registerAction(Request $request)
    {

        // 1) build the form
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //  // $file stores the uploaded PDF file
            // /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            // $file = $user->getAvatar();

            // // Generate a unique name for the file before saving it
            // $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // // Move the file to the directory where avatars are stored
            // $file->move(
            //     $this->getParameter('avatar_repertoire'),
            //     $fileName
            // );

            // // Update the 'avatar' property to store the PDF file name
            // // instead of its contents
            // $user->setAvatar($fileName);

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}