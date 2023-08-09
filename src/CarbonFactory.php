<?php

namespace Molay76\CarbonJp;

use Carbon\CarbonImmutable;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Carbon;

class CarbonFactory
{
    /**
     * @param \DateTimeInterface|string|null $time
     * @param \DateTimeZone|string|null      $tz
     *
     * @throws InvalidFormatException
     */
    public static function make(\DateTimeInterface|string $time = null, \DateTimeZone|string $tz = null): Carbon
    {
        return (new Carbon($time, $tz))->setTimezone($tz ?? config('app.timezone') ?? 'Asia/Tokyo');
    }

    /**
     * @param \DateTimeInterface|string|null $time
     * @param \DateTimeZone|string|null      $tz
     *
     * @throws InvalidFormatException
     */
    public static function makeAsImmutable(\DateTimeInterface|string $time = null, \DateTimeZone|string $tz = null): CarbonImmutable
    {
        return (new CarbonImmutable($time, $tz))->setTimezone($tz ?? config('app.timezone') ?? 'Asia/Tokyo');
    }
}
