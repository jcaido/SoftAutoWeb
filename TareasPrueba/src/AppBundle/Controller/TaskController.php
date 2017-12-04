<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\product;
use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Entity\Tag;
use AppBundle\Form\TaskType;

class ProductosController extends Controller
{
    /**
     * @Route("/productos", name="productos")
     */
    public function productosAction(Request $request)
    {
        $category = new Category();
        $category->setName('Main Products');
 
        $product = new Product();
        $product->setName('Foo');
        $product->setPrice(19.99);
        // relaciona este producto con una categoría
        $product->setCategory($category);
 
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();
 
        return new Response(
            'Created product id: '.$product->getId()
            .' and category id: '.$category->getId()
        );
    }
}

class TaskController extends Controller
{
    /**
     * @Route("/", name="inicio")
     */
    public function inicioAction(Request $request)
    {
        $task = new Task();
        
        $tag1 = new Tag();
        $tag1->name = "tag1";
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = "tag2";
        $task->getTags()->add($tag2);
        
        $form = $this->createForm('AppBundle\Form\TaskType', $task);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->persist($tag1);
            $em->persist($tag2);
            $em->flush();
            
            return $this->redirectToRoute('inicio');
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
