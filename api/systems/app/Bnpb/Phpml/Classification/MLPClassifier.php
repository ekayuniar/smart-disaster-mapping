<?php

declare(strict_types=1);

namespace App\Bnpb\Phpml\Classification;

use App\Bnpb\Phpml\Exception\InvalidArgumentException;
use App\Bnpb\Phpml\NeuralNetwork\Network\MultilayerPerceptron;

class MLPClassifier extends MultilayerPerceptron implements Classifier
{
    /**
     * @param mixed $target
     *
     * @throws InvalidArgumentException
     */
    public function getTargetClass($target): int
    {
        if (!in_array($target, $this->classes, true)) {
            throw new InvalidArgumentException(
                sprintf('Target with value "%s" is not part of the accepted classes', $target)
            );
        }

        return array_search($target, $this->classes, true);
    }

    /**
     * @return mixed
     */
    protected function predictSample(array $sample)
    {
        $output = $this->setInput($sample)->getOutput();

        $predictedClass = null;
        $max = 0;
        foreach ($output as $class => $value) {
            if ($value > $max) {
                $predictedClass = $class;
                $max = $value;
            }
        }

        return $predictedClass;
    }

    /**
     * @param mixed $target
     */
    protected function trainSample(array $sample, $target): void
    {
        // Feed-forward.
        $this->setInput($sample);

        // Back-propagate.
        $this->backpropagation->backpropagate($this->getLayers(), $this->getTargetClass($target));
    }
}
