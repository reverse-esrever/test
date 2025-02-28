<?php

namespace App\Illuminate\Support;

use App\Exceptions\WrongCredenticalsException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Validation;

class Validator
{
    public function __construct() {}

    public function validate(array $data, array $constraits = [])
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($data, [new Collection(
            $constraits
        )]);
        if (0 !== count($violations)) {
            $errors = [];
            foreach ($violations as $key => $violation) {
                $name = $violation->getPropertyPath();
                $name = str_replace(['[', ']'], '', $name);
                $errors[$name] = $violation->getMessage();
            }
            throw (new WrongCredenticalsException())->handle($errors);
        }
        return $data;
    }
}
