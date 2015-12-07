<?php

namespace SSG\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use SSG\NewsBundle\Entity\News;
use SSG\NewsBundle\Entity\Image;

class NewsController extends Controller {
    public function indexAction() {

        $content = $this->get('templating')->render('SSGNewsBundle:News:index.html.twig');
        return new Response($content);
    }

    public function viewAction($id) {

        $content = $this->get('templating')->render('SSGNewsBundle:News:view.html.twig');
        return new Response($content);
    }

    public function addAction() {

        $news = new News();
        $formBuilder = $this->createFormBuilder($news);

        $formBuilder->add('title', TextType::class)
            ->add('date', DateType::class)
            ->add('author', TextType::class)
            ->add('content', TextareaType::class)
            ->add('save', SubmitType::class);

        $form = $formBuilder->getForm();

        $content = $this->render('SSGNewsBundle:News:add.html.twig', array('form' => $form->createView()));
        return new Response($content);
    }

    public function editAction($id) {

        $content = $this->get('templating')->render('SSGNewsBundle:News:edit.html.twig');
        return new Response($content);
    }

    public function deleteAction($id) {

        $content = $this->get('templating')->render('SSGNewsBundle:News:delete.html.twig');
        return new Response($content);
    }

    public function menuAction($limit) {

        return $this->render('SSGNewsBundle:News:menu.html.twig');
    }
}

?>