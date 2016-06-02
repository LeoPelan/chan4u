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

             $ip = $this->container->get('request_stack')->getMasterRequest()->getClientIp();
             $query = $em->getConnection()->prepare("
             INSERT INTO `video`(`ip`)
             VALUES ('".$ip."')");
             $video->upload();
             $video->setIp($ip);
             $em = $this->getDoctrine()->getManager();
             $em->persist($video);
             $em->flush();

             return $this->redirect("http://212.47.254.179/");
         }
         return $this->render("AppBundle::uploadtemplate.html.twig",array('form' => $form->createView()));
       }
     }
