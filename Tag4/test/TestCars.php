<?php
include "vendor/autoload.php";
use PHPUnit\Framework\TestCase;
use app\cars\cars;

class TestCars extends TestCase
{
    private cars $cars;

    protected function setUp(): void
    {
        // Setup, wird vor jedem Test aufgerufen
        $this->cars = new cars();
    }

    public function testCarClass()
    {
        // Überprüft, ob die cars-Instanz nicht null ist
        $this->assertNotNull($this->cars);

        // Überprüft, ob die cars-Instanz eine Instanz der erwarteten Klasse ist
        $this->assertInstanceOf(cars::class, $this->cars);
    }
    public function testGetDataReturnsJson()
    {
        // Setze Test-ID
        $testId = '1';
        ob_start();
        $this->cars->getData($testId);
        $output = ob_get_clean();

        // Überprüft, ob die Rückgabe ein gültiges JSON ist
        $this->assertJson($output);

        // JSON dekodieren
        $data = json_decode($output, true);

        // Überprüft, ob das JSON ein Array ist
        $this->assertIsArray($data);


        // Überprüft, ob entweder 'success' oder 'error' vorhanden ist und reagiert entsprechend
        if (isset($data['success'])) {
            // Erfolgreicher Test, gibt den Text bei Erfolg aus
            $this->assertNotEmpty($data['success'], 'OK');
        } elseif (isset($data['error'])) {
            // Fehlschlagender Test, gibt den Fehlertext aus
            $this->fail($data['error']);
        } else {
            // Falls weder 'success' noch 'error' vorhanden sind, wird der Test fehlschlagen
            $this->fail('Weder success noch error im Ergebnis gefunden.');
        }
    }
}

// php vendor/bin/phpunit test/TestCars.php --colors