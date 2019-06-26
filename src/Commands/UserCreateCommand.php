<?php
/**
 * Class/file UserCreateCommand.php
 *
 * @author Khachornchit Songsaen
 * Date: 2/16/2019
 * Time: 10:00 AM
 */

namespace App\Commands;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Class UserCreateCommand
 * @package App\Commands
 */
class UserCreateCommand extends Command
{
    public function configure()
    {
        $this->setName('user:create')
            ->setDescription('Create a new user. See follow Help.')
            ->setHelp('php bin/console user-create');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserName = new Question('<question>Please enter username : </question>', '');
        $questionUserPassword = new Question('<question>Please enter password : </question>', '');

        if ($userName = $helper->ask($input, $output, $questionUserName)) {
            if ($userPassword = $helper->ask($input, $output, $questionUserPassword)) {
                $passwordStrength = User::passwordStrengthCheck($userPassword);
                if ($passwordStrength->getStatus()) {
                    try {
                        $userManager = new UserManager();
                        $user = User::create($userName, $userPassword);
                        $userManager->update($user);

                        $output->writeln(sprintf('<comment>Created a new user successfully !</comment>'));
                        $output->writeln(sprintf('<info>id : %s </info>', $user->getId()));
                        $output->writeln(sprintf('<info>username : %s </info>', $user->getUsername()));
                    } catch (\Exception $exception) {
                        $output->writeln($exception->getMessage());
                    }
                } else {
                    $output->writeln($passwordStrength->getError());
                }
            }
        }
    }
}
