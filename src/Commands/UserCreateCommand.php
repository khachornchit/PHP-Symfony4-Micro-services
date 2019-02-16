<?php
/**
 * Class/file UserCreateCommand.php
 *
 * @author John Pluto Solutions <john@pluto.solutions>
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

class UserCreateCommand extends Command
{
    public function configure()
    {
        $this->setName('user-create')
            ->setDescription('Create a new user. See follow Help.')
            ->setHelp('php bin/console user-create');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserName = new Question('Please enter username : ', '');
        $questionUserPassword = new Question('Please enter password : ', '');

        if ($userName = $helper->ask($input, $output, $questionUserName)) {
            if ($userPassword = $helper->ask($input, $output, $questionUserPassword)) {
                $passwordStrength = User::passwordStrengthCheck($userPassword);
                if ($passwordStrength["password_strength"] == false) {
                    $output->writeln($passwordStrength);
                } else {
                    $userManager = new UserManager();
                    $user = User::create($userName, $userPassword);
                    $userManager->update($user);

                    $output->writeln('');
                    $output->writeln(sprintf('/*******************************/'));
                    $output->writeln(sprintf('Created a new user successfully !'));
                    $output->writeln('');
                    $output->writeln(sprintf('id : %s', $user->getId()));
                    $output->writeln(sprintf('username : %s', $user->getUsername()));
                }
            }
        } else {
            $output->writeln("Please try again, thanks !");
        }
    }
}
