<?php
namespace app\app;
 
class app
{
    /**
     * Konstruktor der Klasse cars.
     *
     * @param string $methode   Die Methode, die aufgerufen werden soll.
     * @param string $parameter Der Parameter, der der Methode übergeben wird.
     */
    public function __construct(string $methode = "", string $parameter = "") {
        if (!empty($methode) && method_exists($this, $methode)) {
            try {
                $this->$methode($parameter);
            } catch (\Exception $e) {
                \lib\response::errorJSON(["error" => "Fehler bei der Ausführung der Methode: " . $e->getMessage()]);
            }
        } else {
            \lib\response::errorJSON(array: ["error" => true]);
        }
    }

    public function setStufe($nummer) {
        if($nummer == 1 OR $nummer == 2 OR $nummer == 3) {
            try{
                $_SESSION['stuffe'] = $nummer;
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public function login() {
        $_SESSION['user'] = 'admin';
        $_SESSION['stufe'] = 1;

        // 1 = admins (delete)
        // 2 = PowerUser (editieren)
        // 3 = user (lesen)
        // 0 = nix
    }
    public function logout() {
        $_SESSION['user'] = '';
        $_SESSION['stufe'] = 0;
    }
    public function status() {
        $data['session'] = $_SESSION;
        \lib\response::successJSON($data);
    }
}