<?php

declare(strict_types=1);

namespace Validation\Specification;

class OrSpecification implements Specification
{
    private array $specifications;

    /**
     * OrSpecification constructor.
     * @param Specification ...$specifications
     */
    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * @param \App\Entity\Promo $promo
     * @return bool
     */
    public function isSatisfiedBy(\App\Entity\Promo $promo): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($promo)) {
                return true;
            }
        }

        return false;
    }
}
