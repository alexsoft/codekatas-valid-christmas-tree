<?php

namespace Christmas\ValidationStrategies;

use Christmas\Entities\Node;

class NodeWithChildrenValidationStrategy extends BaseValidationStrategy
{
    const VALID_COLOR = 'red';

    /**
     * @var string
     */
    protected $type = Node::TYPE_WITH_CHILDREN;

    /**
     * @inheritdoc
     */
    public function check(Node $node)
    {
        return $node->color() === static::VALID_COLOR;
    }
}
