<?php

declare(strict_types=1);

namespace Mvc\Domain\Factory;


use AppBundle\Shared\DateTimeValueObject;
use ReallySimpleJWT\Build;
use ReallySimpleJWT\Encode;
use ReallySimpleJWT\Exception\ValidateException;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Parse;
use ReallySimpleJWT\Token;
use ReallySimpleJWT\Validate;

final class SimpleTokenFactory implements TokenFactory
{
    const DEFAULT_ISSUER = 'MedicalVirtualCenter';

    /**
     * @var Build
     */
    private $builder;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var int
     */
    private $expiration;
    /**
     * @var string
     */
    private $issuer;


    public function __construct(
        string $secret,
        int $expiration,
        string $issuer = self::DEFAULT_ISSUER
    ) {
        $this->builder = Token::builder();
        $this->secret = $secret;
        $this->expiration = $expiration;
        $this->issuer = $issuer;
    }

    /**
     * @throws ValidateException
     */
    public function encode(string $userId): array
    {
        $expirationDate = DateTimeValueObject::nowModify($this->expiration, 'days');
        $token = $this->builder
                ->setPayloadClaim('uuid', $userId)
                ->setSecret($this->secret)
                ->setExpiration($expirationDate->value()->getTimestamp())
                ->setNotBefore(DateTimeValueObject::now()->value()->getTimestamp() - 1)
                ->setIssuer($this->issuer)
                ->build()
                ->getToken();

            return [
                'token' => $token,
                'end_date' => $expirationDate->toISODate()
            ];
    }

    /** @return mixed */
    public function decode(string $token): array
    {
        $jwt = new Jwt($token, $this->secret);
        $parse = new Parse($jwt, new Validate(), new Encode());
        try {
            $parsed = $parse->validate()
                ->validateExpiration()
                ->validateNotBefore()
                ->parse();
            return $parsed->getPayload();
        } catch (ValidateException $e) {
            return [];
        }
    }
}
