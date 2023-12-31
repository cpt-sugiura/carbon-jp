<?php

namespace Molay76\CarbonJp;

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class CarbonServiceProvider extends ServiceProvider
{
    public function register()
    {
        /* 直前の上期、下期の始まりを返す */
        $getFloorHalfFiscalYear =             function () {
            /** @var Carbon $this */
            $c = $this->clone();
            if (in_array($this->month, [4, 5, 6, 7, 8, 9], true)) {
                return $c->setDate($c->year, 4, 1)->setTime(0, 0, 0);
            }
            // 10, 11, 12, 1, 2, 3
            if (in_array($this->month, [1, 2, 3], true)) {
                $c->subYear();
            }

            return $c->setDate($c->year, 10, 1)->setTime(0, 0, 0);
        };
        Carbon::macro('getFloorHalfFiscalYear', $getFloorHalfFiscalYear);
        CarbonImmutable::macro('getFloorHalfFiscalYear', $getFloorHalfFiscalYear);
        /* 直前の期の始まりを返す */
        $getFloorFiscalYear =    function () {
            /** @var Carbon $this */
            $c = $this->clone();
            if (in_array($this->month, [1, 2, 3], true)) {
                $c->subYear();
            }

            return $c->setDate($c->year, 4, 1)->setTime(0, 0, 0);
        };
        Carbon::macro('getFloorFiscalYear', $getFloorFiscalYear);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/_ide_helper_carbon.php' => base_path('_ide_helper_carbon.php'),
        ]);
    }
}
