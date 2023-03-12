<?php

namespace Pingpress\Enum;

enum LicenceTypeEnum: string
{
    use EnumTrait;

    case LOISIR = 'Loisir';
    case COMPETITION = 'Compétition';
}