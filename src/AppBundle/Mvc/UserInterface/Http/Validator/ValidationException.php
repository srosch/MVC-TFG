<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use AppBundle\Mvc\Exceptions\BadRequestExceptionMvc;
use Symfony\Component\Validator\{ConstraintViolationInterface as Constraint,
    ConstraintViolationListInterface as Constraints
};
use Throwable;

final class ValidationException extends BadRequestExceptionMvc
{
    public function __construct(array $meta = [])
    {
        parent::__construct('Validation error', $meta);
    }

    /** @throws Throwable */
    public static function fromKey(string $key, array $meta = []): ValidationException
    {
        return new self(array_merge($meta, ['errors' => json_encode(['key' => $key])]));
    }
    /** @throws Throwable */
    public static function fromViolations(
        Constraints $constraints,
        array $meta = []
    ): ValidationException {
        return new self(
            array_merge(
                $meta,
                [
                    'errors' => json_encode(array_reduce(
                        iterator_to_array($constraints),
                        static function ($acc, Constraint $const) {
                            $acc[str_replace(['[', ']'], '', $const->getPropertyPath())] = (string)$const->getMessage();
                            return $acc;
                        },
                        []
                    ))
                ]
            )
        );
    }
}
