<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\product;
use AppBundle\Entity\Category;
use AppBundle\Form\categoryType;

class ProductosController extends Controller
{
    /**
     * @Route("/productos", name="productos")
     */
    public function productosAction(Request $request)
    {
        $category = new Category();
        
        $form = $this->createForm('AppBundle\Form\categoryType', $category);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            
            return $this->redirectToRoute('productos');
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}