<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadUsuarios($manager);
        $this->loadBlogPosts($manager);
        $this->loadComentarios($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $usuario = $this->getReference('admin');

        $blogPost = new BlogPost();
        $blogPost->setTitulo('Primeiro post');
        $blogPost->setConteudo('Conteudo primeiro post');
        $blogPost->setCriadoEm(new \DateTime('2018-11-06 12:00:00'));
        $blogPost->setAutor($usuario);
//        $blogPost->setSlug('primeiro-post');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitulo('Segundo post');
        $blogPost->setConteudo('Conteudo segundo post');
        $blogPost->setCriadoEm(new \DateTime('2018-11-08 12:00:00'));
        $blogPost->setAutor($usuario);
//        $blogPost->setSlug('segundo-post');

        $manager->persist($blogPost);
        $manager->flush();
    }

    public function loadComentarios(ObjectManager $manager)
    {

    }

    public function loadUsuarios(ObjectManager $manager)
    {
        $usuario = new Usuario();
        $usuario->setNome('João Souza');
        $usuario->setEmail('jvms3d@gmail.com');
        $usuario->setUsername('joaosouza');
        $usuario->setPassword('123456');

        $this->addReference('admin', $usuario);

        $manager->persist($usuario);
        $manager->flush();
    }
}
