<?php

if (!function_exists('number_to_letters')) {
    function number_to_letters($numero)
    {
        $unidades = array(
            '',
            'UN',
            'DOS',
            'TRES',
            'CUATRO',
            'CINCO',
            'SEIS',
            'SIETE',
            'OCHO',
            'NUEVE'
        );

        $decenas = array(
            '',
            'DIEZ',
            'VEINTE',
            'TREINTA',
            'CUARENTA',
            'CINCUENTA',
            'SESENTA',
            'SETENTA',
            'OCHENTA',
            'NOVENTA'
        );

        $especiales = array(
            'ONCE',
            'DOCE',
            'TRECE',
            'CATORCE',
            'QUINCE',
            'DIECISEIS',
            'DIECISIETE',
            'DIECIOCHO',
            'DIECINUEVE'
        );

        $centenas = array(
            '',
            'CIENTO',
            'DOSCIENTOS',
            'TRESCIENTOS',
            'CUATROCIENTOS',
            'QUINIENTOS',
            'SEISCIENTOS',
            'SETECIENTOS',
            'OCHOCIENTOS',
            'NOVECIENTOS'
        );

        $millares = array(
            '',
            'MIL',
            'MILLÓN',
            'MILLONES'
        );

        $entero = intval($numero);
        $decimal = intval(round(($numero - $entero) * 100));

        $letras = '';

        if ($entero == 0) {
            $letras = 'CERO';
        } else {
            $letras = convertir_numero($entero, $unidades, $decenas, $especiales, $centenas, $millares);
        }

        // Formatear los decimales a dos dígitos
        $decimales_formateados = str_pad($decimal, 2, '0', STR_PAD_LEFT);

        return 'SON ' . $letras . ' CON ' . $decimales_formateados . '/100 SOLES';
    }

    function convertir_numero($numero, $unidades, $decenas, $especiales, $centenas, $millares)
    {
        $letras = '';

        if ($numero < 10) {
            $letras .= $unidades[$numero];
        } else if ($numero < 20) {
            $letras .= $especiales[$numero - 11];
        } else if ($numero < 100) {
            $letras .= $decenas[intval($numero / 10)];
            if ($numero % 10 != 0) {
                $letras .= ' Y ' . $unidades[$numero % 10];
            }
        } else if ($numero < 1000) {
            $letras .= $centenas[intval($numero / 100)];
            if ($numero % 100 != 0) {
                $letras .= ' ' . convertir_numero($numero % 100, $unidades, $decenas, $especiales, $centenas, $millares);
            }
        } else if ($numero < 1000000) {
            // Manejar el caso de "UN MIL"
            if (intval($numero / 1000) == 1) {
                $letras .= 'UN MIL';
            } else {
                $letras .= convertir_numero(intval($numero / 1000), $unidades, $decenas, $especiales, $centenas, $millares) . ' MIL';
            }
            if ($numero % 1000 != 0) {
                $letras .= ' ' . convertir_numero($numero % 1000, $unidades, $decenas, $especiales, $centenas, $millares);
            }
        } else if ($numero < 1000000000) {
            $letras .= convertir_numero(intval($numero / 1000000), $unidades, $decenas, $especiales, $centenas, $millares) . ' MILLONES';
            if ($numero % 1000000 != 0) {
                $letras .= ' ' . convertir_numero($numero % 1000000, $unidades, $decenas, $especiales, $centenas, $millares);
            }
        }

        return $letras;
    }
}
