<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comentario;
use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $passwordEncoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->faker = \Faker\Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsuarios($manager);
        $this->loadBlogPosts($manager);
        $this->loadComentarios($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $usuario = $this->getReference('admin');

        for ($i = 0; $i < 100; $i++) {
            $blogPost = new BlogPost();
            $blogPost->setTitulo($this->faker->realText(30));
            $blogPost->setCriadoEm($this->faker->dateTimeThisYear);
            $blogPost->setConteudo($this->faker->realText());
            $blogPost->setAutor($usuario);
            $blogPost->setSlug($this->faker->slug);

            $this->setReference("blog_post_$i", $blogPost);

            $manager->persist($blogPost);
        }

        $manager->flush();
    }

    public function loadComentarios(ObjectManager $manager)
    {
        for ($i = 0; $i < 100; $i++) {
            for ($j = 0; $j < rand(1,10); $j++) {
                $comentario = new Comentario();
                $comentario->setConteudo($this->faker->realText());
                $comentario->setPublicadoEm($this->faker->dateTimeThisYear);
                $comentario->setAutor($this->getReference('admin'));
                $comentario->setBlogPost($this->getReference("blog_post_$i"));
                $manager->persist($comentario);
            }
        }

        $manager->flush();
    }

    public function loadUsuarios(ObjectManager $manager)
    {
        $usuario = new Usuario();
        $usuario->setNome('João Souza');
        $usuario->setEmail('jvms3d@gmail.com');
        $usuario->setUsername('joaosouza');
        $usuario->setPassword($this->passwordEncoder->encodePassword($usuario, '123456'));

        $this->addReference('admin', $usuario);

        $manager->persist($usuario);
        $manager->flush();
    }
}
