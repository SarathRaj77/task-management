<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Fluent;

readonly class TaskDto extends Dto
{
    public function __construct(
        public string $title,
        public string $description,
        public string $due_date,
    ) {}

    public static function build(array $array): self
    {
        $data = new Fluent($array);

        return new self(
            $data->title,
            $data->description,
            $data->due_date,
        );
    }
}
