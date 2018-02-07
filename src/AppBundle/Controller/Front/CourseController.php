<?php

namespace AppBundle\Controller\Front;

use AppBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Course controller.
 *
 * @Route("course")
 */
class CourseController extends Controller
{


    /**
     * Lists all course entities.
     *
     * @Route("/", name="course_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courses = $em->getRepository('AppBundle:Course')->findAll();

        return $this->render('public/course/index.html.twig', array(
            'courses' => $courses,
        ));
    }

    /**
     * Creates a new course entity.
     *
     * @Route("/new", name="course_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $course = new Course();
        $form = $this->createForm('AppBundle\Form\Front\CourseType', $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($course);
            $em->flush();

            return $this->redirectToRoute('course_show', array('id' => $course->getId()));
        }

        return $this->render('public/course/new.html.twig', array(
            'course' => $course,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a course entity.
     *
     * @Route("/{slug}", name="course_show")
     * @Method("GET")
     */
    public function showAction($slug)
    {

        $em = $this->getDoctrine()->getManager();
        $course = $em-> getRepository("AppBundle:Course")->findOneBy(array('slug'=>$slug));
        $deleteForm = $this->createDeleteForm($course);

        return $this->render('public/course/show.html.twig', array(
            'course' => $course,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing course entity.
     *
     * @Route("/{slug}/edit", name="course_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $course = $em->getRepository('AppBundle:Course')->findOneBySlug($slug);
        $deleteForm = $this->createDeleteForm($course);
        $editForm = $this->createForm('AppBundle\Form\Front\CourseType', $course);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('course_edit', array('id' => $course->getId()));
        }

        return $this->render('public/course/edit.html.twig', array(
            'course' => $course,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a course entity.
     *
     * @Route("/{slug}", name="course_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $course = $em->getRepository('AppBundle:Course')->findOneBySlug($slug);
        $form = $this->createDeleteForm($course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($course);
            $em->flush();
        }

        return $this->redirectToRoute('course_index');
    }

    /**
     * Creates a form to delete a course entity.
     *
     * @param Course $course The course entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Course $course)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('course_delete', array('slug' => $course->getSlug())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
