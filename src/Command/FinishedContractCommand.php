<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'finished-contract',
    description: 'Delete all accounts where contract Date is over.',
)]
class FinishedContractCommand extends Command
{
    protected function configure(): void
    {

    }

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em) {
        $this->userRepository = $userRepository;
        $this->em = $em;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

       $selectedUsers = $this->userRepository->findbyDate();
        foreach ($selectedUsers as $user) {
            $this->em->remove($user);
            $this->em->flush();
        }
        $io->success('La commande a été réalisée avec succès et a supprimé les profils avec des contrats inférieurs à la date du jour');

        return Command::SUCCESS;
    }
}
