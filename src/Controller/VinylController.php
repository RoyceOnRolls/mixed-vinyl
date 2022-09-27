<?php

namespace App\Controller;

use App\Service\MixRepository;
use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\String\u;

class VinylController extends AbstractController
{

    #[Route("/", name: "app_homepage")]
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

    #[Route("/browse/{slug}", name: "app_browse")]
    public function browse(MixRepository $mixRepository, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $mixes = $mixRepository->findAll();

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
