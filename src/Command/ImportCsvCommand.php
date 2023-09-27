<?php // src/Command/ImportCsvCommand.php

namespace App\Command;

use App\Entity\Challenge;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

class ImportCsvCommand extends Command
{
private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
parent::__construct();

$this->entityManager = $entityManager;
}

protected function configure()
{
$this
->setName('app:import-csv');
}

protected function execute(InputInterface $input, OutputInterface $output)
{
$csvFile = 'public/ecogeste.csv';

if (!file_exists($csvFile)) {
$output->writeln('Le fichier CSV n\'existe pas.');
return Command::FAILURE;
}

$csv = fopen($csvFile, 'r');

if ($csv === false) {
$output->writeln('Erreur lors de l\'ouverture du fichier CSV.');
return Command::FAILURE;
}


$firstRow = true;

    while (($data = fgetcsv($csv)) !== false) {
        if ($firstRow) {
            $firstRow = false;
            continue;
        }



$entityManager = $this->entityManager;

while (($data = fgetcsv($csv)) !== false) {
$challenge = new Challenge();

    if (isset($data[1]) && (string)$data[1] !== "") {
        $challenge->setTitle((string)$data[1]);
    } else {
        $challenge->setTitle("Défi secret");
    }

    if (isset($data[2]) && (string)$data[2] !== "") {
        $challenge->setCategory((string)$data[2]);
    } else {
        $challenge->setCategory("Autres");
    }

    if (isset($data[3]) && (string)$data[3] !== "") {
        $challenge->setSubCategory((string)$data[3]);
    } else {
        $challenge->setSubCategory("Autres");
    }

    if (isset($data[4]) && (string)$data[4] !== "") {
        $challenge->setDescription((string)$data[4]);
    } else {
        $challenge->setDescription("La description est vide.");
    }

    if (isset($data[5]) && (int)$data[5] !== 0) {
        $challenge->setDeadline((int)$data[5]);
    } else {
        $challenge->setDeadline(1);
    }


    if (isset($data[6]) && (int)$data[6] !== 0) {
        $challenge->setPoints((int)$data[5]); // Remplacez l'indice par celui correspondant à la colonne des points
    } else {
        $challenge->setPoints(rand(5, 15));
    }


    $entityManager->persist($challenge);
}

fclose($csv);

$entityManager->flush();

$output->writeln('Importation terminée avec succès.');
return Command::SUCCESS;
}
}
}


