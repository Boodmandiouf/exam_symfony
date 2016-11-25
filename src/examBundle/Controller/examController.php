<?php

namespace examBundle\Controller;

use examBundle\Entity\exam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Exam controller.
 *
 */
class examController extends Controller
{
    /**
     * Lists all exam entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exams = $em->getRepository('examBundle:exam')->findAll();

        return $this->render('examBundle:exam:index.html.twig', array(
            'exams' => $exams,
        ));
    }

    /**
     * Creates a new exam entity.
     *
     */
    public function newAction(Request $request)
    {
        $exam = new Exam();
        $form = $this->createForm('examBundle\Form\examType', $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exam);
            $em->flush($exam);

            return $this->redirectToRoute('exam_show', array('id' => $exam->getId()));
        }

        return $this->render('examBundle:exam:new.html.twig', array(
            'exam' => $exam,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a exam entity.
     *
     */
    public function showAction(exam $exam)
    {
        $deleteForm = $this->createDeleteForm($exam);

        return $this->render('examBundle:exam:show.html.twig', array(
            'exam' => $exam,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing exam entity.
     *
     */
    public function editAction(Request $request, exam $exam)
    {
        $deleteForm = $this->createDeleteForm($exam);
        $editForm = $this->createForm('examBundle\Form\examType', $exam);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exam_edit', array('id' => $exam->getId()));
        }

        return $this->render('examBundle:exam:edit.html.twig', array(
            'exam' => $exam,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a exam entity.
     *
     */
    public function deleteAction(Request $request, exam $exam)
    {
        $form = $this->createDeleteForm($exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exam);
            $em->flush($exam);
        }

        return $this->redirectToRoute('exam_index');
    }

    /**
     * Creates a form to delete a exam entity.
     *
     * @param exam $exam The exam entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(exam $exam)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exam_delete', array('id' => $exam->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
