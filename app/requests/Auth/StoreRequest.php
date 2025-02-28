<?php

namespace App\Requests\Auth;

use App\Http\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StoreRequest extends Request
{
    public function validate($data)
    {
        return $this->validator->validate($data, [
            'email' => new Email(),
            'password' => new NotBlank(),
        ]);
    }
}
