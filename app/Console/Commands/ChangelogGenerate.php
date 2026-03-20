<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class ChangelogGenerate extends Command
{
    protected $signature = 'changelog:generate
        {version? : Semantic version (e.g. 1.6.0). Omit to auto-increment from latest in changelog.}
        {--title= : Release title (auto-generated from commits if omitted)}
        {--tag=New : Release tag: New, Improved, Fix, or Launch}
        {--since= : Git ref to diff from (default: latest tag or previous version when auto-incrementing)}
        {--minor : Bump minor version when auto-incrementing (1.6.0 -> 1.7.0)}
        {--major : Bump major version when auto-incrementing (1.6.0 -> 2.0.0)}
        {--dry-run : Preview without writing}';

    protected $description = 'Generate a changelog entry from conventional git commits. Run with no version to auto-increment from last.';

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
        $tag = $this->option('tag');
        $since = $this->option('since');

        $version = $this->argument('version');
        if ($version === null) {
            $previous = $this->getLatestVersionFromChangelog();
            if ($previous === null) {
                $version = '1.0.0';
                $this->info('No version in changelog; using 1.0.0.');
            } else {
                $version = $this->incrementVersion($previous);
                $this->info("Auto-incremented version: {$previous} -> {$version}");
                // Don't set $since here - let it use latest git tag (or all commits)
            }
        }

        if (! $since) {
            $result = Process::run('git describe --tags --abbrev=0 2>/dev/null');
            $since = $result->successful() ? trim($result->output()) : null;
        }

        if ($since) {
            $verify = Process::run("git rev-parse --verify {$since} 2>/dev/null");
            if (! $verify->successful()) {
                $this->warn("Ref \"{$since}\" not found in repo; using all commits.");
                $since = null;
            }
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

    private function getLatestVersionFromChangelog(): ?string
    {
        $path = storage_path('app/changelog.json');
        if (! file_exists($path)) {
            return null;
        }
        $data = json_decode(file_get_contents($path), true);
        if (! is_array($data) || empty($data)) {
            return null;
        }
        $first = $data[0];
        $v = $first['version'] ?? null;

        return is_string($v) && preg_match('/^\d+\.\d+\.\d+$/', $v) ? $v : null;
    }

    private function incrementVersion(string $version): string
    {
        if (! preg_match('/^(\d+)\.(\d+)\.(\d+)$/', $version, $m)) {
            return '1.0.0';
        }
        $major = (int) $m[1];
        $minor = (int) $m[2];
        $patch = (int) $m[3];

        if ($this->option('major')) {
            return ($major + 1).'.0.0';
        }
        if ($this->option('minor')) {
            return "{$major}.".($minor + 1).'.0';
        }

        return "{$major}.{$minor}.".($patch + 1);
    }
}
