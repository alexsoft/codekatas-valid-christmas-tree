<?php

namespace Christmas\Exceptions;

use Christmas\Entities\Node;

abstract class BaseException extends \RuntimeException
{
    protected static $typesToExceptions = [
        Node::TYPE_ROOT => InvalidRootNode::class,
        Node::TYPE_WITH_NO_CHILDREN => InvalidNodeWithNoChildren::class,
        Node::TYPE_WITH_CHILDREN => InvalidNodeWithChildren::class,
    ];

    public static function ofType($type)
    {
        if (array_key_exists($type, static::$typesToExceptions)) {
            return new static::$typesToExceptions[$type];
        }

        return new UnknownException();
    }
}
