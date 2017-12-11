<?php

namespace Christmas\Entities;

use Christmas\Exceptions\BaseException;
use Christmas\ValidationStrategies\StrategyManager;

class Node
{
	const KEY_ORNAMENT = 'ornament';
	const KEY_COLOR = 'color';
	const KEY_LEFT = 'left';
	const KEY_RIGHT = 'right';

	const TYPE_ROOT = 'root';
	const TYPE_WITH_NO_CHILDREN = 'no_children';
	const TYPE_WITH_CHILDREN = 'has_children';

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @var string
	 */
	protected $ornament;

	/**
	 * @var string
	 */
	protected $color;

	/**
	 * @var array
	 */
	protected $left;

	/**
	 * @var array
	 */
	protected $right;

	public function __construct(array $contents, $isRoot = false)
	{
		$this->initializeContents($contents, $isRoot);
	}

	/**
	 * @return string
	 */
	public function ornament()
	{
		return $this->ornament;
	}

	/**
	 * @return string
	 */
	public function color()
	{
		return $this->color;
	}

	/**
	 * @param array $contents
	 * @param bool  $isRoot
	 *
	 * @return bool
	 */
	public static function validate(array $contents, $isRoot = false)
	{
		return (new static($contents, $isRoot))->isValid();
	}

	protected function initializeContents(array $contents, $isRoot = false)
	{
		$this->ornament = $contents[static::KEY_ORNAMENT];

		$this->color = $contents[static::KEY_COLOR];

		$hasChildren = false;

		if (array_key_exists(static::KEY_LEFT, $contents)) {
			$this->left = $contents[static::KEY_LEFT];
			$hasChildren = true;
		}

		if (array_key_exists(static::KEY_RIGHT, $contents)) {
			$this->right = $contents[static::KEY_RIGHT];
			$hasChildren = true;
		}

		switch (true) {
			case $isRoot:
				$this->setTypeToRootNode();
				break;
			case $hasChildren:
				$this->setTypeToNodeWithChildren();
				break;
			default:
				$this->setTypeToNodeWithNoChildren();
				break;
		}

		return $this;
	}

	/**
	 * @return bool
	 * @throws \Exception
	 */
	protected function isValid()
	{
		$this->checkCurrentNode()
		     ->checkLeftNode()
		     ->checkRightNode();
	}

	protected function checkCurrentNode()
	{
		StrategyManager::getForType($this->type)->isValid($this);

		return $this;
	}

	protected function checkLeftNode()
	{
		if (!is_null($this->left)) {
			static::validate($this->left);
		}

		return $this;
	}

	protected function checkRightNode()
	{
		if (!is_null($this->right)) {
			static::validate($this->right);
		}

		return $this;
	}

	protected function setType($type)
	{
		$this->type = $type;
	}

	protected function setTypeToRootNode()
	{
		$this->setType(static::TYPE_ROOT);
	}

	protected function setTypeToNodeWithNoChildren()
	{
		$this->setType(static::TYPE_WITH_NO_CHILDREN);
	}

	protected function setTypeToNodeWithChildren()
	{
		$this->setType(static::TYPE_WITH_CHILDREN);
	}
}
