<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validation;
use Throwable;

abstract class Validator
{
    /** @var array */
    private $payload;

    /** @throws Throwable */
    public function __invoke(Request $request): void
    {
        $payload = $request->attributes->get('_route_params');
        if ($request->files->count()) {
            $payload = array_merge($payload, $request->files->all());
        }

        $payload = array_merge($payload, $request->query->all());
        if (!$request->isMethodSafe() && !$request->isMethod(Request::METHOD_DELETE)) {
            $payload = array_merge($payload, $request->request->all());
        }

        $this->payload = $payload;

        $constraints = $this->constraints();
        $violations = Validation::createValidator()->validate($payload, $constraints);

        if ($violations->count() > 0) {
            throw ValidationException::fromViolations($violations, ['payload' => $payload]);
        }
    }
    /**
     * @param mixed $value
     * @param Constraint|Constraint[] $constraints
     */
    protected function checkNullableValue(
        $value,
        $constraints,
        ExecutionContextInterface $context
    ): void
    {
        if (is_null($value)) {
            return;
        }
        $this->checkValue($value, $constraints, $context);
    }
    /**
     * @param mixed $value
     * @param Constraint|Constraint[] $constraints
     */
    protected function checkValue(
        $value,
        $constraints,
        ExecutionContextInterface $context
    ): void
    {
        $validateProviderName = $context->getValidator()->validate($value, $constraints);
        for ($i = 0; $i < $validateProviderName->count(); $i++) {
            $context->addViolation($validateProviderName->get($i)->getMessage());
        }
    }
    /** @return Constraint|Constraint[] */
    abstract protected function constraints();

    protected function payload(): array
    {
        return $this->payload;
    }
}
