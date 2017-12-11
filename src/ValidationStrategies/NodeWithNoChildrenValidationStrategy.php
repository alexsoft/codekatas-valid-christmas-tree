<?php

namespace Christmas\ValidationStrategies;

use Christmas\Entities\Node;

class NodeWithNoChildrenValidationStrategy extends BaseValidationStrategy
{
    const VALID_COLOR = 'blue';

    /**
     * @var string
     */
    protected $type = Node::TYPE_WITH_NO_CHILDREN;

    /**
     * @inheritdoc
     */
    public function check(Node $node)
    {
        return $node->color() === static::VALID_COLOR;
    }
}
