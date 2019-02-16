<?php
/**
 * Class/file UserReadCommand.php
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

class UserReadCommand extends Command
{
    public function configure()
    {
        $this->setName('user-read')
            ->setDescription('Read user info. See follow Help.')
            ->setHelp('php bin/console user-read');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserId = new Question('Please enter used id : ', '');

        if ($userId = $helper->ask($input, $output, $questionUserId)) {
            try {
                $userManager = new UserManager();
                $user = $userManager->find($userId);

                $output->writeln('');
                $output->writeln(sprintf('/******************/'));
                $output->writeln(sprintf('User Information ...'));
                $output->writeln('');
                $output->writeln(sprintf('id : %s', $user->getId()));
                $output->writeln(sprintf('username : %s', $user->getUsername()));

            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        } else {
            $output->writeln("Please try again, thanks !");
        }
    }
}
