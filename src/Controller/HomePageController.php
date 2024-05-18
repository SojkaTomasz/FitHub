<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;

class HomePageController extends AbstractController
{



    #[Route('/', name: 'home_page')]
    public function index(): Response
    {

        return $this->render('home_page.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }

    #[Route('/l', name: 'home_page2')]
    public function index2(): Response
    {
        $array = [
            [
                "currency" => "bat (Tajlandia)",
                "code" => "THB",
                "mid" => 0.999
            ],
            [
                "currency" => "dolar amerykański",
                "code" => "USD",
                "mid" => 8
            ],
            [
                "currency" => "dolar australijski",
                "code" => "AUD",
                "mid" => 3
            ],
            [
                "currency" => "dolar Hongkongu",
                "code" => "HKD",
                "mid" => 0.4
            ],
            [
                "currency" => "dolar kanadyjski",
                "code" => "CAD",
                "mid" => 2.2
            ],
            [
                "currency" => "dolar nowozelandzki",
                "code" => "NZD",
                "mid" => 2.3
            ]
        ];

        $client = HttpClient::create();
        $response = $client->request(
            'GET',
            'https://api.nbp.pl/api/exchangerates/tables/a/'
        );
        $content = $response->getContent();
        $content = $response->toArray();

        foreach ($content[0]["rates"] as $valueResponse) {
            $found = false;

            foreach ($array  as $valueData) {
                if ($valueResponse['code'] === $valueData['code']) {
                    $valueData['mid'] = $valueResponse['mid'];
                    $found = true;
                    break;
                }
            }
            unset($valueData);
            if (!$found) {
                $array[] = $valueResponse;
            }
        }
        dd($array);

        return new Response();
    }
}
