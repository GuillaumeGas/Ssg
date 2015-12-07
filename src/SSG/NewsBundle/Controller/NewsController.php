<?php

namespace SSG\NewsBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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



        $content = $this->get('templating')->render('SSGNewsBundle:News:add.html.twig');
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