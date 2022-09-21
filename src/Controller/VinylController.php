<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController extends AbstractController
{

    #[Route("/")]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Strangers By Nature', 'artist' => 'Adele'],
            ['song' => 'Easy On Me', 'artist' => 'Adele'],
            ['song' => 'My Little Love', 'artist' => 'Adele'],
            ['song' => 'Cry Your Heart Out', 'artist' => 'Adele'],
            ['song' => 'Oh My God', 'artist' => 'Adele'],
        ];
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
            'tracks' => $tracks
        ]);
    }

    #[Route("/browse/{slug}")]
    public function browse(string $slug = null): Response
    {
        $genre = $slug ? u(str_replace("-", " ", $slug))->title(true) : null;


        return $this->render(
            'vinyl/browse.html.twig',
            [
                'genre' => $genre
            ],
        );
    }
}
