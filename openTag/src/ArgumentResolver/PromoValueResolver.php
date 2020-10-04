<?php


namespace App\ArgumentResolver;

use App\Entity\Promo;
use App\DTO\Request\CreatePromoRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PromoValueResolver implements ArgumentValueResolverInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Whether this resolver can resolve the value for the given ArgumentMetadata.
     *
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return CreatePromoRequest::class === $argument->getType();
    }

    /**
     * Returns the possible value(s).
     *
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return void
     */
    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $createPromoRequest = $this->serializer->deserialize(
            $request->getContent(),
            $argument->getType(),
            JsonEncoder::FORMAT
        );

        $promo = new Promo();
        $promo->setTitle($request->get('title'))
            ->setMainText($request->get('mainText'))
            ->setCategory($request->get('category'));

        $constraints = $this->validator->validate($promo);

        if ($constraints->count() > 0) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException();
        }

        yield $createPromoRequest;
    }
}