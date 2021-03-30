<?php

//there is no lang yet
if (!function_exists('lang')) {
    function lang() {
        $lang = session()->has('lang') ? session('lang') : session()->put('lang', 'en');
        return $lang;
    }
}//end of lang

if (!function_exists('direction')) {
    function direction() {
        $direction = session()->has('lang') ? (session('lang') == 'ar' ? 'rtl' : 'ltr') : 'ltr';
        return $direction;

    }
}

if (!function_exists('datatableLang')) {
    function datatableLang() {
        return [
            'sProcessing'     => trans('admin.sProcessing'),
            'sLengthMenu'     => trans('admin.sLengthMenu'),
            'sZeroRecords'    => trans('admin.sZeroRecords'),
            'sEmptyTable'     => trans('admin.sEmptyTable'),
            'sInfo'           => trans('admin.sInfo'),
            'sInfoEmpty'      => trans('admin.sInfoEmpty'),
            'sInfoFiltered'   => trans('admin.sInfoFiltered'),
            'sInfoPostFix'    => trans('admin.sInfoPostFix'),
            'sSearch'         => trans('admin.sSearch'),
            'sUrl'            => trans('admin.sUrl'),
            'sInfoThousands'  => trans('admin.sInfoThousands'),
            'sLoadingRecords' => trans('admin.sLoadingRecords'),
            'oPaginate'       => [
                'sFirst'         => trans('admin.sFirst'),
                'sLast'          => trans('admin.sLast'),
                'sNext'          => trans('admin.sNext'),
                'sPrevious'      => trans('admin.sPrevious'),
            ],
            'oAria'            => [
                'sSortAscending'  => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],

        ];
    }
}

if (!function_exists('get_countries')) {

    function get_countries() {

        $contries_info = countries();

        $countries = array();

        foreach($contries_info as $country){

            $countries[$country['name']] = $country['name'];

        }

        return $countries;
    }

}//end of get all countries
