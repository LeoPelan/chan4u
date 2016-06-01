<?php
namespace AppBundle\Controller;
use AppBundle\Entity\Sound;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
class FormController extends Controller
{
    /**
     * @Route("/form", name="form")
     */
    public function formAction(Request $request)
    {
        $name = $request->get('name');
        $genre = $request->get('genre');
        $artiste = $request->get('artiste');
        if (isset($name) || isset($genre) || isset($artiste)) {
            if ($name == "") {
                echo "Name is empty / Error";
              }
                elseif ($genre == "") {
                    echo "Genre is empty / Error";
                }
                elseif ($artiste == "") {
                    echo "Artiste is empty / Error";
            } else {
              $posts = new Sound();
              $posts->setName($name);
              $posts->setGenre($genre);
              $posts->setArtiste($artiste);
              $em = $this->getDoctrine()->getManager();
              $em->persist($posts);
              $em->flush();
              echo "Your sound has been posted / Success";
            }
          }
          return $this->render('form.html.twig');
        }
      }
