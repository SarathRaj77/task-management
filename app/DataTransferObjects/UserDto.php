<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Fluent;

readonly class UserDto extends Dto
{

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function build(array $array): self
    {
        $data = new Fluent($array);

        return new self(
            $data->name,
            $data->email,
            $data->password,
        );
    }
}
