<?php
/**
 * Class/file UserUpdateCommand.php
 *
 * @author John Pluto Solutions <john@pluto.solutions>
 * Date: 2/16/2019
 * Time: 11:58 AM
 */

namespace App\Commands;

use App\Entity\User;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class UserUpdateCommand extends Command
{
    public function configure()
    {
        $this->setName('user-update')
            ->setDescription('Update user info. See follow Help.')
            ->setHelp('php bin/console user-update');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserId = new Question('Please enter used id : ', '');
        $questionUserName = new Question('Please enter new username : ', '');
        $questionUserPassword = new Question('Please enter new password : ', '');

        if ($userId = $helper->ask($input, $output, $questionUserId)) {
            try {
                $userManager = new UserManager();
                $existingUser = $userManager->find($userId);

                $output->writeln('');
                $output->writeln(sprintf('/****************************/'));
                $output->writeln(sprintf('Existing user information ...'));
                $output->writeln('');
                $output->writeln(sprintf('id : %s', $existingUser->getId()));
                $output->writeln(sprintf('username : %s', $existingUser->getUsername()));

                $output->writeln('');
                $output->writeln(sprintf('/****************************************/'));
                $output->writeln(sprintf('Please enter new information to this user.'));
                $output->writeln('');

                if ($userName = $helper->ask($input, $output, $questionUserName)) {
                    if ($userPassword = $helper->ask($input, $output, $questionUserPassword)) {
                        $passwordStrength = User::passwordStrengthCheck($userPassword);
                        if ($passwordStrength["password_strength"] == false) {
                            $output->writeln($passwordStrength);
                        } else {
                            $user = User::update($userName, $userPassword, $existingUser);
                            $userManager->update($user);

                            $output->writeln('');
                            $output->writeln(sprintf('/***************************************/'));
                            $output->writeln(sprintf('Updated user information successfully ...'));
                            $output->writeln('');
                            $output->writeln(sprintf('id : %s', $user->getId()));
                            $output->writeln(sprintf('username : %s', $user->getUsername()));
                        }
                    }
                }
            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        } else {
            $output->writeln("Please try again, thanks !");
        }
    }
}
