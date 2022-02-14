<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserInputDataTransformer implements DataTransformerInterface
{
    public $userPasswordHasherInterface;
    function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $user = new User();
        $user->setEmail($data->email);
        $user->setRoles($data->roles);
        $user->setFirstname($data->firstname);
        $user->setLastname($data->lastname);
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user,
                $data->password
            )
        );
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof User) {
            return false;
        }

        return User::class === $to && null !== ($context['input']['class'] ?? null);
    }

}