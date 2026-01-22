<?php
namespace Config;

use Exception;

class Config {
    private static ?array $param = null;

    /**
     * @throws Exception
     */
    public static function get(string $nom, $valeurParDefaut = null) {
        $params = self::getParameter();

        if (isset($params[$nom])) return $params[$nom];

        if (str_contains($nom, '.')) {
            [$section, $key] = explode('.', $nom, 2);
            if (isset($params[$section][$key])) return $params[$section][$key];
        }

        return $valeurParDefaut;
    }

    /**
     * @throws Exception
     */
    private static function getParameter(): array {
        if (self::$param === null) {
            $cheminFichier = "Config/prod.ini";
            if (!file_exists($cheminFichier)) $cheminFichier = "Config/dev.ini";

            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            }

            // IMPORTANT : true pour garder les sections [DB]
            self::$param = parse_ini_file($cheminFichier, true);
        }
        return self::$param;
    }
}
