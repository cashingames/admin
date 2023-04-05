<?php

namespace App\Enums;

enum PlatformType: string
{
    case GameArk = "GAMEARK";
    case Cashingames = "CASHINGAMES";
    case V1 = "BEFORE_APP_SPLIT";
}