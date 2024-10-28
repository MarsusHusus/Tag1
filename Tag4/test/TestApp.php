<?php
include "vendor/autoload.php";
session_start();
use app\app\app;

class TestApp extends PHPUnit\Framework\TestCase
{
    private app $app;

    protected function setUp(): void
    {
        // Setup, wird vor jedem Test aufgerufen
        $this->app = new app('status', '');
    }

    //php vendor/bin/phpunit test/TestApp.php --colors

    public function testIsStatusArray() {

        ob_start();
        $this->app->status();
        $output = ob_get_clean();

        $this->assertJSON($output);
    }

    public function testCheckStatusSet() {
            
             // Test valid statuses
             $this->assertTrue($this->app->setStufe(1));
             $this->assertTrue($this->app->setStufe(2));
             $this->assertTrue($this->app->setStufe(3));
      
             // Test invalid status
             $this->assertFalse($this->app->setStufe(4));
             $this->assertFalse($this->app->setStufe("invalid"));
    }
}