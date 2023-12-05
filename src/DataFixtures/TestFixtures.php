<?php

namespace App\DataFixtures;

use DateTime;

use App\Entity\User;
use App\Entity\Auteur;
use App\Entity\Emprunteur;
use App\Entity\Emprunt;
use App\Entity\Genre;
use App\Entity\Livre;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestFixtures extends Fixture implements FixtureGroupInterface
{
  private $faker;
  private $hasher;
  private $manager;

  public function __construct(UserPasswordHasherInterface $hasher)
  {
    $this->faker = FakerFactory::create('fr_FR');
    $this->hasher = $hasher;
  }

  public static function getGroups(): array
  {
    return ['test'];
  }

  public function load(ObjectManager $manager): void
  {
    $this->loadAuteur();
    $this->loadGenre();
    $this->loadLivre();
    $this->loadEmprunteur();
    $this->loadEmprunt();

    $this->manager = $manager;
  }

  public function loadUser(): void
  {
    // Données statiques
    $datas = [
      [
        'email' => 'foo.foo@example.com',
        'password' => '123',
        'roles' => ['ROLE_USER'],
        'enabled' => ['true'],
        'name' => 'foo',
        'firstname' => 'foo',
        'telephone' => '1234567890',
      ],
      [
        'email' => 'bar.bar@example.com',
        'password' => '123',
        'roles' => ['ROLE_USER'],
        'enabled' => ['false'],
        'name' => 'bar',
        'firstname' => 'bar',
        'telephone' => '0123456789',
      ],
      [
        'email' => 'baz.baz@example.com',
        'password' => '123',
        'roles' => ['ROLE_USER'],
        'enabled' => ['true'],
        'nom' => 'baz',
        'prenom' => 'baz',
        'telephone' => '1234567899',
      ],
    ];

    foreach ($datas as $data) {
      $user = new User();
      $user->setEmail($data['email']);
      $password = $this->hasher->hashPassword($user, $data['password']);
      $user->setPassword($password);
      $user->setRoles($data['roles']);
      $user->setEnabled($data['enabled']);

      $this->manager->persist($user);

      $emprunteur = new Emprunteur();
      $emprunteur->setNom($data['name']);
      $emprunteur->setPrenom($data['prenom']);

    }

    $this->manager->flush();

    //Données dynamiques
    for ($i = 0; $i < 100; $i++) {
      $user = new User();
      $user->setEmail($this->faker->unique()->safeEmail());
      $password = $this->hasher->hashPassword($user, '123');
      $user->setPassword($password);
      $user->setRoles(['ROLE_USER']);
      $user->setEnabled(true);

      $this->manager->persist($user);
    }

    $this->manager->flush();
  }

  public function loadAuteur(): void
  {
    $datas = [
      [
        'name' => 'auteur inconnu'
      ],
      [
        'name' => 'Cartier',
        'firstname' => 'Hugues'
      ],
      [
        'name' => 'Lambert',
        'firstname' => 'Armand'
      ],
      [
        'name' => 'Moitessier',
        'firstname' => 'Thomas'
      ],
    ];
  }


  public function loadGenre(): void
  {

    $datas = [
      [
        'name' => 'poésie',
        'description' => 'null',
      ],
      [
        'name' => 'nouvelle',
        'description' => 'null',
      ],
      [
        'name' => 'roman historique',
        'description' => 'null',
      ],
      [
        'name' => 'roman d`amour',
        'description' => 'null',
      ],
      [
        'name' => 'roman d`avanture',
        'description' => 'null',
      ],
      [
        'name' => 'science-fcition',
        'description' => 'null',
      ],
      [
        'name' => 'fantasy',
        'description' => 'null',
      ],
      [
        'name' => 'biographie',
        'description' => 'null',
      ],
      [
        'name' => 'conte',
        'description' => 'null',
      ],
      [
        'name' => 'témoignage',
        'description' => 'null',
      ],
      [
        'name' => 'théatre',
        'description' => 'null',
      ],
      [
        'name' => 'essai',
        'description' => 'null',
      ],
      [
        'name' => 'journla intimes',
        'description' => 'null',
      ],
    ];

    foreach ($datas as $data) {
      $genre = new Genre();
      $genre->setName($data['name']);
      $genre->setDescription($data['description']);

      $this->manager->persist($genre);
    }

    $this->manager->flush();
  }

  public function loadLivre(): void
  {
  }

  public function loadEmprunteur(): void
  {
    $datas = [
      [
        'nom' => 'foo',
        'prenom' => 'foo',
        'telephone' => '0123456789',
      ],
      [
        'nom' => 'bar',
        'prenom' => 'bar',
        'telephone' => '1234567890',
      ],
      [
        'nom' => 'baz',
        'prenom' => 'baz',
        'telephone' => '1234567899',
      ],
    ];

    foreach ($datas as $data){
      $emprunteur = new Emprunteur();
      $emprunteur->setNom($data['nom']);
      $emprunteur->setPrenom($data['prenom']);
      $emprunteur->setTelephone($data['telephone']);

      $this->manager->persist($emprunteur);
    }
    $this->manager->flush();
  }

  public function loadEmprunt(): void
  {
  }
}
