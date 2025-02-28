<?php

namespace App\Requests\Auth;

use App\Exceptions\PasswordMismatchException;
use App\Exceptions\WrongCredenticalsException;
use App\Http\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class CreateRequest extends Request
{

    public function validate($data)
    {
        if($data['password'] === $data['password_confirmed']){
            unset($data['password_confirmed']);
            return $this->validator->validate($data, [
                'name' => new Length([
                    'min' => 5,
                    'max' => 20,
                ]),
                'email' => new Email(),
                'password' => new Length([
                    'min' => 3,
                    'max' => 20,
                ]),
            ]);
        }
        $property = 'password';
        $message = 'пароли должны совпадать';
        throw (new WrongCredenticalsException())->handle([$property => $message]);
    }
}
