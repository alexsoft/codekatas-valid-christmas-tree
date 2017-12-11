<?php

namespace Christmas\ValidationStrategies;

use Christmas\Entities\Node;
use Christmas\Exceptions\BaseException;

abstract class BaseValidationStrategy
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     *
     * @return bool
     */
    public function canValidate($type)
    {
        return $this->type === $type;
    }

    /**
     * @param Node $node
     *
     * @return bool
     */
    public function isValid(Node $node)
    {
        if ($this->check($node) === true) {
            return true;
        }

        throw BaseException::ofType($this->type);
    }

    /**
     * @param Node $node
     *
     * @return bool
     */
    abstract public function check(Node $node);
}
