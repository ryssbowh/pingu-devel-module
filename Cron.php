<?php 

namespace Pingu\Devel;

use Illuminate\Console\Scheduling\Schedule;
use Closure;

class Cron
{
    protected $crons;
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function closure(string $title, Closure $closure)
    {
        $this->crons[md5($title.$closure)] = [
            'title' => $title,
            'type' => 'closure',
            'closure' => $closure
        ];
        return $this->schedule->call($closure);
    }

    public function command(string $title, string $command)
    {
        $this->crons[md5($title.$command)] = [
            'title' => $title,
            'type' => 'command',
            'command' => $command
        ];
        return $this->schedule->command($command);
    }

    public function shell(string $title, string $command)
    {
        $this->crons[md5($title.$command)] = [
            'title' => $title,
            'type' => 'shell',
            'command' => $command
        ];
        return $this->schedule->exec($command);
    }

    public function crons()
    {
        return $this->crons;
    }
}