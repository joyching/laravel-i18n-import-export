<?php

namespace Joyching\I18n\Tests\Unit;

use Mockery as m;
use Joyching\I18n\Export;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;

class ExportTest extends TestCase
{
    public function testToCsv()
    {
        Config::shouldReceive('get')
            ->with('i18ntool.path')
            ->andReturn(dirname(dirname(__FILE__)) . '/Fake/resources/lang');

        Config::shouldReceive('get')
            ->with('filesystems.default')
            ->andReturn('local');

        $mockFileLoader = m::mock('Illuminate\Translation\FileLoader');
        $mockFileLoader->shouldReceive('load')
                    ->andReturn([
                        'failed' => 'These credentials do not match our records.',
                        'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
                    ]);

        Lang::shouldReceive('getLoader')->once()->andReturn($mockFileLoader);

        $export = new Export;

        $this->assertTrue($export->toCsv());
        $this->assertTrue(file_exists(storage_path('app/i18n-exports/en.csv')));

        // 清除測試檔案
        unlink(storage_path('app/i18n-exports/en.csv'));
    }
}
