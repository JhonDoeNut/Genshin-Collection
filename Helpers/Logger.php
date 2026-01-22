<?php
namespace Helpers;

class Logger
{
    private string $dir;

    public function __construct(string $dir = 'logs')
    {
        $this->dir = rtrim($dir, '/');
        if (!is_dir($this->dir)) mkdir($this->dir, 0777, true);
    }

    private function fileForCurrentMonth(): string
    {
        return $this->dir . '/MIHOYO_' . date('m_Y') . '.log';
    }

    public function write(string $action, bool $success, string $details = ''): void
    {
        $date = date('Y-m-d H:i:s');
        $status = $success ? 'SUCCESS' : 'FAIL';
        $line = sprintf("[%s] %-6s %-7s %s", $date, strtoupper($action), $status, $details);
        file_put_contents($this->fileForCurrentMonth(), $line . PHP_EOL, FILE_APPEND);
    }

    public function listMonths(): array
    {
        $files = glob($this->dir . '/MIHOYO_*.log') ?: [];
        rsort($files);
        return array_map(fn($p) => str_replace('MIHOYO_', '', basename($p, '.log')), $files);
    }

    public function read(string $ym): string
    {
        if (!preg_match('/^\d{2}_\d{4}$/', $ym)) return "Log invalide";
        $file = $this->dir . '/MIHOYO_' . $ym . '.log';
        return file_exists($file) ? (file_get_contents($file) ?: '') : "Aucun log pour $ym";
    }
}