<?php

namespace Christmas\ValidationStrategies;

class StrategyManager
{
    protected $strategiesCache = [];

    /**
     * @param string $type
     *
     * @return BaseValidationStrategy
     */
    public static function getForType($type)
    {
        return (new static())->getType($type);
    }

    public function getType($type)
    {
        $strategies = [
            RootNodeValidationStrategy::class,
            NodeWithNoChildrenValidationStrategy::class,
            NodeWithChildrenValidationStrategy::class,
        ];

        foreach ($strategies as $strategy) {
            $instance = $this->getStrategyInstance($strategy);

            if ($instance->canValidate($type)) {
                return $instance;
            }
        }

        throw new \RuntimeException('Could not find a strategy for [' . $type . '] type.');
    }

    /**
     * @param string $strategy
     *
     * @return BaseValidationStrategy
     */
    protected function getStrategyInstance($strategy)
    {
        if (!array_key_exists($strategy, $this->strategiesCache) || is_null($this->strategiesCache[$strategy])) {
            $this->strategiesCache[$strategy] = new $strategy;
        }

        return $this->strategiesCache[$strategy];
    }
}
