@props([
    'expression' => '* * * * *',
])

@php($expression = explode(' ', $expression))
<div class="space-y-4">
    <table>
        <thead>
            <tr>
                <th class="font-light text-center px-4">Minute</th>
                <th class="font-light text-center px-4">Hour</th>
                <th class="font-light text-center px-4">Day of Month</th>
                <th class="font-light text-center px-4">Month</th>
                <th class="font-light text-center px-4">Day of Week</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-xl">
                <td class="text-center">{{ $expression[0] }}</td>
                <td class="text-center">{{ $expression[1] }}</td>
                <td class="text-center">{{ $expression[2] }}</td>
                <td class="text-center">{{ $expression[3] }}</td>
                <td class="text-center">{{ $expression[4] }}</td>
            </tr>
        </tbody>
    </table>

    {{-- <p class="flex border rounded-xl p-2 gap-4">
        <span class="font-bold w-32 flex-none">Next run</span>
        <span>{{ (new \Cron\CronExpression('30 * * * *'))->getNextRunDate()->format('Y-m-d H:i:s') }}</span>
        <span class="flex-1 text-right">{{ Carbon\Carbon::parse((new \Cron\CronExpression('30 * * * *'))->getNextRunDate())->diffForHumans() }}</span>
    </p>
    <p class="flex border rounded-xl p-2 gap-4">
        <span class="font-bold w-32 flex-none">Previous run</span>
        <span>{{ (new \Cron\CronExpression('30 * * * *'))->getPreviousRunDate()->format('Y-m-d H:i:s') }}</span>
        <span class="flex-1 text-right">{{ Carbon\Carbon::parse((new \Cron\CronExpression('30 * * * *'))->getPreviousRunDate())->diffForHumans() }}</span>
    </p> --}}
</div>