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
      $repository = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Sound');
      $repositoryUpload = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Video');
        $listPosts = $repository->findAll();
        $listUpload = $repositoryUpload->findAll();
        return $this->render('default/index.html.twig',
        array(
          "list" => $listPosts,
          "upload" => $listUpload)
        );
    }
}
