<?php

namespace Christmas\ValidationStrategies;

use Christmas\Entities\Node;

class RootNodeValidationStrategy extends BaseValidationStrategy
{
	const VALID_ORNAMENT_NAME = 'star';

	/**
	 * @var string
	 */
	protected $type = Node::TYPE_ROOT;

	/**
	 * @inheritdoc
	 */
	public function check(Node $node)
	{
		return $node->ornament() === static::VALID_ORNAMENT_NAME;
	}
}