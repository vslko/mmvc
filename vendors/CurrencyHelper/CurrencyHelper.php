<?php
final class CurrencyHelper {

    private static $currencies = array(
                array('currency'=>'AZN',	'code' => "031",	'name'=>'Azerbaijani manat',	'region'=>'CIS',	'country'=>"Azerbaijan"),
                array('currency'=>'AMD',	'code' => "051",	'name'=>'Armenian dram',		'region'=>'CIS',	'country'=>"Armenia"),
                array('currency'=>'MDL',	'code' => "498",	'name'=>'Moldavian lei',		'region'=>'CIS',	'country'=>"Moldova"),
                array('currency'=>'KZT',	'code' => "398",	'name'=>'Tenge',				'region'=>'CIS',	'country'=>"Kazakhstan"),
                array('currency'=>'KGS',	'code' => "417",	'name'=>'Som',					'region'=>'CIS',	'country'=>"Kyrgyzstan"),
                array('currency'=>'RUB',	'code' => "643",	'name'=>'Russian ruble',		'region'=>'CIS',	'country'=>"Russia"),
                array('currency'=>'TMM',	'code' => "795",	'name'=>'Matane',				'region'=>'CIS',	'country'=>"Turkmenistan"),
                array('currency'=>'TJS',	'code' => "972",	'name'=>'Somoni',				'region'=>'CIS',	'country'=>"Tajikistan"),
                array('currency'=>'UZS',	'code' => "860",	'name'=>'Uzbekistan Sum',		'region'=>'CIS',	'country'=>"Uzbekistan"),
                array('currency'=>'BYR',	'code' => "974",	'name'=>'Belarusian ruble',		'region'=>'CIS',	'country'=>"Belarus"),
                array('currency'=>'UAH',	'code' => "980",	'name'=>'Ukrainian hryvnia',	'region'=>'CIS',	'country'=>"Ukraine"),
                array('currency'=>'GEL',	'code' => "981",	'name'=>'Lari',					'region'=>'CIS',	'country'=>"Georgia"),
                array('currency'=>'ALL', 	'code' => "008",	'name'=>'Lek',					'region'=>'Europa',	'country'=>"Albania"),
                array('currency'=>'HRK', 	'code' => "191",	'name'=>'Croatian kuna',		'region'=>'Europa',	'country'=>"Croatia"),
                array('currency'=>'CZK', 	'code' => "203",	'name'=>'Czech koruna',			'region'=>'Europa',	'country'=>"Czech Republic"),
                array('currency'=>'DKK', 	'code' => "208",	'name'=>'Danish krone',			'region'=>'Europa',	'country'=>"Denmark"),
                array('currency'=>'HUF', 	'code' => "348",	'name'=>'Forint',				'region'=>'Europa',	'country'=>"Hungary"),
				array('currency'=>'ISK', 	'code' => "352",	'name'=>'Icelandic krona',		'region'=>'Europa',	'country'=>"Iceland"),
				array('currency'=>'LVL', 	'code' => "428",	'name'=>'Latvian lat',			'region'=>'Europa',	'country'=>"Latvia"),
				array('currency'=>'LTL', 	'code' => "440",	'name'=>'Lithuanian litas',		'region'=>'Europa',	'country'=>"Lithuania"),
				array('currency'=>'NOK', 	'code' => "578",	'name'=>'Norwegian krone',		'region'=>'Europa',	'country'=>"Norway"),
				array('currency'=>'RON', 	'code' => "642",	'name'=>'Lei',					'region'=>'Europa',	'country'=>"Romania"),
				array('currency'=>'SKK', 	'code' => "703",	'name'=>'Slovak koruna',		'region'=>'Europa',	'country'=>"Slovakia"),
				array('currency'=>'SEK', 	'code' => "752",	'name'=>'Swedish krona',		'region'=>'Europa',	'country'=>"Sweden"),
				array('currency'=>'CHF', 	'code' => "756",	'name'=>'Swiss franc',			'region'=>'Europa',	'country'=>"Liechtenstein"),
				array('currency'=>'TRL', 	'code' => "792",	'name'=>'Turkish lira',			'region'=>'Europa',	'country'=>"Turkey"),
				array('currency'=>'MKD', 	'code' => "807",	'name'=>'Dinar',				'region'=>'Europa',	'country'=>"Macedonia"),
				array('currency'=>'GBP', 	'code' => "826",	'name'=>'Pound',				'region'=>'Europa',	'country'=>"Great Britain"),
				array('currency'=>'RSD', 	'code' => "891",	'name'=>'Serbian dinar',		'region'=>'Europa',	'country'=>"Serbia"),
				array('currency'=>'BGN', 	'code' => "975",	'name'=>'Bulgarian lev',		'region'=>'Europa',	'country'=>"Bulgaria"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Austria"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Andorra"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Belgium"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Germany"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Greece"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Estonia"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Ireland"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Spain"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Italy"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Luxembourg"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Monaco"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Netherlands"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Portugal"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"San-Marino"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"Finland"),
				array('currency'=>'EUR', 	'code' => "978",	'name'=>'Euro',					'region'=>'Europa',	'country'=>"France"),
				array('currency'=>'PLN', 	'code' => "985",	'name'=>'Zloty',				'region'=>'Europa',	'country'=>"Poland"),
				array('currency'=>'ARS', 	'code' => "032",	'name'=>'Argentine peso',		'region'=>'America','country'=>"Argentina"),
				array('currency'=>'BOB', 	'code' => "068",	'name'=>'Boliviano',			'region'=>'America','country'=>"Bolivia"),
				array('currency'=>'CAD', 	'code' => "124",	'name'=>'Canadian dollar',		'region'=>'America','country'=>"Canada"),
				array('currency'=>'CLP', 	'code' => "152",	'name'=>'Chilean peso',			'region'=>'America','country'=>"Chile"),
				array('currency'=>'COP', 	'code' => "170",	'name'=>'Colombian peso',		'region'=>'America','country'=>"Colombia"),
				array('currency'=>'CRC', 	'code' => "188",	'name'=>'Costa Rican colon',	'region'=>'America','country'=>"Costa Rica"),
				array('currency'=>'CUP', 	'code' => "192",	'name'=>'Cuban peso',			'region'=>'America','country'=>"Cuba"),
				array('currency'=>'MXN', 	'code' => "484",	'name'=>'Mexican peso',			'region'=>'America','country'=>"Mexico"),
				array('currency'=>'NIO', 	'code' => "558",	'name'=>'Gold cordoba',			'region'=>'America','country'=>"Nicaragua"),
				array('currency'=>'PYG', 	'code' => "600",	'name'=>'Guarani',				'region'=>'America','country'=>"Paraguay"),
				array('currency'=>'PEN', 	'code' => "604",	'name'=>'New salt',				'region'=>'America','country'=>"Peru"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"USA"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Samoa"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Haiti"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Guam"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Palau"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Panama"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Puerto Rico"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"Ecuador"),
				array('currency'=>'USD', 	'code' => "840",	'name'=>'US dollar',			'region'=>'America','country'=>"El Salvador"),
				array('currency'=>'UYU', 	'code' => "858",	'name'=>'Uruguayan pesos',		'region'=>'America','country'=>"Uruguay"),
				array('currency'=>'VEB', 	'code' => "862",	'name'=>'Bolivar',				'region'=>'America','country'=>"Venezuela"),
				array('currency'=>'SRD', 	'code' => "968",	'name'=>'Suriname dollar',		'region'=>'America','country'=>"Surinam"),
				array('currency'=>'COP', 	'code' => "970",	'name'=>'Colombian peso',		'region'=>'America','country'=>"Colombia"),
				array('currency'=>'BRL', 	'code' => "986",	'name'=>'Brazilian real',		'region'=>'America','country'=>"Brazil"),
				array('currency'=>'CNY', 	'code' => "156",	'name'=>'Chinese yuan',			'region'=>'Asia',	'country'=>"China"),
				array('currency'=>'BHD', 	'code' => "048",	'name'=>'Bahraini dinar',		'region'=>'Asia',	'country'=>"Bahrain"),
				array('currency'=>'BDT', 	'code' => "050",	'name'=>'Taka',					'region'=>'Asia',	'country'=>"Bangladesh"),
				array('currency'=>'KHR', 	'code' => "116",	'name'=>'Riel',					'region'=>'Asia',	'country'=>"Cambodia"),
				array('currency'=>'LKR', 	'code' => "144",	'name'=>'Sri Lankan rupee',		'region'=>'Asia',	'country'=>"Sri Lanka"),
				array('currency'=>'HKD', 	'code' => "344",	'name'=>'Hong Kong dollar',		'region'=>'Asia',	'country'=>"Hong Kong"),
				array('currency'=>'INR', 	'code' => "356",	'name'=>'Indian rupee',			'region'=>'Asia',	'country'=>"Butane"),
				array('currency'=>'IDR', 	'code' => "360",	'name'=>'Rupee',				'region'=>'Asia',	'country'=>"Indonesia"),
				array('currency'=>'IRR', 	'code' => "364",	'name'=>'Iranian rial',			'region'=>'Asia',	'country'=>"Iran"),
				array('currency'=>'IQD', 	'code' => "368",	'name'=>'Iraqi dinar',			'region'=>'Asia',	'country'=>"Iraq"),
				array('currency'=>'ILS', 	'code' => "376",	'name'=>'Israeli shekel',		'region'=>'Asia',	'country'=>"Israel"),
				array('currency'=>'JPY', 	'code' => "392",	'name'=>'Yena',					'region'=>'Asia',	'country'=>"Japan"),
				array('currency'=>'JOD', 	'code' => "400",	'name'=>'Jordanian dinar',		'region'=>'Asia',	'country'=>"Jordan"),
				array('currency'=>'KPW', 	'code' => "408",	'name'=>'North Korean won',		'region'=>'Asia',	'country'=>"North Korea"),
				array('currency'=>'KRW', 	'code' => "410",	'name'=>'Won',					'region'=>'Asia',	'country'=>"South Korea"),
				array('currency'=>'KWD', 	'code' => "414",	'name'=>'Kuwaiti dinar',		'region'=>'Asia',	'country'=>"Kuwait"),
				array('currency'=>'LAK', 	'code' => "418",	'name'=>'Kip',					'region'=>'Asia',	'country'=>"Laos"),
				array('currency'=>'LBP', 	'code' => "422",	'name'=>'Lebanese pound',		'region'=>'Asia',	'country'=>"Lebanon"),
				array('currency'=>'LYD', 	'code' => "434",	'name'=>'Libyan dinar',			'region'=>'Asia',	'country'=>"Libya"),
				array('currency'=>'MYR', 	'code' => "458",	'name'=>'Malaysian ringgit',	'region'=>'Asia',	'country'=>"Malaysia"),
				array('currency'=>'MNT', 	'code' => "496",	'name'=>'Tugrik',				'region'=>'Asia',	'country'=>"Mongolia"),
				array('currency'=>'OMR', 	'code' => "512",	'name'=>'Omani rial',			'region'=>'Asia',	'country'=>"Oman"),
				array('currency'=>'NPR', 	'code' => "524",	'name'=>'Nepalese rupee',		'region'=>'Asia',	'country'=>"Nepal"),
				array('currency'=>'PKR', 	'code' => "586",	'name'=>'Pakistani rupee',		'region'=>'Asia',	'country'=>"Pakistan"),
				array('currency'=>'PHP', 	'code' => "608",	'name'=>'Philippine peso',		'region'=>'Asia',	'country'=>"Philippines"),
				array('currency'=>'QAR', 	'code' => "634",	'name'=>'Qatari rial',			'region'=>'Asia',	'country'=>"Qatar"),
				array('currency'=>'SAR', 	'code' => "682",	'name'=>'Saudi riyal',			'region'=>'Asia',	'country'=>"Saudi Arabia"),
				array('currency'=>'SCR',	'code' => "690",	'name'=>'Seychellois rupee',	'region'=>'Asia',	'country'=>"Seychelles"),
				array('currency'=>'SGD', 	'code' => "702",	'name'=>'Singapore dollar',		'region'=>'Asia',	'country'=>"Singapore"),
				array('currency'=>'VND', 	'code' => "704",	'name'=>'Dong',					'region'=>'Asia',	'country'=>"Vietnam"),
				array('currency'=>'SYP', 	'code' => "760",	'name'=>'Syrian pound',			'region'=>'Asia',	'country'=>"Syria"),
				array('currency'=>'THB', 	'code' => "764",	'name'=>'Bat',					'region'=>'Asia',	'country'=>"Thailand"),
				array('currency'=>'AED', 	'code' => "784",	'name'=>'Dirham',				'region'=>'Asia',	'country'=>"Arab Emirates (UAE)"),
				array('currency'=>'YER', 	'code' => "886",	'name'=>'Yemeni rial',			'region'=>'Asia',	'country'=>"Yemen"),
				array('currency'=>'TWD', 	'code' => "901",	'name'=>'Taiwan dollar',		'region'=>'Asia',	'country'=>"Taiwan"),
				array('currency'=>'AFN', 	'code' => "971",	'name'=>'Afghani',				'region'=>'Asia',	'country'=>"Afghanistan"),
				array('currency'=>'DZD', 	'code' => "012",	'name'=>'lgerian dinar',		'region'=>'Africa',	'country'=>"Algeria"),
				array('currency'=>'BWP', 	'code' => "072",	'name'=>'Poole',				'region'=>'Africa',	'country'=>"Botswana"),
				array('currency'=>'BND', 	'code' => "096",	'name'=>'Brunei dollar',		'region'=>'Africa',	'country'=>"Brunei"),
				array('currency'=>'BIF', 	'code' => "108",	'name'=>'Burundi franc',		'region'=>'Africa',	'country'=>"Burundi"),
				array('currency'=>'ETB', 	'code' => "230",	'name'=>'Ethiopian birr',		'region'=>'Africa',	'country'=>"Ethiopia"),
				array('currency'=>'GMD', 	'code' => "270",	'name'=>'Dalasi',				'region'=>'Africa',	'country'=>"Gambia"),
				array('currency'=>'GHC', 	'code' => "288",	'name'=>'Sit',					'region'=>'Africa',	'country'=>"Ghana"),
				array('currency'=>'GNF', 	'code' => "324",	'name'=>'Guinean Franc',		'region'=>'Africa',	'country'=>"Guinea"),
				array('currency'=>'KES', 	'code' => "404",	'name'=>'Kenyan shilling',		'region'=>'Africa',	'country'=>"Kenya"),
				array('currency'=>'MWK', 	'code' => "454",	'name'=>'Kwacha',				'region'=>'Africa',	'country'=>"Malawi"),
				array('currency'=>'MRO', 	'code' => "478",	'name'=>'Ugiya',				'region'=>'Africa',	'country'=>"Mauritania"),
				array('currency'=>'MAD', 	'code' => "504",	'name'=>'Moroccan dirham',		'region'=>'Africa',	'country'=>"Morocco"),
				array('currency'=>'NAD', 	'code' => "516",	'name'=>'Namibia dollar',		'region'=>'Africa',	'country'=>"Namibia"),
				array('currency'=>'NGN', 	'code' => "566",	'name'=>'Naira',				'region'=>'Africa',	'country'=>"Nigeria"),
				array('currency'=>'SLL', 	'code' => "694",	'name'=>'Leone',				'region'=>'Africa',	'country'=>"Sierra Leone"),
				array('currency'=>'SOS', 	'code' => "706",	'name'=>'Somali shilling',		'region'=>'Africa',	'country'=>"Somalia"),
				array('currency'=>'ZAR', 	'code' => "710",	'name'=>'Rand',					'region'=>'Africa',	'country'=>"South Africa"),
				array('currency'=>'ZWD', 	'code' => "716",	'name'=>'Zimbabwe dollar',		'region'=>'Africa',	'country'=>"Zimbabwe"),
				array('currency'=>'SZL', 	'code' => "748",	'name'=>'Lilangeni',			'region'=>'Africa',	'country'=>"Swaziland"),
				array('currency'=>'TND', 	'code' => "788",	'name'=>'Tunisian dinar',		'region'=>'Africa',	'country'=>"Tunisia"),
				array('currency'=>'UGX', 	'code' => "800",	'name'=>'Ugandan shilling',		'region'=>'Africa',	'country'=>"Uganda"),
				array('currency'=>'EGP', 	'code' => "818",	'name'=>'Egyptian pound',		'region'=>'Africa',	'country'=>"Egypt"),
				array('currency'=>'TZS', 	'code' => "834",	'name'=>'Tanzanian shilling',	'region'=>'Africa',	'country'=>"Tanzania"),
				array('currency'=>'ZMK', 	'code' => "894",	'name'=>'Kwacha',				'region'=>'Africa',	'country'=>"Zambia"),
				array('currency'=>'XAF', 	'code' => "950",	'name'=>'CFA franc VEAS',		'region'=>'Africa',	'country'=>"Central African Republic"),
				array('currency'=>'XOF', 	'code' => "952",	'name'=>'CFA franc VEASO',		'region'=>'Africa',	'country'=>"Guinea-Bissau"),
				array('currency'=>'MGA', 	'code' => "969",	'name'=>'Ariari',				'region'=>'Africa',	'country'=>"Madagascar"),
				array('currency'=>'AOA', 	'code' => "973",	'name'=>'Kwanzaa',				'region'=>'Africa',	'country'=>"Angola"),
				array('currency'=>'CDF',	'code' => "976",	'name'=>'Congolese franc',		'region'=>'Africa',	'country'=>"Congo"),
				array('currency'=>'AUD', 	'code' => "036",	'name'=>'Australian dollar',	'region'=>'Oceania', 'country'=>"Australia"),
				array('currency'=>'NZD', 	'code' => "554",	'name'=>'New Zealand dollar',	'region'=>'Oceania', 'country'=>"New Zealand")
    );




    public static function getByCurrency( $value ) {
        return self::_getCurrency($value, 'currency');
    }

    public static function getByCode( $value ) {
        return self::_getCurrency($value, 'code');
    }

    public static function getByName( $value ) {
        return self::_getCurrency($value, 'name');
    }

    public static function getByRegion( $value ) {
         return self::_getCurrency($value, 'region');
    }

    public static function getByCountry( $value ) {
         return self::_getCurrency($value, 'country');
    }




    private static function _getCurrency( $value, $what ) {
        $result = array();
        $value = strtolower($value);
        foreach( self::$currencies as $currency) {
       		$current = strtolower($currency[$what]);
       		if ( strpos($current,$value) !== false ) { $result[] = $currency; }
        }
        return $result;
    }


}
?>

