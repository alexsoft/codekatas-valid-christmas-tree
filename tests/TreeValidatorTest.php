<?php

namespace Tests;

use Christmas\TreeValidator;

class TreeValidatorTest extends BaseTest
{
    protected $validTrees = [
        [
            'ornament' => 'star',
            'color' => 'yellow',
        ],
        [
            'ornament' => 'star',
            'color' => 'yellow',
            'left' => [
                'ornament' => 'candy cane',
                'color' => 'blue',
            ]
        ]
    ];

    protected $invalidTrees = [
        [
            'ornament' => 'star',
            'color' => 'yellow',
            'right' => [
                'ornament' => 'stocking',
                'color' => 'red',
            ]
        ]
    ];

    /** @test */
    public function valid_trees_are_validated_correctly()
    {
        foreach ($this->validTrees as $tree) {
            $this->assertTrue(TreeValidator::validate($tree));
        }
    }

    /** @test */
    public function invalid_trees_are_validated_correctly()
    {
        foreach ($this->invalidTrees as $tree) {
            $this->assertFalse(TreeValidator::validate($tree));
        }
    }
}
