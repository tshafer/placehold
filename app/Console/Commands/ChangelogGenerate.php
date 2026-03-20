<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ChangelogGenerate extends Command
{
    protected $signature = 'changelog:generate
        {version : Semantic version for this release (e.g. 1.6.0)}
        {--title= : Release title (auto-generated from commits if omitted)}
        {--tag=New : Release tag: New, Improved, Fix, or Launch}
        {--since= : Git ref to diff from (defaults to latest git tag, or all commits)}
        {--dry-run : Preview without writing}';

    protected $description = 'Generate a changelog entry from conventional git commits';

    private const TYPE_MAP = [
        'feat'     => 'New Features',
        'fix'      => 'Bug Fixes',
        'style'    => 'Design',
        'refactor' => 'Improvements',
        'perf'     => 'Performance',
        'test'     => 'Testing',
        'docs'     => 'Documentation',
        'chore'    => 'Maintenance',
        'build'    => 'Build',
        'ci'       => 'CI/CD',
    ];

    public function handle(): int
    {
        $version = $this->argument('version');
        $tag = $this->option('tag');
        $since = $this->option('since');

        if (! $since) {
            $result = Process::run('git describe --tags --abbrev=0 2>/dev/null');
            $since = $result->successful() ? trim($result->output()) : null;
        }

        $range = $since ? "{$since}..HEAD" : 'HEAD';
        $format = '%s';
        $result = Process::run("git log {$range} --pretty=format:\"{$format}\" --no-merges");

        if (! $result->successful()) {
            $this->error('Failed to read git log.');
            return self::FAILURE;
        }

        $lines = array_filter(explode("\n", trim($result->output())));
        $grouped = $this->groupCommits($lines);

        if (empty($grouped)) {
            $this->warn('No conventional commits found in range.');
            return self::SUCCESS;
        }

        $items = $this->buildItems($grouped);
        $title = $this->option('title') ?? $this->generateTitle($grouped);

        $entry = [
            'version' => $version,
            'date' => now()->format('F Y'),
            'tag' => $tag,
            'title' => $title,
            'items' => $items,
        ];

        $this->info("Changelog entry for v{$version}:");
        $this->line("  Tag:   {$tag}");
        $this->line("  Title: {$title}");
        $this->line("  Items:");
        foreach ($items as $item) {
            $this->line("    - {$item}");
        }

        if ($this->option('dry-run')) {
            $this->warn('Dry run — not writing.');
            return self::SUCCESS;
        }

        $this->writeEntry($entry);
        $this->info("Written to storage/app/changelog.json");

        return self::SUCCESS;
    }

    private function groupCommits(array $lines): array
    {
        $grouped = [];

        foreach ($lines as $line) {
            if (preg_match('/^(\w+)(?:\(([^)]*)\))?:\s*(.+)$/', $line, $m)) {
                $type = strtolower($m[1]);
                $message = ucfirst(trim($m[3]));

                if (isset(self::TYPE_MAP[$type])) {
                    $grouped[$type][] = $message;
                }
            }
        }

        return $grouped;
    }

    private function buildItems(array $grouped): array
    {
        $items = [];
        $priority = ['feat', 'fix', 'perf', 'refactor', 'style', 'docs', 'test', 'chore', 'build', 'ci'];

        foreach ($priority as $type) {
            if (! isset($grouped[$type])) {
                continue;
            }

            foreach ($grouped[$type] as $msg) {
                $items[] = $msg;
            }
        }

        return array_values(array_unique($items));
    }

    private function generateTitle(array $grouped): string
    {
        $parts = [];

        foreach (['feat' => 'New Features', 'fix' => 'Bug Fixes', 'style' => 'Design Updates', 'refactor' => 'Improvements'] as $type => $label) {
            if (isset($grouped[$type])) {
                $parts[] = $label;
            }
        }

        return implode(', ', $parts) ?: 'Updates';
    }

    private function writeEntry(array $entry): void
    {
        $path = storage_path('app/changelog.json');

        $existing = file_exists($path)
            ? json_decode(file_get_contents($path), true) ?? []
            : [];

        $index = null;
        foreach ($existing as $i => $e) {
            if ($e['version'] === $entry['version']) {
                $index = $i;
                break;
            }
        }

        if ($index !== null) {
            $existing[$index] = $entry;
        } else {
            array_unshift($existing, $entry);
        }

        file_put_contents($path, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
