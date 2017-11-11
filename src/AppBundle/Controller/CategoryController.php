<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use  Knp\Component\Pager\Paginator;

/**
 * Category controller.
 *
 * @Route("category")
 */
class CategoryController extends Controller
{

    /**
     * Lists all category entities.
     *
     * @Route("/", name="categories")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('AppBundle:Promotion')->findAll();

        $courses = $em->getRepository('AppBundle:Course')->findAll();

        $listCategories = $em->getRepository('AppBundle:Category')->findAll();

        $categories  = $this->get('knp_paginator')->paginate(
            $listCategories,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
                                                    3/*nbre d'éléments par page*/
        );
        unset($_GET);

        return $this->render('category/index.html.twig', array(
            'courses' => $courses,
            'promotions' => $promotions,
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('AppBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_show', array('id' => $category->getId()));
        }

        return $this->render('category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction( Request $request, Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $promotions = $em->getRepository('AppBundle:Promotion')->findLastPromos($category, 5);

        $courses = $em->getRepository('AppBundle:Course')->findLastCourses($category, 5);

        $allCategories = $em->getRepository('AppBundle:Category')->findAll();

        $listProviders = $em->getRepository('AppBundle:Provider')->providersOfCategory($category);

        $providers  = $this->get('knp_paginator')->paginate(
            $listProviders,
            $request->query->get('page', 1), 6);

        unset($_GET);


        $deleteForm = $this->createDeleteForm($category);

        return $this->render('category/show.html.twig', array(
            'providers' => $providers,
            'courses' => $courses,
            'categories' => $allCategories,
            'promotions' => $promotions,
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('AppBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_edit', array('id' => $category->getId()));
        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     * @Route("/{id}", name="category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Category $category)
    {
        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
