<?php

namespace Scouterna\Scoutorg\Model;

/**
 * thrown when something goes wrong regarding a uid.
 */
class UidException extends \Exception
{
    private $uid;

    /**
     * Creates a new exception regarding a uid.
     * @param string $msg The Exception message to throw.
     * @param null|\Scouterna\Scoutorg\Model\Uid $uid
     * @param \Throwable $previous The previous throwable used for the exception chaining.
     */
    public function __construct(string $msg, ?Uid $uid, ?\Throwable $previous = null)
    {
        parent::__construct("$msg $uid", 0, $previous);
        $this->uid = $uid;
    }

    /**
     * Gets the uid or null.
     * @return null|\Scouterna\Scoutorg\Model\Uid
     */
    public function getUid()
    {
        return $this->uid;
    }
}
