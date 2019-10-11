<?php
/**
 * IGNORE FIXTURE FILES
 */

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Service\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixture extends Fixture
{
    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager)
    {
        $movies = [
            [
                'titleId' => '6565702', /* IMDb movie code */
                'title' => 'Dark Phoenix',
                'genres' => [
                    $manager->getReference(Genre::class, 'ACTION'),
                    $manager->getReference(Genre::class, 'ADVENTURE'),
                    $manager->getReference(Genre::class, 'SCI_FI'),
                ]
            ],
            [
                'titleId' => '6139732', /* IMDb movie code */
                'title' => 'Aladdin (2019)',
                'genres' => [
                    $manager->getReference(Genre::class, 'ADVENTURE'),
                    $manager->getReference(Genre::class, 'COMEDY'),
                    $manager->getReference(Genre::class, 'FAMILY'),
                    $manager->getReference(Genre::class, 'FANTASY'),
                    $manager->getReference(Genre::class, 'ROMANCE'),
                ]
            ]
        ];

        foreach ($movies as $movieData) {
            {

                $movie = new Movie();

                $movie->setTitle($movieData['title']);
                $movie->setTitleId($movieData['titleId']);

                foreach ($movieData['genres'] as $genreReference) {
                    $movie->addGenre($genreReference);
                }

                $manager->persist($movie);
            }
        }


        $manager->flush();
    }
}
