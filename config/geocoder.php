<?php

return [

    /*
     * Tu API key de Google Maps para peticiones de Geocoding.
     */
    'key'      => env('GOOGLE_MAPS_GEOCODING_API_KEY', ''),

    /*
     * Idioma de la respuesta (ISO 639-1).  
     * Se usará el valor de GEOCODER_LANGUAGE en .env o 'es' por defecto.
     */
    'language' => env('GEOCODER_LANGUAGE', 'es'),

    /*
     * Región para ayudar al servicio a priorizar resultados 
     * (ISO 3166-1 Alpha-2). Por ejemplo 'CO' para Colombia.
     */
    'region'   => env('GEOCODER_REGION', 'CO'),

    /*
     * Bounds (opcional) para limitar el viewport, formato "sw_lat,sw_lng|ne_lat,ne_lng".
     * Déjalo vacío si no lo necesitas.
     */
    'bounds'   => env('GEOCODER_BOUNDS', ''),

    /*
     * Country (opcional) para limitar los resultados a uno o varios países 
     * (ISO 3166-1 Alpha-2). Ejemplo: 'CO' o 'CO|US'.
     */
    'country'  => env('GEOCODER_COUNTRY', 'CO'),

];
