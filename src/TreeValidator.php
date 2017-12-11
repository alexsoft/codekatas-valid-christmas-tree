<?php

namespace Christmas;

use Christmas\Entities\Node;
use Christmas\Exceptions\BaseException;

class TreeValidator
{
	/**
	 * @var array
	 */
	protected $tree;

	/**
	 * @param array $tree
	 */
	public function __construct(array $tree)
	{
		$this->tree = $tree;
	}

	/**
	 * @param array $tree
	 *
	 * @return bool
	 */
	public static function validate(array $tree)
	{
		return (new static($tree))->isValid();
	}

	/**
	 * @return bool
	 */
	public function isValid()
	{
		try {
			Node::validate($this->tree, true);

			return true;
		} catch (BaseException $e) {
			return false;
		}
	}
}
