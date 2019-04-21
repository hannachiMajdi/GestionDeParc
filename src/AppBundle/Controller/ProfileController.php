<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    /**
     * Creates a new user entity.
     *
     * @Route("/profile", name="edit_profile")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->remove('roles');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success','votre profile est modifié');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}
