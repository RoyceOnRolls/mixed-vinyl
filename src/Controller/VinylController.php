<?php

namespace App\Controller;

use App\Service\MixRepository;
use Psr\Cache\CacheItemInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

use function Symfony\Component\String\u;
use Symfony\Contracts\HttpClient\HttpClientInterface;  

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
    public function browse(HttpClientInterface $httpClient, MixRepository $mixRepository, CacheInterface $cache, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;

        $mixes = $mixRepository->findAll($httpClient, $cache);

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
