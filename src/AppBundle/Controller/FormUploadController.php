<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;


class FormUploadController extends Controller
{
  /**
   * @Route("/formupload", name="formupload")
   */

     public function uploadAction(Request $request)
     {
         $video = new Video();
         $form = $this->createFormBuilder($video)
             ->add('name')
             ->add('file')
             ->add('save', SubmitType::class, array('label' => 'Poster cette image'))
             ->getForm();

         $form->handleRequest($request);

         if ($form->isValid()) {
             $em = $this->getDoctrine()->getManager();

             $video->upload();

             $em->persist($video);
             $em->flush();

             return $this->redirect("http://127.0.0.1:8000/");
         }
         return $this->render("AppBundle::uploadtemplate.html.twig",array('form' => $form->createView()));
       }
     }
