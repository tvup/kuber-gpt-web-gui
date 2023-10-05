<?php

namespace App\Enums;

enum CredentialTypeEnum: string
{
    case V = 'valid';
    case R = 'revoked';
    case E = 'expired';

    public static function to(string $string): CredentialTypeEnum|null
    {
        if (CredentialTypeEnum::V->name == $string) {
            return CredentialTypeEnum::V;
        } elseif (CredentialTypeEnum::R->name == $string) {
            return CredentialTypeEnum::R;
        } elseif (CredentialTypeEnum::E->name == $string) {
            return CredentialTypeEnum::E;
        }

        return null;
    }
}
