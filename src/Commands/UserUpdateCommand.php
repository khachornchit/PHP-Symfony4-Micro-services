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

/**
 * Class UserUpdateCommand
 * @package App\Commands
 */
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
        $questionUserId = new Question('<question>Please enter used id : </question>', '');
        $questionUserName = new Question('<question>Please enter new username : </question>', '');
        $questionUserPassword = new Question('<question>Please enter new password : </question>', '');

        if ($userId = $helper->ask($input, $output, $questionUserId)) {
            try {
                $userManager = new UserManager();
                $existingUser = $userManager->find($userId);

                $output->writeln(sprintf('<comment>Existing user information</comment>'));
                $output->writeln(sprintf('<info>id : %s </info>', $existingUser->getId()));
                $output->writeln(sprintf('<info>username : %s </info>', $existingUser->getUsername()));

                $output->writeln(sprintf('<comment>Please enter new information to this user.</comment>'));
                $output->writeln('');

                if ($userName = $helper->ask($input, $output, $questionUserName)) {
                    if ($userPassword = $helper->ask($input, $output, $questionUserPassword)) {
                        $passwordStrength = User::passwordStrengthCheck($userPassword);
                        if ($passwordStrength->getStatus()) {
                            try {
                                $user = User::update($userName, $userPassword, $existingUser);
                                $userManager->update($user);

                                $output->writeln(sprintf('<comment>Update user successfully !</comment>'));
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
            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        }
    }
}
