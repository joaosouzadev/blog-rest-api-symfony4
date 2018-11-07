<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/blog_list")
     */
    public function list() {

    }

    /**
     * @Route("/{id}", name="blog_by_id")
     */
    public function post() {

    }

    public function postBySlug() {

    }
}