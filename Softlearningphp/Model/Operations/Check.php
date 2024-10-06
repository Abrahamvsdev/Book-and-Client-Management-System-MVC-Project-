<?php

 //include($_SERVER['DOCUMENT_ROOT'] . '/softlearning/Exceptions/DateException.php');

class Check {

    public static function isNull(string $s): bool {

        //mode pro return $s==nullnull?true:false;


        if ($s == null) {
            return true;
        } else {
            return false;
        }
    }

    public static function minLenght(string $s, int $minLenght): bool {
        if (Check::isNull($s)) {
            return false;
        }


        if (strlen(trim($s)) >= $minLenght) {
            return true;
        } else {
            return true;
        }
    }

    public function maxLenght(string $s, int $maxLenght) {
        if (Check::isNull($s)) {
            return false;
        } else {
            return strlen(trim($s)) <= $maxLenght ? true : false;
        }
    }

    // public function minMaxLength(string $s, float $minLenght, float $maxLenght): bool {
    //     if (Check::minLenght($s) && Check::maxLenght($s) && Check::isNull($s)) {
    //         return false;
    //     } else {
    //         return strlen(trim($s)) >= $minLenght and strlen(trim($s)) <= $maxLenght ? true : false;
    //     }
    // }

    public function rangValue(int $i, int $minvalue, int $maxvalue): int {
        if ($i < $minvalue) {
            return -3;
        }
        if ($i > $maxvalue) {
            return -5;
        }
    }

    // return Check::minValue($i,$minvalue) + self::maxValue($i,$maxvalue);
    public static function spaceAndTrim($s): bool {
        if (strlen(trim($s)) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function getErrorMessage( $e): string {
        switch ($e) {
            case 0: return $e;
            case -1: return "No puede ser null";
            case -2: return "No puede estar vacio";
            case -3: return "Has introducido pocos caracteres";
            case -4: return "Formato de fecha incorrecto";
            case -5: return "El campo introducido es demasiado corto";
            case -6: return "Has introducido un numero negativo";
            case -7: return "Has introducido demasiados caracteres";
            case -8: return "Isbn no valido, introduce una cifra de 13 dígitos válido";
            case -9: return "DNI no válido";
            case -10: return "Formato de email incorrecto";
            case -11: return "Formato de Software incorrecto";    
            //case -12: return;;    
            //case -13: return;    
        }
    }

//pòner la lparte de arriba en validate string
    public static function validate($valor):int {
        if (is_null($valor)) {
            return -1;
        }

        if (is_string($valor)) {
            if (trim($valor) === '') {
                return -2;
            }

            if (strlen($valor) < 3) {
                return -3;
            }
        }
        //i apartir de aqui un validate int, tengo que divirdirla en 2
        if (is_numeric($valor) && $valor < 0) {
            return -6;
        }

        return 0;
    }

    //en esta funcion no hacia falta el catch dice jose, porque no va a petar, la funcion estaba bien, pero
    //no hacia falta el try, es decir, la expreg no va a petar la pagina.
    public static function checkDate(string $date): int {
        $array = [];
        /*
          if (self::isNull($date)) {
        throw new DateException("La fecha no puede ser nula");
          } */

        if (strlen($date) < 9) {
            //throw new DateException("La fecha es demasiado corta");
            return -3;
        }

        $pattern = '/^(\d{4})-(\d{2})-(\d{2})$/';

        if (preg_match($pattern, $date, $array)) {

            if (!empty($array)) {
                $month = (int) $array[2];
                $day = (int) $array[3];
                $year = (int) $array[1];

                if ($month > 12) {
                    return -4; //formato no valido  
                }

                if ($day > 28 && $month == 2 && ($year % 4 != 0 || ($year % 100 == 0 && $year % 400 != 0))) {
                    return -4;
                }
                if ($day > 31) {
                    return -4;
                }

                if ($year > 2025 or $year < 1900) {
                    return -4;
                }

                return 0;
            }
        } else {
            return -4;
        }
    }

    public static function checkISBN($isbn) {

        $pattern = '/^\d{13}$/';

        if (preg_match($pattern, $isbn)) {
            return 0;
        } else {
            return -8;
        }
    }

    public static function checkDNI($dni) {

        $pattern = '/^\d{8}[A-Z]{1}$/';

        if (preg_match($pattern, $dni)) {
            return 0;
        } else {
            return -9;
        }
    }

    public static function checkEmail($email) {
        $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";
        /*
          Los caracteres permitidos antes del símbolo @ son letras minúsculas y mayúsculas (a-z, A-Z), números (0-9), punto (.), guión bajo (_) y guión (-).
         * Debe haber al menos uno de estos caracteres.
          Símbolo @: Debe haber exactamente un símbolo @.
          Caracteres permitidos después de @: Después del símbolo @, los caracteres permitidos son letras minúsculas y mayúsculas (a-z, A-Z), números (0-9), punto (.) y guión (-).
         * Debe haber al menos uno de estos caracteres.
          Punto y dominio: Después de los caracteres permitidos, debe haber un punto (.) seguido de entre 2 y 6 letras (a-z, A-Z). Esto representa el dominio, como .com, .net, .org, etc.
          OLE MIS COJONES
         */
        if (preg_match($pattern, $email)) {
            return 0;
        } else {
            return -10;
        }
    }

    public static function checkIdemployee(string $idemployee): int {



        if (strlen($idemployee) > 9) {
            //throw new DateException("La fecha es demasiado corta");
            return -3;
        }

        $pattern = '/^[A-Za-z]{3}_[0-9]{4}/';

        if (!preg_match($pattern, $idemployee)) {
            return -11;
            
        } else {
            return 0;
        }
    }

    
    public static function checkSoftwareVersion(string $id): int {



        if (strlen($id) > 12) {
            //throw new DateException("La fecha es demasiado corta");
            return -3;
        }

        $pattern = '/^V.[0-9]{3}_[0-9]{5}/';

        if (!preg_match($pattern, $id)) {
            return -11;
            
        } else {
            return 0;
        }
    }
    
    

public static function setReleasetDate(string $releaseDate): int {
        $array = [];
        /*
          if (self::isNull($date)) {
          throw new DateException("La fecha no puede ser nula");
          } */

        if (strlen($releaseDate) < 9) {
            //throw new DateException("La fecha es demasiado corta");
            return -3;
        }

        $pattern = '/^(\d{2})-(\d{2})-(\d{4})$/';

        if (preg_match($pattern, $releaseDate, $array)) {

            if (!empty($array)) {
                $month = (int) $array[1];
                $day = (int) $array[2];
                $year = (int) $array[3];
                
                
                
                if ($month > 12) {
                    return -4; //formato no valido  
                }

                if ($day > 28 && $month == 2 && ($year % 4 != 0 || ($year % 100 == 0 && $year % 400 != 0))) {
                    return -4;
                }
                if ($day > 31) {
                    return -4;
                }

                if ($year > 2025 or $year < 1900) {
                    return -4;
                }

                return 0;
            }
        } else {
            return -4;
        }
    }
    
}