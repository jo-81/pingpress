<?php

namespace Pingpress\Enum;


trait EnumTrait
{
    /**
     * getLists
     *
     * @return array
     */
    public static function getLists(): array
    {
        $lists = [];
        foreach(self::cases() as $enum) {
            $lists[$enum->name] = __($enum->value, 'pingpress');
        }

        return $lists;
    }

    public static function getName(string $value): string
    {
        foreach(self::cases() as $enum) {
            if ($enum->value == $value) {
                return $enum->name;
            }
        }

        return '';
    }
}
