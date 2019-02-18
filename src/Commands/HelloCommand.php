<?php
/**
 * Class/file HelloCommand.php
 *
 * @author John Pluto Solutions <john@pluto.solutions>
 * Date: 2/16/2019
 * Time: 9:18 AM
 */

namespace App\Commands;

use App\Manager\BaseManager;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * Class HelloCommand
 * @package App\Commands
 */
class HelloCommand extends Command
{
    public function configure()
    {
        $this->setName('hello')
            ->setDescription('Hello command !')
            ->setHelp('php bin/console hello');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $questionUsername = new Question('<question>Please enter name : </question>', '');
        $username = $helper->ask($input, $output, $questionUsername);

        if ($username) {
            $output->writeln(sprintf('<info>Welcome : %s :)</info>', $username));
        } else {
            $output->writeln(sprintf('<error>Please enter your name. Try again, thanks !</error>'));
        }
    }
}
