<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Commands;

use Carbon\Carbon;
use Cron\CronExpression;
use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Collection;

/**
 * Commands schedule helpers.
 */
class Schedule
{
    /**
     * Get a collection of the schedule for the specified command instance.
     */
    public static function getSchedule(Command $instance): Collection
    {
        // Boot the console kernel to get the events, they don't exist in the web context
        $app = app()->make(\Illuminate\Contracts\Console\Kernel::class);
        $app->bootstrap();
        $schedule = app(\Illuminate\Console\Scheduling\Schedule::class);
        // --------------------------------------------

        return collect($schedule->events())
            ->filter(fn (Event $event) => str_contains($event->command, $instance->getName()))
            ->map(fn (Event $event) => (object) [
                'command' => $event->command,
                'expression' => $event->expression,
                'environments' => collect($event->environments)->implode(', '),
                'nextRunDate' => (new CronExpression($event->expression))->getNextRunDate()->format('Y-m-d H:i:s'),
                'nextRunDiff' => Carbon::parse((new CronExpression($event->expression))->getNextRunDate())->diffForHumans(),
                'previousRunDate' => (new CronExpression($event->expression))->getPreviousRunDate()->format('Y-m-d H:i:s'),
                'previousRunDiff' => Carbon::parse((new CronExpression($event->expression))->getPreviousRunDate())->diffForHumans(),
            ]);
    }
}