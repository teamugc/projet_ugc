<?php


namespace App\Controller;

use App\Document\Movie;
use App\Document\MovieUpdate;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

const REGEX_CATCH_MOVIES_TITLES = '/<a[^>]*?class\s*=\s*["\']meta-title-link["\'][^>]*?href\s*=\s*["\']([^"\']*)["\'][^>]*?>([^<]*)<\/a>/i';
const REGEX_CATCH_MOVIE_YEAR = '/<span itemprop="datePublished" content="([0-9]{4}-[0-9]{2}-[0-9]{2})">/i';


class MovieUpdateController extends AbstractController
{
    /**
     * Undocumented function
     *
     * @param DocumentManager $dm
     * @return Response
     */
    #[Route('/movies_update', name: 'app_movies_update')]
    public function index(DocumentManager $dm): Response
    {

        $this->emptyMovies($dm);
        
        $moviesList = [];

        
        $route_json = __DIR__ . '/salles-ugc.json';
        //dd ($route_json);

        $json = file_get_contents($route_json);

        $codes = json_decode ($json);

        // va chercher sur allocine les films à l'afiche dans les salles ugc
        foreach($codes as $code) {
            $matches = [];
            $html = file_get_contents("https://www.allocine.fr/seance/salle_gen_csalle=$code->code.html");
            $success = preg_match_all(REGEX_CATCH_MOVIES_TITLES, $html, $matches);
            if ($success) {
        
                
                for ($i=0; $i<count($matches[0]); $i++) {
                    $nom = $matches[2][$i];
                    $url = $matches[1][$i];
                    $moviesList[$nom] = [
                        'name' => $nom,
                        'url' => $url
                    ];
                }
        
            }
           
        }

        // va chercher pour chaque film la date de sortie
        foreach ($moviesList as $movie) {
            $html = file_get_contents('https://www.allocine.fr/' . $movie['url']);
            $success = preg_match_all(REGEX_CATCH_MOVIE_YEAR, $html, $matches);
            
            // APIRATEUR A SITE WEB
            // $file = './files/' . $movie['name'] . '.html';
            // $h = fopen($file, "w");
            // fwrite($h, $html);
            // fclose($h);
            
            $moviesList[$movie['name']]['date'] = $matches[1][0];
            $moviesList[$movie['name']]['date_fr'] = date('d/F/Y', strtotime($matches[1][0]));
        }


        // Persiste les datas en BDD
        $compteur = 0;
        foreach ($moviesList as $datasMovie){
            $mv = new Movie($datasMovie);
            $dm->persist($mv);
            $compteur++;
        }
        // FIN DU FOREACH

        $dm->flush();

        return $this->render('movie_update/index.html.twig', [
            'movieCount'    => $compteur,
            'controller_name' => 'MovieUpdateController',
            'controller_url'  => 'MovieUpdateController'
        ]);
    }


    /**
     * Undocumented function
     *
     * @param DocumentManager $dm
     * @return void
     */
    #[Route('/movies_empty', name: 'app_movies_empty')]
    public function empty(DocumentManager $dm){

        $this->emptyMovies($dm);

        return $this->render('movie_update/index.html.twig', [
            'movieCount'    => 0,
            'controller_name' => 'MovieUpdateController',
            'controller_url'  => 'MovieUpdateController'
        ]);
    }

    /**
     * Undocumented function
     *
     * @param DocumentManager $dm
     * @return void
     */
    private function emptyMovies(DocumentManager $dm){
        $movies = $dm->getRepository(Movie::class)->findAll();
        foreach ($movies as $movie){
            $dm->remove($movie);
        }
        $dm->flush();
    }
}           
