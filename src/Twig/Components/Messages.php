<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Messages
{
    public function getRandomNumber(): int
    {
        return rand(0, 1000);
    }

    use DefaultActionTrait;
}
