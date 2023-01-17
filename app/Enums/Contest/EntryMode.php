<?php

namespace App\Enums\Contest;

enum EntryMode: string
{
    case free = "FREE";
    case PayWithPoints = "PAY_WITH_POINTS";
    case PayWithMoney = "PAY_WITH_MONEY";
    case MinimumPoints = "MINIMUM_POINTS";
}
