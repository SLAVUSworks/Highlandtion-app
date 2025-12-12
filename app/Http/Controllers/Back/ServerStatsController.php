<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class ServerStatsController extends Controller
{
    public function index()
    {
        return view('back.server-stats.server-stats');
    }

    // API endpoint untuk AJAX
    public function stats()
    {
        return response()->json([
            'cpu_percent'   => $this->getCpuUsagePercent(),
            'cpu_usage'     => $this->getCpuUsage(),
            'memory'        => $this->getMemoryUsage(),
            'disk'          => $this->getDiskUsage(),
            'load_average'  => sys_getloadavg(),
            'uptime'        => $this->getUptime(),
            'ping'          => $this->getPing('8.8.8.8'),
            'database'      => $this->getDatabaseStats(),
            'network'       => $this->getNetworkStats('enp0s3'),
        ]);
    }

    private function getCpuUsage()
    {
        $load = sys_getloadavg();
        return $load[0];
    }

    private function getCpuUsagePercent()
    {
        $load = sys_getloadavg()[0];
        $cores = (int) shell_exec("nproc");

        return round(($load / $cores) * 100, 2);
    }

    private function getMemoryUsage()
    {
        $mem = [];
        foreach (file('/proc/meminfo') as $line) {
            list($key, $val) = explode(':', $line);
            $mem[$key] = trim($val);
        }

        $total = (int) filter_var($mem['MemTotal'], FILTER_SANITIZE_NUMBER_INT);
        $free  = (int) filter_var($mem['MemAvailable'], FILTER_SANITIZE_NUMBER_INT);

        return [
            'total'      => round($total / 1024, 2),
            'used'       => round(($total - $free) / 1024, 2),
            'percentage' => round((($total - $free) / $total) * 100, 2)
        ];
    }

    private function getDiskUsage()
    {
        $total = disk_total_space('/');
        $free  = disk_free_space('/');
        $used  = $total - $free;

        return [
            'total_gb'        => round($total / 1024 / 1024 / 1024, 2),
            'used_gb'         => round($used / 1024 / 1024 / 1024, 2),
            'free_gb'         => round($free / 1024 / 1024 / 1024, 2),
            'used_percentage' => round(($used / $total) * 100, 2),
        ];
    }

    private function getDatabaseStats()
    {
        $start = microtime(true);

        try {
            \DB::select("SELECT 1");

            $ping = (microtime(true) - $start) * 1000; 
            $ping = round($ping, 2);

            return [
                'status' => 'online',
                'ping' => $ping,
            ];

        } catch (\Exception $e) {

            return [
                'status' => 'offline',
                'ping' => null,
            ];
        }
    }

    private function getUptime()
    {
        $uptime_seconds = (int) shell_exec("cut -f1 -d. /proc/uptime");

        $d = intdiv($uptime_seconds, 86400);
        $h = intdiv($uptime_seconds % 86400, 3600);
        $m = intdiv($uptime_seconds % 3600, 60);
        $s = $uptime_seconds % 60;

        $parts = [];

        if ($d > 0) $parts[] = $d . 'd';
        if ($h > 0) $parts[] = $h . 'h';
        if ($m > 0) $parts[] = $m . 'm';
        if ($s > 0) $parts[] = $s . 's';

        if (empty($parts)) {
            $parts[] = '0s';
        }

        return implode(' ', $parts);
    }

    private function getPing($host = '8.8.8.8')
    {
        $output = shell_exec("ping -c 1 -W 1 $host");

        if (!$output) {
            return null;
        }

        preg_match('/time=([\d\.]+)\s*ms/', $output, $matches);

        return $matches[1] ?? null;
    }

    private function getNetworkStats($interface = 'enp0s3')
    {
        $rx = @file_get_contents("/sys/class/net/{$interface}/statistics/rx_bytes");
        $tx = @file_get_contents("/sys/class/net/{$interface}/statistics/tx_bytes");

        return [
            'rx' => $rx ? (int)$rx : 0,
            'tx' => $tx ? (int)$tx : 0,
        ];
    }

    public function api(DatabaseStatsService $dbStats)
    {
        return response()->json([
            'db' => $dbStats->getStats(),
            'network' => $this->getNetworkStats('enp0s3')
        ]);
    }
}
