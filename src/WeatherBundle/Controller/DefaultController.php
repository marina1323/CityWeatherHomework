<?php

namespace WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;
use GuzzleHttp\set_path;
class DefaultController extends Controller
{
    /**
     * @Route("/weather/{city}")
     */
    public function indexAction($city)
    {
        $client = new Client(['base_uri' => 'http://api.openweathermap.org']);
        $response = $client->request('GET', 'data/2.5/weather?q='.$city.'&units=metric&appid=b1b15e88fa797225412429c1c50c122a');
        $data = json_decode($response->getBody(), true);
        $temperature = $data['main']['temp'];
        
        return $this->render('WeatherBundle:Default:index.html.twig', ["city"=> $city, "temperature"=>$temperature]);
    }
}
