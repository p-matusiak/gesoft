<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class GenerateArticleCommand extends Command
{
    protected $signature = 'articles:generate {--topic= : Opcjonalny klucz branży}';

    protected $description = 'Uruchom lokalnego Groka (ta sama sesja co TUI), żeby dodał 1 artykuł do bazy';

    public function handle(): int
    {
        $script = base_path('scripts/generate-article.sh');
        if (! is_file($script)) {
            $this->error('Brak skryptu '.$script);

            return self::FAILURE;
        }

        $env = $_SERVER + $_ENV;
        $env['HOME'] = $env['HOME'] ?? '/home/pawel';
        $env['PATH'] = ($env['HOME'] ?? '/home/pawel').'/.local/bin:'.($env['PATH'] ?? '/usr/bin');
        if ($topic = $this->option('topic')) {
            $env['ARTICLE_TOPIC'] = $topic;
        }

        $process = new Process(['bash', $script], base_path('..'), $env, null, 3600);
        $process->run(function (string $type, string $buffer): void {
            $this->output->write($buffer);
        });

        return $process->isSuccessful() ? self::SUCCESS : self::FAILURE;
    }
}
