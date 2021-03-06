<?php
/**
 * Class/file UserDeleteCommand.php
 *
 * @author Khachornchit Songsaen
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
 * Class UserDeleteCommand
 * @package App\Commands
 */
class UserDeleteCommand extends Command
{
    public function configure()
    {
        $this->setName('user:delete')
            ->setDescription('Delete user. See follow Help.')
            ->setHelp('php bin/console user-delete');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUserId = new Question('<question>Please enter used id : </question>', '');

        if ($userId = $helper->ask($input, $output, $questionUserId)) {
            try {
                $userManager = new UserManager();
                $userManager->delete($userId);
                $output->writeln(sprintf('<info>Deleted user id : %s successfully ! </info>', $userId));
            } catch (Exception $exception) {
                $output->writeln($exception->getMessage());
            }
        }
    }
}
