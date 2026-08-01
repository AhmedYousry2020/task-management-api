<?php

namespace App\Console\Commands;

use App\Enums\TaskStatus;
use App\Jobs\SendOverdueTaskNotificationJob;
use App\Models\Task;
use Illuminate\Console\Command;

class CheckOverdueTasksCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-overdue-tasks-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send overdue task notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Task::query()
            ->where('status', TaskStatus::TODO)
            ->whereDate('due_date', '<', today())
            ->where('notification_sent', false)
            ->chunkById(100, function ($tasks) {

                foreach ($tasks as $task) {
                    SendOverdueTaskNotificationJob::dispatch($task);
                }
            });
    }
}
