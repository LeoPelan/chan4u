<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

      if ($request->getMethod() == 'POST') {
        if (null !== ($request->get('rateup'))) {
          $id_post = $request->get('id_post');
          $em = $this->getDoctrine()->getManager();
          $query = $em->getConnection()->prepare("
          INSERT INTO `rate`(`id_post`, `rate`)
          VALUES ('".$id_post."', rate + 1)
          ON DUPLICATE KEY UPDATE rate = rate + 1")->execute();
        }else {
          $id_post = $request->get('id_post');
          $em = $this->getDoctrine()->getManager();
          $query = $em->getConnection()->prepare("
          INSERT INTO `rate`(`id_post`, `rate`)
          VALUES ('".$id_post."', rate - 1)
          ON DUPLICATE KEY UPDATE rate = rate - 1")->execute();
        }
      }
      $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Sound');
      $repositoryUpload = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Video');
      $repositoryLike = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Rate');
        $like = $repositoryLike->findAll();
        $listPosts = $repository->findAll();
        $listUpload = $repositoryUpload->findAll();
        return $this->render('default/index.html.twig',
        array(
          "list" => $listPosts,
          "like" => $like,
          "upload" => $listUpload)
        );
    }
}
