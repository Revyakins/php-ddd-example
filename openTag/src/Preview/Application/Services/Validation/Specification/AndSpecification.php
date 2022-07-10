<?php
declare(strict_types=1);

namespace Validation\Specification;

use App\Entity\Promo;

class AndSpecification implements Specification
{
    private array $specifications;

    /**
     * AndSpecification constructor.
     * @param Specification ...$specifications
     */
    public function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * @param Promo $promo
     * @return bool
     */
    public function isSatisfiedBy(Promo $promo): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($promo)) {
                return false;
            }
        }

        return true;
    }
}