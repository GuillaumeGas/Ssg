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

const NEWS_REP = "SSGNewsBundle:News";

class NewsController extends Controller {
    public function indexAction($page) {

        if($page < 1)
            throw $this->createNotFoundException("This page doesn't exist.");

        $nbPerPage = 2;

        $rep = $this->getDoctrine()->getManager()->getRepository(NEWS_REP);
        $listNews = $rep->getNews($page, $nbPerPage);

        $nbPages = ceil(count($listNews)/$nbPerPage);

        if($page > $nbPages)
            throw $this->createNotFoundException("This page doesn't exist.");

        $content = $this->get('templating')->render(NEWS_REP.':index.html.twig',
            array(
                'listNews' => $listNews,
                'page'     => $page,
                'nbPages'  => $nbPages
            )
        );
        return new Response($content);
    }

    public function viewAction($id) {

        $rep = $this->getDoctrine()->getManager()->getRepository(NEWS_REP);
        $news = $rep->find($id);

        $content = $this->get('templating')->render(NEWS_REP.':view.html.twig', array('news' => $news));
        return new Response($content);
    }

    public function addAction(Request $request) {

        $news = new News();
        $formBuilder = $this->createFormBuilder($news);

        $formBuilder->add('title', TextType::class)
            ->add('date', DateType::class)
            ->add('author', TextType::class)
            ->add('content', TextareaType::class)
            ->add('save', SubmitType::class);

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'News added');

            return $this->redirect($this->generateUrl('ssg_news_view', array('id' => $news->getId())));
        }

        $content = $this->render(NEWS_REP.':add.html.twig', array('form' => $form->createView()));
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