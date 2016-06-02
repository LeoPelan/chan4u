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


class GalleryController extends Controller
{
    /**
     * @Route("/gallery", name="gallery")
     */
    public function rateAction(Request $request)
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
      $repositoryLike = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Rate');
        $like = $repositoryLike->findAll();
      $repositoryGallery = $this
        ->getDoctrine()
        ->getManager()
        ->getRepository('AppBundle:Video');
        $gallery = $repositoryGallery->findAll();

        return $this->render("AppBundle::gallerytemplate.html.twig",
        array(
          "upload" => $gallery,
          "like" => $like)
        );
    }
}
