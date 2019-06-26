<?php
/**
 * Class/file Message.php
 *
 * @author Khachornchit Songsaen
 * Date: 2/19/2019
 * Time: 12:28 PM
 */

namespace App\Model;


class Message
{
    /**
     * var boolean
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->status = false;
        $this->message = "";
    }

    /**
     * @param $status
     * @return Message
     */
    public static function status($status)
    {
        $me = new self();
        $me->setStatus($status);
        return $me;
    }

    /**
     * @param $message
     * @return Message
     */
    public static function message($message)
    {
        $me = new self();
        $me->setMessage($message);
        return $me;
    }

    /**
     * @param $status
     * @param $message
     * @return Message
     */
    public static function init($status, $message)
    {
        $me = new self();
        $me->setStatus($status);
        $me->setMessage($message);
        return $me;
    }

    /**
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return sprintf('<error>%s</error>', $this->message);
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return sprintf('<info>%s</info>', $this->message);
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return sprintf('<comment>%s</comment>', $this->message);
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return sprintf('<question>%s</question>', $this->message);
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @param string $message
     * @return string
     */
    public static function formatError(string $message)
    {
        return sprintf('<error>%s</error>', $message);
    }

    /**
     * @param string $message
     * @return string
     */
    public static function formatInfo(string $message)
    {
        return sprintf('<info>%s</info>', $message);
    }

    /**
     * @param string $message
     * @return string
     */
    public static function formatComment(string $message)
    {
        return sprintf('<comment>%s</comment>', $message);
    }

    /**
     * @param string $message
     * @return string
     */
    public static function formatQuestion(string $message)
    {
        return sprintf('<question>%s</question>', $message);
    }
}
