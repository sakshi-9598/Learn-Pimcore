<?php

/**
 * Inheritance: yes
 * Variants: yes
 *
 * Fields Summary:
 * - CategoryName [input]
 * - Description [textarea]
 * - child [manyToOneRelation]
 */

return Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
   'dao' => NULL,
   'id' => '1',
   'name' => 'category1',
   'title' => '',
   'description' => '',
   'creationDate' => NULL,
   'modificationDate' => 1704366031,
   'userOwner' => 2,
   'userModification' => 2,
   'parentClass' => '',
   'implementsInterfaces' => '',
   'listingParentClass' => '',
   'useTraits' => '',
   'listingUseTraits' => '',
   'encryption' => false,
   'encryptedTables' => 
  array (
  ),
   'allowInherit' => true,
   'allowVariants' => true,
   'showVariants' => true,
   'layoutDefinitions' => 
  Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
     'name' => 'pimcore_root',
     'type' => NULL,
     'region' => NULL,
     'title' => NULL,
     'width' => 0,
     'height' => 0,
     'collapsible' => false,
     'collapsed' => false,
     'bodyStyle' => NULL,
     'datatype' => 'layout',
     'children' => 
    array (
      0 => 
      Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
         'name' => 'Layout',
         'type' => NULL,
         'region' => NULL,
         'title' => '',
         'width' => '',
         'height' => '',
         'collapsible' => false,
         'collapsed' => false,
         'bodyStyle' => '',
         'datatype' => 'layout',
         'children' => 
        array (
          0 => 
          Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
             'name' => 'CategoryName',
             'title' => 'Category Name',
             'tooltip' => '',
             'mandatory' => true,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'defaultValue' => NULL,
             'columnLength' => 190,
             'regex' => '',
             'regexFlags' => 
            array (
            ),
             'unique' => false,
             'showCharCount' => false,
             'width' => '',
             'defaultValueGenerator' => '',
          )),
          1 => 
          Pimcore\Model\DataObject\ClassDefinition\Data\Textarea::__set_state(array(
             'name' => 'Description',
             'title' => 'Description',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => false,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'maxLength' => NULL,
             'showCharCount' => false,
             'excludeFromSearchIndex' => false,
             'height' => '',
             'width' => '',
          )),
          2 => 
          Pimcore\Model\DataObject\ClassDefinition\Data\ManyToOneRelation::__set_state(array(
             'name' => 'child',
             'title' => 'Child',
             'tooltip' => '',
             'mandatory' => false,
             'noteditable' => false,
             'index' => false,
             'locked' => false,
             'style' => '',
             'permissions' => NULL,
             'fieldtype' => '',
             'relationType' => true,
             'invisible' => false,
             'visibleGridView' => false,
             'visibleSearch' => false,
             'blockedVarsForExport' => 
            array (
            ),
             'classes' => 
            array (
              0 => 
              array (
                'classes' => 'category1',
              ),
            ),
             'displayMode' => 'grid',
             'pathFormatterClass' => '',
             'assetInlineDownloadAllowed' => false,
             'assetUploadPath' => '',
             'allowToClearRelation' => true,
             'objectsAllowed' => true,
             'assetsAllowed' => false,
             'assetTypes' => 
            array (
            ),
             'documentsAllowed' => false,
             'documentTypes' => 
            array (
            ),
             'width' => '',
          )),
        ),
         'locked' => false,
         'blockedVarsForExport' => 
        array (
        ),
         'fieldtype' => 'panel',
         'layout' => NULL,
         'border' => false,
         'icon' => '',
         'labelWidth' => 100,
         'labelAlign' => 'left',
      )),
    ),
     'locked' => false,
     'blockedVarsForExport' => 
    array (
    ),
     'fieldtype' => 'panel',
     'layout' => NULL,
     'border' => false,
     'icon' => NULL,
     'labelWidth' => 100,
     'labelAlign' => 'left',
  )),
   'icon' => '',
   'group' => '',
   'showAppLoggerTab' => false,
   'linkGeneratorReference' => '',
   'previewGeneratorReference' => '',
   'compositeIndices' => 
  array (
  ),
   'showFieldLookup' => false,
   'propertyVisibility' => 
  array (
    'grid' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
    'search' => 
    array (
      'id' => true,
      'key' => false,
      'path' => true,
      'published' => true,
      'modificationDate' => true,
      'creationDate' => true,
    ),
  ),
   'enableGridLocking' => false,
   'deletedDataComponents' => 
  array (
    0 => 
    Pimcore\Model\DataObject\ClassDefinition\Data\Languagemultiselect::__set_state(array(
       'name' => 'inn',
       'title' => 'Inn',
       'tooltip' => '',
       'mandatory' => false,
       'noteditable' => false,
       'index' => false,
       'locked' => false,
       'style' => '',
       'permissions' => NULL,
       'fieldtype' => '',
       'relationType' => false,
       'invisible' => false,
       'visibleGridView' => false,
       'visibleSearch' => false,
       'blockedVarsForExport' => 
      array (
      ),
       'options' => 
      array (
        0 => 
        array (
          'key' => 'Afrikaans',
          'value' => 'af',
        ),
        1 => 
        array (
          'key' => 'Afrikaans (Namibia)',
          'value' => 'af_NA',
        ),
        2 => 
        array (
          'key' => 'Afrikaans (South Africa)',
          'value' => 'af_ZA',
        ),
        3 => 
        array (
          'key' => 'Aghem',
          'value' => 'agq',
        ),
        4 => 
        array (
          'key' => 'Aghem (Cameroon)',
          'value' => 'agq_CM',
        ),
        5 => 
        array (
          'key' => 'Akan',
          'value' => 'ak',
        ),
        6 => 
        array (
          'key' => 'Akan (Ghana)',
          'value' => 'ak_GH',
        ),
        7 => 
        array (
          'key' => 'Albanian',
          'value' => 'sq',
        ),
        8 => 
        array (
          'key' => 'Albanian (Albania)',
          'value' => 'sq_AL',
        ),
        9 => 
        array (
          'key' => 'Albanian (Kosovo)',
          'value' => 'sq_XK',
        ),
        10 => 
        array (
          'key' => 'Albanian (North Macedonia)',
          'value' => 'sq_MK',
        ),
        11 => 
        array (
          'key' => 'Amharic',
          'value' => 'am',
        ),
        12 => 
        array (
          'key' => 'Amharic (Ethiopia)',
          'value' => 'am_ET',
        ),
        13 => 
        array (
          'key' => 'Arabic',
          'value' => 'ar',
        ),
        14 => 
        array (
          'key' => 'Arabic (Algeria)',
          'value' => 'ar_DZ',
        ),
        15 => 
        array (
          'key' => 'Arabic (Bahrain)',
          'value' => 'ar_BH',
        ),
        16 => 
        array (
          'key' => 'Arabic (Chad)',
          'value' => 'ar_TD',
        ),
        17 => 
        array (
          'key' => 'Arabic (Comoros)',
          'value' => 'ar_KM',
        ),
        18 => 
        array (
          'key' => 'Arabic (Djibouti)',
          'value' => 'ar_DJ',
        ),
        19 => 
        array (
          'key' => 'Arabic (Egypt)',
          'value' => 'ar_EG',
        ),
        20 => 
        array (
          'key' => 'Arabic (Eritrea)',
          'value' => 'ar_ER',
        ),
        21 => 
        array (
          'key' => 'Arabic (Iraq)',
          'value' => 'ar_IQ',
        ),
        22 => 
        array (
          'key' => 'Arabic (Israel)',
          'value' => 'ar_IL',
        ),
        23 => 
        array (
          'key' => 'Arabic (Jordan)',
          'value' => 'ar_JO',
        ),
        24 => 
        array (
          'key' => 'Arabic (Kuwait)',
          'value' => 'ar_KW',
        ),
        25 => 
        array (
          'key' => 'Arabic (Lebanon)',
          'value' => 'ar_LB',
        ),
        26 => 
        array (
          'key' => 'Arabic (Libya)',
          'value' => 'ar_LY',
        ),
        27 => 
        array (
          'key' => 'Arabic (Mauritania)',
          'value' => 'ar_MR',
        ),
        28 => 
        array (
          'key' => 'Arabic (Morocco)',
          'value' => 'ar_MA',
        ),
        29 => 
        array (
          'key' => 'Arabic (Oman)',
          'value' => 'ar_OM',
        ),
        30 => 
        array (
          'key' => 'Arabic (Palestinian Territories)',
          'value' => 'ar_PS',
        ),
        31 => 
        array (
          'key' => 'Arabic (Qatar)',
          'value' => 'ar_QA',
        ),
        32 => 
        array (
          'key' => 'Arabic (Saudi Arabia)',
          'value' => 'ar_SA',
        ),
        33 => 
        array (
          'key' => 'Arabic (Somalia)',
          'value' => 'ar_SO',
        ),
        34 => 
        array (
          'key' => 'Arabic (South Sudan)',
          'value' => 'ar_SS',
        ),
        35 => 
        array (
          'key' => 'Arabic (Sudan)',
          'value' => 'ar_SD',
        ),
        36 => 
        array (
          'key' => 'Arabic (Syria)',
          'value' => 'ar_SY',
        ),
        37 => 
        array (
          'key' => 'Arabic (Tunisia)',
          'value' => 'ar_TN',
        ),
        38 => 
        array (
          'key' => 'Arabic (United Arab Emirates)',
          'value' => 'ar_AE',
        ),
        39 => 
        array (
          'key' => 'Arabic (Western Sahara)',
          'value' => 'ar_EH',
        ),
        40 => 
        array (
          'key' => 'Arabic (Yemen)',
          'value' => 'ar_YE',
        ),
        41 => 
        array (
          'key' => 'Arabic (world)',
          'value' => 'ar_001',
        ),
        42 => 
        array (
          'key' => 'Armenian',
          'value' => 'hy',
        ),
        43 => 
        array (
          'key' => 'Armenian (Armenia)',
          'value' => 'hy_AM',
        ),
        44 => 
        array (
          'key' => 'Assamese',
          'value' => 'as',
        ),
        45 => 
        array (
          'key' => 'Assamese (India)',
          'value' => 'as_IN',
        ),
        46 => 
        array (
          'key' => 'Asturian',
          'value' => 'ast',
        ),
        47 => 
        array (
          'key' => 'Asturian (Spain)',
          'value' => 'ast_ES',
        ),
        48 => 
        array (
          'key' => 'Asu',
          'value' => 'asa',
        ),
        49 => 
        array (
          'key' => 'Asu (Tanzania)',
          'value' => 'asa_TZ',
        ),
        50 => 
        array (
          'key' => 'Azerbaijani',
          'value' => 'az',
        ),
        51 => 
        array (
          'key' => 'Azerbaijani',
          'value' => 'az_Cyrl',
        ),
        52 => 
        array (
          'key' => 'Azerbaijani',
          'value' => 'az_Latn',
        ),
        53 => 
        array (
          'key' => 'Azerbaijani (Azerbaijan)',
          'value' => 'az_Cyrl_AZ',
        ),
        54 => 
        array (
          'key' => 'Azerbaijani (Azerbaijan)',
          'value' => 'az_Latn_AZ',
        ),
        55 => 
        array (
          'key' => 'Bafia',
          'value' => 'ksf',
        ),
        56 => 
        array (
          'key' => 'Bafia (Cameroon)',
          'value' => 'ksf_CM',
        ),
        57 => 
        array (
          'key' => 'Bambara',
          'value' => 'bm',
        ),
        58 => 
        array (
          'key' => 'Bambara (Mali)',
          'value' => 'bm_ML',
        ),
        59 => 
        array (
          'key' => 'Bangla',
          'value' => 'bn',
        ),
        60 => 
        array (
          'key' => 'Bangla (Bangladesh)',
          'value' => 'bn_BD',
        ),
        61 => 
        array (
          'key' => 'Bangla (India)',
          'value' => 'bn_IN',
        ),
        62 => 
        array (
          'key' => 'Basaa',
          'value' => 'bas',
        ),
        63 => 
        array (
          'key' => 'Basaa (Cameroon)',
          'value' => 'bas_CM',
        ),
        64 => 
        array (
          'key' => 'Basque',
          'value' => 'eu',
        ),
        65 => 
        array (
          'key' => 'Basque (Spain)',
          'value' => 'eu_ES',
        ),
        66 => 
        array (
          'key' => 'Belarusian',
          'value' => 'be',
        ),
        67 => 
        array (
          'key' => 'Belarusian (Belarus)',
          'value' => 'be_BY',
        ),
        68 => 
        array (
          'key' => 'Bemba',
          'value' => 'bem',
        ),
        69 => 
        array (
          'key' => 'Bemba (Zambia)',
          'value' => 'bem_ZM',
        ),
        70 => 
        array (
          'key' => 'Bena',
          'value' => 'bez',
        ),
        71 => 
        array (
          'key' => 'Bena (Tanzania)',
          'value' => 'bez_TZ',
        ),
        72 => 
        array (
          'key' => 'Bodo',
          'value' => 'brx',
        ),
        73 => 
        array (
          'key' => 'Bodo (India)',
          'value' => 'brx_IN',
        ),
        74 => 
        array (
          'key' => 'Bosnian',
          'value' => 'bs',
        ),
        75 => 
        array (
          'key' => 'Bosnian',
          'value' => 'bs_Cyrl',
        ),
        76 => 
        array (
          'key' => 'Bosnian',
          'value' => 'bs_Latn',
        ),
        77 => 
        array (
          'key' => 'Bosnian (Bosnia & Herzegovina)',
          'value' => 'bs_Cyrl_BA',
        ),
        78 => 
        array (
          'key' => 'Bosnian (Bosnia & Herzegovina)',
          'value' => 'bs_Latn_BA',
        ),
        79 => 
        array (
          'key' => 'Breton',
          'value' => 'br',
        ),
        80 => 
        array (
          'key' => 'Breton (France)',
          'value' => 'br_FR',
        ),
        81 => 
        array (
          'key' => 'Bulgarian',
          'value' => 'bg',
        ),
        82 => 
        array (
          'key' => 'Bulgarian (Bulgaria)',
          'value' => 'bg_BG',
        ),
        83 => 
        array (
          'key' => 'Burmese',
          'value' => 'my',
        ),
        84 => 
        array (
          'key' => 'Burmese (Myanmar (Burma))',
          'value' => 'my_MM',
        ),
        85 => 
        array (
          'key' => 'Cantonese',
          'value' => 'yue',
        ),
        86 => 
        array (
          'key' => 'Cantonese',
          'value' => 'yue_Hans',
        ),
        87 => 
        array (
          'key' => 'Cantonese',
          'value' => 'yue_Hant',
        ),
        88 => 
        array (
          'key' => 'Cantonese (China)',
          'value' => 'yue_Hans_CN',
        ),
        89 => 
        array (
          'key' => 'Cantonese (Hong Kong SAR China)',
          'value' => 'yue_Hant_HK',
        ),
        90 => 
        array (
          'key' => 'Catalan',
          'value' => 'ca',
        ),
        91 => 
        array (
          'key' => 'Catalan (Andorra)',
          'value' => 'ca_AD',
        ),
        92 => 
        array (
          'key' => 'Catalan (France)',
          'value' => 'ca_FR',
        ),
        93 => 
        array (
          'key' => 'Catalan (Italy)',
          'value' => 'ca_IT',
        ),
        94 => 
        array (
          'key' => 'Catalan (Spain)',
          'value' => 'ca_ES',
        ),
        95 => 
        array (
          'key' => 'Cebuano',
          'value' => 'ceb',
        ),
        96 => 
        array (
          'key' => 'Cebuano (Philippines)',
          'value' => 'ceb_PH',
        ),
        97 => 
        array (
          'key' => 'Central Atlas Tamazight',
          'value' => 'tzm',
        ),
        98 => 
        array (
          'key' => 'Central Atlas Tamazight (Morocco)',
          'value' => 'tzm_MA',
        ),
        99 => 
        array (
          'key' => 'Central Kurdish',
          'value' => 'ckb',
        ),
        100 => 
        array (
          'key' => 'Central Kurdish (Iran)',
          'value' => 'ckb_IR',
        ),
        101 => 
        array (
          'key' => 'Central Kurdish (Iraq)',
          'value' => 'ckb_IQ',
        ),
        102 => 
        array (
          'key' => 'Chakma',
          'value' => 'ccp',
        ),
        103 => 
        array (
          'key' => 'Chakma (Bangladesh)',
          'value' => 'ccp_BD',
        ),
        104 => 
        array (
          'key' => 'Chakma (India)',
          'value' => 'ccp_IN',
        ),
        105 => 
        array (
          'key' => 'Chechen',
          'value' => 'ce',
        ),
        106 => 
        array (
          'key' => 'Chechen (Russia)',
          'value' => 'ce_RU',
        ),
        107 => 
        array (
          'key' => 'Cherokee',
          'value' => 'chr',
        ),
        108 => 
        array (
          'key' => 'Cherokee (United States)',
          'value' => 'chr_US',
        ),
        109 => 
        array (
          'key' => 'Chiga',
          'value' => 'cgg',
        ),
        110 => 
        array (
          'key' => 'Chiga (Uganda)',
          'value' => 'cgg_UG',
        ),
        111 => 
        array (
          'key' => 'Chinese',
          'value' => 'zh',
        ),
        112 => 
        array (
          'key' => 'Chinese',
          'value' => 'zh_Hans',
        ),
        113 => 
        array (
          'key' => 'Chinese',
          'value' => 'zh_Hant',
        ),
        114 => 
        array (
          'key' => 'Chinese (China)',
          'value' => 'zh_Hans_CN',
        ),
        115 => 
        array (
          'key' => 'Chinese (Hong Kong SAR China)',
          'value' => 'zh_Hans_HK',
        ),
        116 => 
        array (
          'key' => 'Chinese (Hong Kong SAR China)',
          'value' => 'zh_Hant_HK',
        ),
        117 => 
        array (
          'key' => 'Chinese (Macao SAR China)',
          'value' => 'zh_Hans_MO',
        ),
        118 => 
        array (
          'key' => 'Chinese (Macao SAR China)',
          'value' => 'zh_Hant_MO',
        ),
        119 => 
        array (
          'key' => 'Chinese (Singapore)',
          'value' => 'zh_Hans_SG',
        ),
        120 => 
        array (
          'key' => 'Chinese (Taiwan)',
          'value' => 'zh_Hant_TW',
        ),
        121 => 
        array (
          'key' => 'Colognian',
          'value' => 'ksh',
        ),
        122 => 
        array (
          'key' => 'Colognian (Germany)',
          'value' => 'ksh_DE',
        ),
        123 => 
        array (
          'key' => 'Cornish',
          'value' => 'kw',
        ),
        124 => 
        array (
          'key' => 'Cornish (United Kingdom)',
          'value' => 'kw_GB',
        ),
        125 => 
        array (
          'key' => 'Croatian',
          'value' => 'hr',
        ),
        126 => 
        array (
          'key' => 'Croatian (Bosnia & Herzegovina)',
          'value' => 'hr_BA',
        ),
        127 => 
        array (
          'key' => 'Croatian (Croatia)',
          'value' => 'hr_HR',
        ),
        128 => 
        array (
          'key' => 'Czech',
          'value' => 'cs',
        ),
        129 => 
        array (
          'key' => 'Czech (Czechia)',
          'value' => 'cs_CZ',
        ),
        130 => 
        array (
          'key' => 'Danish',
          'value' => 'da',
        ),
        131 => 
        array (
          'key' => 'Danish (Denmark)',
          'value' => 'da_DK',
        ),
        132 => 
        array (
          'key' => 'Danish (Greenland)',
          'value' => 'da_GL',
        ),
        133 => 
        array (
          'key' => 'Dogri',
          'value' => 'doi',
        ),
        134 => 
        array (
          'key' => 'Dogri (India)',
          'value' => 'doi_IN',
        ),
        135 => 
        array (
          'key' => 'Duala',
          'value' => 'dua',
        ),
        136 => 
        array (
          'key' => 'Duala (Cameroon)',
          'value' => 'dua_CM',
        ),
        137 => 
        array (
          'key' => 'Dutch',
          'value' => 'nl',
        ),
        138 => 
        array (
          'key' => 'Dutch (Aruba)',
          'value' => 'nl_AW',
        ),
        139 => 
        array (
          'key' => 'Dutch (Belgium)',
          'value' => 'nl_BE',
        ),
        140 => 
        array (
          'key' => 'Dutch (Caribbean Netherlands)',
          'value' => 'nl_BQ',
        ),
        141 => 
        array (
          'key' => 'Dutch (Curaçao)',
          'value' => 'nl_CW',
        ),
        142 => 
        array (
          'key' => 'Dutch (Netherlands)',
          'value' => 'nl_NL',
        ),
        143 => 
        array (
          'key' => 'Dutch (Sint Maarten)',
          'value' => 'nl_SX',
        ),
        144 => 
        array (
          'key' => 'Dutch (Suriname)',
          'value' => 'nl_SR',
        ),
        145 => 
        array (
          'key' => 'Dzongkha',
          'value' => 'dz',
        ),
        146 => 
        array (
          'key' => 'Dzongkha (Bhutan)',
          'value' => 'dz_BT',
        ),
        147 => 
        array (
          'key' => 'Embu',
          'value' => 'ebu',
        ),
        148 => 
        array (
          'key' => 'Embu (Kenya)',
          'value' => 'ebu_KE',
        ),
        149 => 
        array (
          'key' => 'English',
          'value' => 'en',
        ),
        150 => 
        array (
          'key' => 'English (American Samoa)',
          'value' => 'en_AS',
        ),
        151 => 
        array (
          'key' => 'English (Anguilla)',
          'value' => 'en_AI',
        ),
        152 => 
        array (
          'key' => 'English (Antigua & Barbuda)',
          'value' => 'en_AG',
        ),
        153 => 
        array (
          'key' => 'English (Australia)',
          'value' => 'en_AU',
        ),
        154 => 
        array (
          'key' => 'English (Austria)',
          'value' => 'en_AT',
        ),
        155 => 
        array (
          'key' => 'English (Bahamas)',
          'value' => 'en_BS',
        ),
        156 => 
        array (
          'key' => 'English (Barbados)',
          'value' => 'en_BB',
        ),
        157 => 
        array (
          'key' => 'English (Belgium)',
          'value' => 'en_BE',
        ),
        158 => 
        array (
          'key' => 'English (Belize)',
          'value' => 'en_BZ',
        ),
        159 => 
        array (
          'key' => 'English (Bermuda)',
          'value' => 'en_BM',
        ),
        160 => 
        array (
          'key' => 'English (Botswana)',
          'value' => 'en_BW',
        ),
        161 => 
        array (
          'key' => 'English (British Indian Ocean Territory)',
          'value' => 'en_IO',
        ),
        162 => 
        array (
          'key' => 'English (British Virgin Islands)',
          'value' => 'en_VG',
        ),
        163 => 
        array (
          'key' => 'English (Burundi)',
          'value' => 'en_BI',
        ),
        164 => 
        array (
          'key' => 'English (Cameroon)',
          'value' => 'en_CM',
        ),
        165 => 
        array (
          'key' => 'English (Canada)',
          'value' => 'en_CA',
        ),
        166 => 
        array (
          'key' => 'English (Cayman Islands)',
          'value' => 'en_KY',
        ),
        167 => 
        array (
          'key' => 'English (Christmas Island)',
          'value' => 'en_CX',
        ),
        168 => 
        array (
          'key' => 'English (Cocos (Keeling) Islands)',
          'value' => 'en_CC',
        ),
        169 => 
        array (
          'key' => 'English (Cook Islands)',
          'value' => 'en_CK',
        ),
        170 => 
        array (
          'key' => 'English (Cyprus)',
          'value' => 'en_CY',
        ),
        171 => 
        array (
          'key' => 'English (Denmark)',
          'value' => 'en_DK',
        ),
        172 => 
        array (
          'key' => 'English (Diego Garcia)',
          'value' => 'en_DG',
        ),
        173 => 
        array (
          'key' => 'English (Dominica)',
          'value' => 'en_DM',
        ),
        174 => 
        array (
          'key' => 'English (Eritrea)',
          'value' => 'en_ER',
        ),
        175 => 
        array (
          'key' => 'English (Eswatini)',
          'value' => 'en_SZ',
        ),
        176 => 
        array (
          'key' => 'English (Europe)',
          'value' => 'en_150',
        ),
        177 => 
        array (
          'key' => 'English (Falkland Islands)',
          'value' => 'en_FK',
        ),
        178 => 
        array (
          'key' => 'English (Fiji)',
          'value' => 'en_FJ',
        ),
        179 => 
        array (
          'key' => 'English (Finland)',
          'value' => 'en_FI',
        ),
        180 => 
        array (
          'key' => 'English (Gambia)',
          'value' => 'en_GM',
        ),
        181 => 
        array (
          'key' => 'English (Germany)',
          'value' => 'en_DE',
        ),
        182 => 
        array (
          'key' => 'English (Ghana)',
          'value' => 'en_GH',
        ),
        183 => 
        array (
          'key' => 'English (Gibraltar)',
          'value' => 'en_GI',
        ),
        184 => 
        array (
          'key' => 'English (Grenada)',
          'value' => 'en_GD',
        ),
        185 => 
        array (
          'key' => 'English (Guam)',
          'value' => 'en_GU',
        ),
        186 => 
        array (
          'key' => 'English (Guernsey)',
          'value' => 'en_GG',
        ),
        187 => 
        array (
          'key' => 'English (Guyana)',
          'value' => 'en_GY',
        ),
        188 => 
        array (
          'key' => 'English (Hong Kong SAR China)',
          'value' => 'en_HK',
        ),
        189 => 
        array (
          'key' => 'English (India)',
          'value' => 'en_IN',
        ),
        190 => 
        array (
          'key' => 'English (Ireland)',
          'value' => 'en_IE',
        ),
        191 => 
        array (
          'key' => 'English (Isle of Man)',
          'value' => 'en_IM',
        ),
        192 => 
        array (
          'key' => 'English (Israel)',
          'value' => 'en_IL',
        ),
        193 => 
        array (
          'key' => 'English (Jamaica)',
          'value' => 'en_JM',
        ),
        194 => 
        array (
          'key' => 'English (Jersey)',
          'value' => 'en_JE',
        ),
        195 => 
        array (
          'key' => 'English (Kenya)',
          'value' => 'en_KE',
        ),
        196 => 
        array (
          'key' => 'English (Kiribati)',
          'value' => 'en_KI',
        ),
        197 => 
        array (
          'key' => 'English (Lesotho)',
          'value' => 'en_LS',
        ),
        198 => 
        array (
          'key' => 'English (Liberia)',
          'value' => 'en_LR',
        ),
        199 => 
        array (
          'key' => 'English (Macao SAR China)',
          'value' => 'en_MO',
        ),
        200 => 
        array (
          'key' => 'English (Madagascar)',
          'value' => 'en_MG',
        ),
        201 => 
        array (
          'key' => 'English (Malawi)',
          'value' => 'en_MW',
        ),
        202 => 
        array (
          'key' => 'English (Malaysia)',
          'value' => 'en_MY',
        ),
        203 => 
        array (
          'key' => 'English (Malta)',
          'value' => 'en_MT',
        ),
        204 => 
        array (
          'key' => 'English (Marshall Islands)',
          'value' => 'en_MH',
        ),
        205 => 
        array (
          'key' => 'English (Mauritius)',
          'value' => 'en_MU',
        ),
        206 => 
        array (
          'key' => 'English (Micronesia)',
          'value' => 'en_FM',
        ),
        207 => 
        array (
          'key' => 'English (Montserrat)',
          'value' => 'en_MS',
        ),
        208 => 
        array (
          'key' => 'English (Namibia)',
          'value' => 'en_NA',
        ),
        209 => 
        array (
          'key' => 'English (Nauru)',
          'value' => 'en_NR',
        ),
        210 => 
        array (
          'key' => 'English (Netherlands)',
          'value' => 'en_NL',
        ),
        211 => 
        array (
          'key' => 'English (New Zealand)',
          'value' => 'en_NZ',
        ),
        212 => 
        array (
          'key' => 'English (Nigeria)',
          'value' => 'en_NG',
        ),
        213 => 
        array (
          'key' => 'English (Niue)',
          'value' => 'en_NU',
        ),
        214 => 
        array (
          'key' => 'English (Norfolk Island)',
          'value' => 'en_NF',
        ),
        215 => 
        array (
          'key' => 'English (Northern Mariana Islands)',
          'value' => 'en_MP',
        ),
        216 => 
        array (
          'key' => 'English (Pakistan)',
          'value' => 'en_PK',
        ),
        217 => 
        array (
          'key' => 'English (Palau)',
          'value' => 'en_PW',
        ),
        218 => 
        array (
          'key' => 'English (Papua New Guinea)',
          'value' => 'en_PG',
        ),
        219 => 
        array (
          'key' => 'English (Philippines)',
          'value' => 'en_PH',
        ),
        220 => 
        array (
          'key' => 'English (Pitcairn Islands)',
          'value' => 'en_PN',
        ),
        221 => 
        array (
          'key' => 'English (Puerto Rico)',
          'value' => 'en_PR',
        ),
        222 => 
        array (
          'key' => 'English (Rwanda)',
          'value' => 'en_RW',
        ),
        223 => 
        array (
          'key' => 'English (Samoa)',
          'value' => 'en_WS',
        ),
        224 => 
        array (
          'key' => 'English (Seychelles)',
          'value' => 'en_SC',
        ),
        225 => 
        array (
          'key' => 'English (Sierra Leone)',
          'value' => 'en_SL',
        ),
        226 => 
        array (
          'key' => 'English (Singapore)',
          'value' => 'en_SG',
        ),
        227 => 
        array (
          'key' => 'English (Sint Maarten)',
          'value' => 'en_SX',
        ),
        228 => 
        array (
          'key' => 'English (Slovenia)',
          'value' => 'en_SI',
        ),
        229 => 
        array (
          'key' => 'English (Solomon Islands)',
          'value' => 'en_SB',
        ),
        230 => 
        array (
          'key' => 'English (South Africa)',
          'value' => 'en_ZA',
        ),
        231 => 
        array (
          'key' => 'English (South Sudan)',
          'value' => 'en_SS',
        ),
        232 => 
        array (
          'key' => 'English (St. Helena)',
          'value' => 'en_SH',
        ),
        233 => 
        array (
          'key' => 'English (St. Kitts & Nevis)',
          'value' => 'en_KN',
        ),
        234 => 
        array (
          'key' => 'English (St. Lucia)',
          'value' => 'en_LC',
        ),
        235 => 
        array (
          'key' => 'English (St. Vincent & Grenadines)',
          'value' => 'en_VC',
        ),
        236 => 
        array (
          'key' => 'English (Sudan)',
          'value' => 'en_SD',
        ),
        237 => 
        array (
          'key' => 'English (Sweden)',
          'value' => 'en_SE',
        ),
        238 => 
        array (
          'key' => 'English (Switzerland)',
          'value' => 'en_CH',
        ),
        239 => 
        array (
          'key' => 'English (Tanzania)',
          'value' => 'en_TZ',
        ),
        240 => 
        array (
          'key' => 'English (Tokelau)',
          'value' => 'en_TK',
        ),
        241 => 
        array (
          'key' => 'English (Tonga)',
          'value' => 'en_TO',
        ),
        242 => 
        array (
          'key' => 'English (Trinidad & Tobago)',
          'value' => 'en_TT',
        ),
        243 => 
        array (
          'key' => 'English (Turks & Caicos Islands)',
          'value' => 'en_TC',
        ),
        244 => 
        array (
          'key' => 'English (Tuvalu)',
          'value' => 'en_TV',
        ),
        245 => 
        array (
          'key' => 'English (U.S. Outlying Islands)',
          'value' => 'en_UM',
        ),
        246 => 
        array (
          'key' => 'English (U.S. Virgin Islands)',
          'value' => 'en_VI',
        ),
        247 => 
        array (
          'key' => 'English (Uganda)',
          'value' => 'en_UG',
        ),
        248 => 
        array (
          'key' => 'English (United Arab Emirates)',
          'value' => 'en_AE',
        ),
        249 => 
        array (
          'key' => 'English (United Kingdom)',
          'value' => 'en_GB',
        ),
        250 => 
        array (
          'key' => 'English (United States)',
          'value' => 'en_US',
        ),
        251 => 
        array (
          'key' => 'English (United States)',
          'value' => 'en_US_POSIX',
        ),
        252 => 
        array (
          'key' => 'English (Vanuatu)',
          'value' => 'en_VU',
        ),
        253 => 
        array (
          'key' => 'English (Zambia)',
          'value' => 'en_ZM',
        ),
        254 => 
        array (
          'key' => 'English (Zimbabwe)',
          'value' => 'en_ZW',
        ),
        255 => 
        array (
          'key' => 'English (world)',
          'value' => 'en_001',
        ),
        256 => 
        array (
          'key' => 'Esperanto',
          'value' => 'eo',
        ),
        257 => 
        array (
          'key' => 'Esperanto (world)',
          'value' => 'eo_001',
        ),
        258 => 
        array (
          'key' => 'Estonian',
          'value' => 'et',
        ),
        259 => 
        array (
          'key' => 'Estonian (Estonia)',
          'value' => 'et_EE',
        ),
        260 => 
        array (
          'key' => 'Ewe',
          'value' => 'ee',
        ),
        261 => 
        array (
          'key' => 'Ewe (Ghana)',
          'value' => 'ee_GH',
        ),
        262 => 
        array (
          'key' => 'Ewe (Togo)',
          'value' => 'ee_TG',
        ),
        263 => 
        array (
          'key' => 'Ewondo',
          'value' => 'ewo',
        ),
        264 => 
        array (
          'key' => 'Ewondo (Cameroon)',
          'value' => 'ewo_CM',
        ),
        265 => 
        array (
          'key' => 'Faroese',
          'value' => 'fo',
        ),
        266 => 
        array (
          'key' => 'Faroese (Denmark)',
          'value' => 'fo_DK',
        ),
        267 => 
        array (
          'key' => 'Faroese (Faroe Islands)',
          'value' => 'fo_FO',
        ),
        268 => 
        array (
          'key' => 'Filipino',
          'value' => 'fil',
        ),
        269 => 
        array (
          'key' => 'Filipino (Philippines)',
          'value' => 'fil_PH',
        ),
        270 => 
        array (
          'key' => 'Finnish',
          'value' => 'fi',
        ),
        271 => 
        array (
          'key' => 'Finnish (Finland)',
          'value' => 'fi_FI',
        ),
        272 => 
        array (
          'key' => 'French',
          'value' => 'fr',
        ),
        273 => 
        array (
          'key' => 'French (Algeria)',
          'value' => 'fr_DZ',
        ),
        274 => 
        array (
          'key' => 'French (Belgium)',
          'value' => 'fr_BE',
        ),
        275 => 
        array (
          'key' => 'French (Benin)',
          'value' => 'fr_BJ',
        ),
        276 => 
        array (
          'key' => 'French (Burkina Faso)',
          'value' => 'fr_BF',
        ),
        277 => 
        array (
          'key' => 'French (Burundi)',
          'value' => 'fr_BI',
        ),
        278 => 
        array (
          'key' => 'French (Cameroon)',
          'value' => 'fr_CM',
        ),
        279 => 
        array (
          'key' => 'French (Canada)',
          'value' => 'fr_CA',
        ),
        280 => 
        array (
          'key' => 'French (Central African Republic)',
          'value' => 'fr_CF',
        ),
        281 => 
        array (
          'key' => 'French (Chad)',
          'value' => 'fr_TD',
        ),
        282 => 
        array (
          'key' => 'French (Comoros)',
          'value' => 'fr_KM',
        ),
        283 => 
        array (
          'key' => 'French (Congo - Brazzaville)',
          'value' => 'fr_CG',
        ),
        284 => 
        array (
          'key' => 'French (Congo - Kinshasa)',
          'value' => 'fr_CD',
        ),
        285 => 
        array (
          'key' => 'French (Côte d’Ivoire)',
          'value' => 'fr_CI',
        ),
        286 => 
        array (
          'key' => 'French (Djibouti)',
          'value' => 'fr_DJ',
        ),
        287 => 
        array (
          'key' => 'French (Equatorial Guinea)',
          'value' => 'fr_GQ',
        ),
        288 => 
        array (
          'key' => 'French (France)',
          'value' => 'fr_FR',
        ),
        289 => 
        array (
          'key' => 'French (French Guiana)',
          'value' => 'fr_GF',
        ),
        290 => 
        array (
          'key' => 'French (French Polynesia)',
          'value' => 'fr_PF',
        ),
        291 => 
        array (
          'key' => 'French (Gabon)',
          'value' => 'fr_GA',
        ),
        292 => 
        array (
          'key' => 'French (Guadeloupe)',
          'value' => 'fr_GP',
        ),
        293 => 
        array (
          'key' => 'French (Guinea)',
          'value' => 'fr_GN',
        ),
        294 => 
        array (
          'key' => 'French (Haiti)',
          'value' => 'fr_HT',
        ),
        295 => 
        array (
          'key' => 'French (Luxembourg)',
          'value' => 'fr_LU',
        ),
        296 => 
        array (
          'key' => 'French (Madagascar)',
          'value' => 'fr_MG',
        ),
        297 => 
        array (
          'key' => 'French (Mali)',
          'value' => 'fr_ML',
        ),
        298 => 
        array (
          'key' => 'French (Martinique)',
          'value' => 'fr_MQ',
        ),
        299 => 
        array (
          'key' => 'French (Mauritania)',
          'value' => 'fr_MR',
        ),
        300 => 
        array (
          'key' => 'French (Mauritius)',
          'value' => 'fr_MU',
        ),
        301 => 
        array (
          'key' => 'French (Mayotte)',
          'value' => 'fr_YT',
        ),
        302 => 
        array (
          'key' => 'French (Monaco)',
          'value' => 'fr_MC',
        ),
        303 => 
        array (
          'key' => 'French (Morocco)',
          'value' => 'fr_MA',
        ),
        304 => 
        array (
          'key' => 'French (New Caledonia)',
          'value' => 'fr_NC',
        ),
        305 => 
        array (
          'key' => 'French (Niger)',
          'value' => 'fr_NE',
        ),
        306 => 
        array (
          'key' => 'French (Rwanda)',
          'value' => 'fr_RW',
        ),
        307 => 
        array (
          'key' => 'French (Réunion)',
          'value' => 'fr_RE',
        ),
        308 => 
        array (
          'key' => 'French (Senegal)',
          'value' => 'fr_SN',
        ),
        309 => 
        array (
          'key' => 'French (Seychelles)',
          'value' => 'fr_SC',
        ),
        310 => 
        array (
          'key' => 'French (St. Barthélemy)',
          'value' => 'fr_BL',
        ),
        311 => 
        array (
          'key' => 'French (St. Martin)',
          'value' => 'fr_MF',
        ),
        312 => 
        array (
          'key' => 'French (St. Pierre & Miquelon)',
          'value' => 'fr_PM',
        ),
        313 => 
        array (
          'key' => 'French (Switzerland)',
          'value' => 'fr_CH',
        ),
        314 => 
        array (
          'key' => 'French (Syria)',
          'value' => 'fr_SY',
        ),
        315 => 
        array (
          'key' => 'French (Togo)',
          'value' => 'fr_TG',
        ),
        316 => 
        array (
          'key' => 'French (Tunisia)',
          'value' => 'fr_TN',
        ),
        317 => 
        array (
          'key' => 'French (Vanuatu)',
          'value' => 'fr_VU',
        ),
        318 => 
        array (
          'key' => 'French (Wallis & Futuna)',
          'value' => 'fr_WF',
        ),
        319 => 
        array (
          'key' => 'Friulian',
          'value' => 'fur',
        ),
        320 => 
        array (
          'key' => 'Friulian (Italy)',
          'value' => 'fur_IT',
        ),
        321 => 
        array (
          'key' => 'Fulah',
          'value' => 'ff',
        ),
        322 => 
        array (
          'key' => 'Fulah',
          'value' => 'ff_Adlm',
        ),
        323 => 
        array (
          'key' => 'Fulah',
          'value' => 'ff_Latn',
        ),
        324 => 
        array (
          'key' => 'Fulah (Burkina Faso)',
          'value' => 'ff_Adlm_BF',
        ),
        325 => 
        array (
          'key' => 'Fulah (Burkina Faso)',
          'value' => 'ff_Latn_BF',
        ),
        326 => 
        array (
          'key' => 'Fulah (Cameroon)',
          'value' => 'ff_Adlm_CM',
        ),
        327 => 
        array (
          'key' => 'Fulah (Cameroon)',
          'value' => 'ff_Latn_CM',
        ),
        328 => 
        array (
          'key' => 'Fulah (Gambia)',
          'value' => 'ff_Adlm_GM',
        ),
        329 => 
        array (
          'key' => 'Fulah (Gambia)',
          'value' => 'ff_Latn_GM',
        ),
        330 => 
        array (
          'key' => 'Fulah (Ghana)',
          'value' => 'ff_Adlm_GH',
        ),
        331 => 
        array (
          'key' => 'Fulah (Ghana)',
          'value' => 'ff_Latn_GH',
        ),
        332 => 
        array (
          'key' => 'Fulah (Guinea)',
          'value' => 'ff_Adlm_GN',
        ),
        333 => 
        array (
          'key' => 'Fulah (Guinea)',
          'value' => 'ff_Latn_GN',
        ),
        334 => 
        array (
          'key' => 'Fulah (Guinea-Bissau)',
          'value' => 'ff_Adlm_GW',
        ),
        335 => 
        array (
          'key' => 'Fulah (Guinea-Bissau)',
          'value' => 'ff_Latn_GW',
        ),
        336 => 
        array (
          'key' => 'Fulah (Liberia)',
          'value' => 'ff_Adlm_LR',
        ),
        337 => 
        array (
          'key' => 'Fulah (Liberia)',
          'value' => 'ff_Latn_LR',
        ),
        338 => 
        array (
          'key' => 'Fulah (Mauritania)',
          'value' => 'ff_Adlm_MR',
        ),
        339 => 
        array (
          'key' => 'Fulah (Mauritania)',
          'value' => 'ff_Latn_MR',
        ),
        340 => 
        array (
          'key' => 'Fulah (Niger)',
          'value' => 'ff_Adlm_NE',
        ),
        341 => 
        array (
          'key' => 'Fulah (Niger)',
          'value' => 'ff_Latn_NE',
        ),
        342 => 
        array (
          'key' => 'Fulah (Nigeria)',
          'value' => 'ff_Adlm_NG',
        ),
        343 => 
        array (
          'key' => 'Fulah (Nigeria)',
          'value' => 'ff_Latn_NG',
        ),
        344 => 
        array (
          'key' => 'Fulah (Senegal)',
          'value' => 'ff_Adlm_SN',
        ),
        345 => 
        array (
          'key' => 'Fulah (Senegal)',
          'value' => 'ff_Latn_SN',
        ),
        346 => 
        array (
          'key' => 'Fulah (Sierra Leone)',
          'value' => 'ff_Adlm_SL',
        ),
        347 => 
        array (
          'key' => 'Fulah (Sierra Leone)',
          'value' => 'ff_Latn_SL',
        ),
        348 => 
        array (
          'key' => 'Galician',
          'value' => 'gl',
        ),
        349 => 
        array (
          'key' => 'Galician (Spain)',
          'value' => 'gl_ES',
        ),
        350 => 
        array (
          'key' => 'Ganda',
          'value' => 'lg',
        ),
        351 => 
        array (
          'key' => 'Ganda (Uganda)',
          'value' => 'lg_UG',
        ),
        352 => 
        array (
          'key' => 'Georgian',
          'value' => 'ka',
        ),
        353 => 
        array (
          'key' => 'Georgian (Georgia)',
          'value' => 'ka_GE',
        ),
        354 => 
        array (
          'key' => 'German',
          'value' => 'de',
        ),
        355 => 
        array (
          'key' => 'German (Austria)',
          'value' => 'de_AT',
        ),
        356 => 
        array (
          'key' => 'German (Belgium)',
          'value' => 'de_BE',
        ),
        357 => 
        array (
          'key' => 'German (Germany)',
          'value' => 'de_DE',
        ),
        358 => 
        array (
          'key' => 'German (Italy)',
          'value' => 'de_IT',
        ),
        359 => 
        array (
          'key' => 'German (Liechtenstein)',
          'value' => 'de_LI',
        ),
        360 => 
        array (
          'key' => 'German (Luxembourg)',
          'value' => 'de_LU',
        ),
        361 => 
        array (
          'key' => 'German (Switzerland)',
          'value' => 'de_CH',
        ),
        362 => 
        array (
          'key' => 'Greek',
          'value' => 'el',
        ),
        363 => 
        array (
          'key' => 'Greek (Cyprus)',
          'value' => 'el_CY',
        ),
        364 => 
        array (
          'key' => 'Greek (Greece)',
          'value' => 'el_GR',
        ),
        365 => 
        array (
          'key' => 'Gujarati',
          'value' => 'gu',
        ),
        366 => 
        array (
          'key' => 'Gujarati (India)',
          'value' => 'gu_IN',
        ),
        367 => 
        array (
          'key' => 'Gusii',
          'value' => 'guz',
        ),
        368 => 
        array (
          'key' => 'Gusii (Kenya)',
          'value' => 'guz_KE',
        ),
        369 => 
        array (
          'key' => 'Hausa',
          'value' => 'ha',
        ),
        370 => 
        array (
          'key' => 'Hausa (Ghana)',
          'value' => 'ha_GH',
        ),
        371 => 
        array (
          'key' => 'Hausa (Niger)',
          'value' => 'ha_NE',
        ),
        372 => 
        array (
          'key' => 'Hausa (Nigeria)',
          'value' => 'ha_NG',
        ),
        373 => 
        array (
          'key' => 'Hawaiian',
          'value' => 'haw',
        ),
        374 => 
        array (
          'key' => 'Hawaiian (United States)',
          'value' => 'haw_US',
        ),
        375 => 
        array (
          'key' => 'Hebrew',
          'value' => 'he',
        ),
        376 => 
        array (
          'key' => 'Hebrew (Israel)',
          'value' => 'he_IL',
        ),
        377 => 
        array (
          'key' => 'Hindi',
          'value' => 'hi',
        ),
        378 => 
        array (
          'key' => 'Hindi (India)',
          'value' => 'hi_IN',
        ),
        379 => 
        array (
          'key' => 'Hungarian',
          'value' => 'hu',
        ),
        380 => 
        array (
          'key' => 'Hungarian (Hungary)',
          'value' => 'hu_HU',
        ),
        381 => 
        array (
          'key' => 'Icelandic',
          'value' => 'is',
        ),
        382 => 
        array (
          'key' => 'Icelandic (Iceland)',
          'value' => 'is_IS',
        ),
        383 => 
        array (
          'key' => 'Igbo',
          'value' => 'ig',
        ),
        384 => 
        array (
          'key' => 'Igbo (Nigeria)',
          'value' => 'ig_NG',
        ),
        385 => 
        array (
          'key' => 'Inari Sami',
          'value' => 'smn',
        ),
        386 => 
        array (
          'key' => 'Inari Sami (Finland)',
          'value' => 'smn_FI',
        ),
        387 => 
        array (
          'key' => 'Indonesian',
          'value' => 'id',
        ),
        388 => 
        array (
          'key' => 'Indonesian (Indonesia)',
          'value' => 'id_ID',
        ),
        389 => 
        array (
          'key' => 'Interlingua',
          'value' => 'ia',
        ),
        390 => 
        array (
          'key' => 'Interlingua (world)',
          'value' => 'ia_001',
        ),
        391 => 
        array (
          'key' => 'Irish',
          'value' => 'ga',
        ),
        392 => 
        array (
          'key' => 'Irish (Ireland)',
          'value' => 'ga_IE',
        ),
        393 => 
        array (
          'key' => 'Irish (United Kingdom)',
          'value' => 'ga_GB',
        ),
        394 => 
        array (
          'key' => 'Italian',
          'value' => 'it',
        ),
        395 => 
        array (
          'key' => 'Italian (Italy)',
          'value' => 'it_IT',
        ),
        396 => 
        array (
          'key' => 'Italian (San Marino)',
          'value' => 'it_SM',
        ),
        397 => 
        array (
          'key' => 'Italian (Switzerland)',
          'value' => 'it_CH',
        ),
        398 => 
        array (
          'key' => 'Italian (Vatican City)',
          'value' => 'it_VA',
        ),
        399 => 
        array (
          'key' => 'Japanese',
          'value' => 'ja',
        ),
        400 => 
        array (
          'key' => 'Japanese (Japan)',
          'value' => 'ja_JP',
        ),
        401 => 
        array (
          'key' => 'Javanese',
          'value' => 'jv',
        ),
        402 => 
        array (
          'key' => 'Javanese (Indonesia)',
          'value' => 'jv_ID',
        ),
        403 => 
        array (
          'key' => 'Jola-Fonyi',
          'value' => 'dyo',
        ),
        404 => 
        array (
          'key' => 'Jola-Fonyi (Senegal)',
          'value' => 'dyo_SN',
        ),
        405 => 
        array (
          'key' => 'Kabuverdianu',
          'value' => 'kea',
        ),
        406 => 
        array (
          'key' => 'Kabuverdianu (Cape Verde)',
          'value' => 'kea_CV',
        ),
        407 => 
        array (
          'key' => 'Kabyle',
          'value' => 'kab',
        ),
        408 => 
        array (
          'key' => 'Kabyle (Algeria)',
          'value' => 'kab_DZ',
        ),
        409 => 
        array (
          'key' => 'Kako',
          'value' => 'kkj',
        ),
        410 => 
        array (
          'key' => 'Kako (Cameroon)',
          'value' => 'kkj_CM',
        ),
        411 => 
        array (
          'key' => 'Kalaallisut',
          'value' => 'kl',
        ),
        412 => 
        array (
          'key' => 'Kalaallisut (Greenland)',
          'value' => 'kl_GL',
        ),
        413 => 
        array (
          'key' => 'Kalenjin',
          'value' => 'kln',
        ),
        414 => 
        array (
          'key' => 'Kalenjin (Kenya)',
          'value' => 'kln_KE',
        ),
        415 => 
        array (
          'key' => 'Kamba',
          'value' => 'kam',
        ),
        416 => 
        array (
          'key' => 'Kamba (Kenya)',
          'value' => 'kam_KE',
        ),
        417 => 
        array (
          'key' => 'Kannada',
          'value' => 'kn',
        ),
        418 => 
        array (
          'key' => 'Kannada (India)',
          'value' => 'kn_IN',
        ),
        419 => 
        array (
          'key' => 'Kashmiri',
          'value' => 'ks',
        ),
        420 => 
        array (
          'key' => 'Kashmiri',
          'value' => 'ks_Arab',
        ),
        421 => 
        array (
          'key' => 'Kashmiri (India)',
          'value' => 'ks_Arab_IN',
        ),
        422 => 
        array (
          'key' => 'Kazakh',
          'value' => 'kk',
        ),
        423 => 
        array (
          'key' => 'Kazakh (Kazakhstan)',
          'value' => 'kk_KZ',
        ),
        424 => 
        array (
          'key' => 'Khmer',
          'value' => 'km',
        ),
        425 => 
        array (
          'key' => 'Khmer (Cambodia)',
          'value' => 'km_KH',
        ),
        426 => 
        array (
          'key' => 'Kikuyu',
          'value' => 'ki',
        ),
        427 => 
        array (
          'key' => 'Kikuyu (Kenya)',
          'value' => 'ki_KE',
        ),
        428 => 
        array (
          'key' => 'Kinyarwanda',
          'value' => 'rw',
        ),
        429 => 
        array (
          'key' => 'Kinyarwanda (Rwanda)',
          'value' => 'rw_RW',
        ),
        430 => 
        array (
          'key' => 'Konkani',
          'value' => 'kok',
        ),
        431 => 
        array (
          'key' => 'Konkani (India)',
          'value' => 'kok_IN',
        ),
        432 => 
        array (
          'key' => 'Korean',
          'value' => 'ko',
        ),
        433 => 
        array (
          'key' => 'Korean (North Korea)',
          'value' => 'ko_KP',
        ),
        434 => 
        array (
          'key' => 'Korean (South Korea)',
          'value' => 'ko_KR',
        ),
        435 => 
        array (
          'key' => 'Koyra Chiini',
          'value' => 'khq',
        ),
        436 => 
        array (
          'key' => 'Koyra Chiini (Mali)',
          'value' => 'khq_ML',
        ),
        437 => 
        array (
          'key' => 'Koyraboro Senni',
          'value' => 'ses',
        ),
        438 => 
        array (
          'key' => 'Koyraboro Senni (Mali)',
          'value' => 'ses_ML',
        ),
        439 => 
        array (
          'key' => 'Kurdish',
          'value' => 'ku',
        ),
        440 => 
        array (
          'key' => 'Kurdish (Turkey)',
          'value' => 'ku_TR',
        ),
        441 => 
        array (
          'key' => 'Kwasio',
          'value' => 'nmg',
        ),
        442 => 
        array (
          'key' => 'Kwasio (Cameroon)',
          'value' => 'nmg_CM',
        ),
        443 => 
        array (
          'key' => 'Kyrgyz',
          'value' => 'ky',
        ),
        444 => 
        array (
          'key' => 'Kyrgyz (Kyrgyzstan)',
          'value' => 'ky_KG',
        ),
        445 => 
        array (
          'key' => 'Lakota',
          'value' => 'lkt',
        ),
        446 => 
        array (
          'key' => 'Lakota (United States)',
          'value' => 'lkt_US',
        ),
        447 => 
        array (
          'key' => 'Langi',
          'value' => 'lag',
        ),
        448 => 
        array (
          'key' => 'Langi (Tanzania)',
          'value' => 'lag_TZ',
        ),
        449 => 
        array (
          'key' => 'Lao',
          'value' => 'lo',
        ),
        450 => 
        array (
          'key' => 'Lao (Laos)',
          'value' => 'lo_LA',
        ),
        451 => 
        array (
          'key' => 'Latvian',
          'value' => 'lv',
        ),
        452 => 
        array (
          'key' => 'Latvian (Latvia)',
          'value' => 'lv_LV',
        ),
        453 => 
        array (
          'key' => 'Lingala',
          'value' => 'ln',
        ),
        454 => 
        array (
          'key' => 'Lingala (Angola)',
          'value' => 'ln_AO',
        ),
        455 => 
        array (
          'key' => 'Lingala (Central African Republic)',
          'value' => 'ln_CF',
        ),
        456 => 
        array (
          'key' => 'Lingala (Congo - Brazzaville)',
          'value' => 'ln_CG',
        ),
        457 => 
        array (
          'key' => 'Lingala (Congo - Kinshasa)',
          'value' => 'ln_CD',
        ),
        458 => 
        array (
          'key' => 'Lithuanian',
          'value' => 'lt',
        ),
        459 => 
        array (
          'key' => 'Lithuanian (Lithuania)',
          'value' => 'lt_LT',
        ),
        460 => 
        array (
          'key' => 'Lower Sorbian',
          'value' => 'dsb',
        ),
        461 => 
        array (
          'key' => 'Lower Sorbian (Germany)',
          'value' => 'dsb_DE',
        ),
        462 => 
        array (
          'key' => 'Luba-Katanga',
          'value' => 'lu',
        ),
        463 => 
        array (
          'key' => 'Luba-Katanga (Congo - Kinshasa)',
          'value' => 'lu_CD',
        ),
        464 => 
        array (
          'key' => 'Luo',
          'value' => 'luo',
        ),
        465 => 
        array (
          'key' => 'Luo (Kenya)',
          'value' => 'luo_KE',
        ),
        466 => 
        array (
          'key' => 'Luxembourgish',
          'value' => 'lb',
        ),
        467 => 
        array (
          'key' => 'Luxembourgish (Luxembourg)',
          'value' => 'lb_LU',
        ),
        468 => 
        array (
          'key' => 'Luyia',
          'value' => 'luy',
        ),
        469 => 
        array (
          'key' => 'Luyia (Kenya)',
          'value' => 'luy_KE',
        ),
        470 => 
        array (
          'key' => 'Macedonian',
          'value' => 'mk',
        ),
        471 => 
        array (
          'key' => 'Macedonian (North Macedonia)',
          'value' => 'mk_MK',
        ),
        472 => 
        array (
          'key' => 'Machame',
          'value' => 'jmc',
        ),
        473 => 
        array (
          'key' => 'Machame (Tanzania)',
          'value' => 'jmc_TZ',
        ),
        474 => 
        array (
          'key' => 'Maithili',
          'value' => 'mai',
        ),
        475 => 
        array (
          'key' => 'Maithili (India)',
          'value' => 'mai_IN',
        ),
        476 => 
        array (
          'key' => 'Makhuwa-Meetto',
          'value' => 'mgh',
        ),
        477 => 
        array (
          'key' => 'Makhuwa-Meetto (Mozambique)',
          'value' => 'mgh_MZ',
        ),
        478 => 
        array (
          'key' => 'Makonde',
          'value' => 'kde',
        ),
        479 => 
        array (
          'key' => 'Makonde (Tanzania)',
          'value' => 'kde_TZ',
        ),
        480 => 
        array (
          'key' => 'Malagasy',
          'value' => 'mg',
        ),
        481 => 
        array (
          'key' => 'Malagasy (Madagascar)',
          'value' => 'mg_MG',
        ),
        482 => 
        array (
          'key' => 'Malay',
          'value' => 'ms',
        ),
        483 => 
        array (
          'key' => 'Malay (Brunei)',
          'value' => 'ms_BN',
        ),
        484 => 
        array (
          'key' => 'Malay (Indonesia)',
          'value' => 'ms_ID',
        ),
        485 => 
        array (
          'key' => 'Malay (Malaysia)',
          'value' => 'ms_MY',
        ),
        486 => 
        array (
          'key' => 'Malay (Singapore)',
          'value' => 'ms_SG',
        ),
        487 => 
        array (
          'key' => 'Malayalam',
          'value' => 'ml',
        ),
        488 => 
        array (
          'key' => 'Malayalam (India)',
          'value' => 'ml_IN',
        ),
        489 => 
        array (
          'key' => 'Maltese',
          'value' => 'mt',
        ),
        490 => 
        array (
          'key' => 'Maltese (Malta)',
          'value' => 'mt_MT',
        ),
        491 => 
        array (
          'key' => 'Manipuri',
          'value' => 'mni',
        ),
        492 => 
        array (
          'key' => 'Manipuri',
          'value' => 'mni_Beng',
        ),
        493 => 
        array (
          'key' => 'Manipuri (India)',
          'value' => 'mni_Beng_IN',
        ),
        494 => 
        array (
          'key' => 'Manx',
          'value' => 'gv',
        ),
        495 => 
        array (
          'key' => 'Manx (Isle of Man)',
          'value' => 'gv_IM',
        ),
        496 => 
        array (
          'key' => 'Marathi',
          'value' => 'mr',
        ),
        497 => 
        array (
          'key' => 'Marathi (India)',
          'value' => 'mr_IN',
        ),
        498 => 
        array (
          'key' => 'Masai',
          'value' => 'mas',
        ),
        499 => 
        array (
          'key' => 'Masai (Kenya)',
          'value' => 'mas_KE',
        ),
        500 => 
        array (
          'key' => 'Masai (Tanzania)',
          'value' => 'mas_TZ',
        ),
        501 => 
        array (
          'key' => 'Mazanderani',
          'value' => 'mzn',
        ),
        502 => 
        array (
          'key' => 'Mazanderani (Iran)',
          'value' => 'mzn_IR',
        ),
        503 => 
        array (
          'key' => 'Meru',
          'value' => 'mer',
        ),
        504 => 
        array (
          'key' => 'Meru (Kenya)',
          'value' => 'mer_KE',
        ),
        505 => 
        array (
          'key' => 'Metaʼ',
          'value' => 'mgo',
        ),
        506 => 
        array (
          'key' => 'Metaʼ (Cameroon)',
          'value' => 'mgo_CM',
        ),
        507 => 
        array (
          'key' => 'Mongolian',
          'value' => 'mn',
        ),
        508 => 
        array (
          'key' => 'Mongolian (Mongolia)',
          'value' => 'mn_MN',
        ),
        509 => 
        array (
          'key' => 'Morisyen',
          'value' => 'mfe',
        ),
        510 => 
        array (
          'key' => 'Morisyen (Mauritius)',
          'value' => 'mfe_MU',
        ),
        511 => 
        array (
          'key' => 'Mundang',
          'value' => 'mua',
        ),
        512 => 
        array (
          'key' => 'Mundang (Cameroon)',
          'value' => 'mua_CM',
        ),
        513 => 
        array (
          'key' => 'Māori',
          'value' => 'mi',
        ),
        514 => 
        array (
          'key' => 'Māori (New Zealand)',
          'value' => 'mi_NZ',
        ),
        515 => 
        array (
          'key' => 'Nama',
          'value' => 'naq',
        ),
        516 => 
        array (
          'key' => 'Nama (Namibia)',
          'value' => 'naq_NA',
        ),
        517 => 
        array (
          'key' => 'Nepali',
          'value' => 'ne',
        ),
        518 => 
        array (
          'key' => 'Nepali (India)',
          'value' => 'ne_IN',
        ),
        519 => 
        array (
          'key' => 'Nepali (Nepal)',
          'value' => 'ne_NP',
        ),
        520 => 
        array (
          'key' => 'Ngiemboon',
          'value' => 'nnh',
        ),
        521 => 
        array (
          'key' => 'Ngiemboon (Cameroon)',
          'value' => 'nnh_CM',
        ),
        522 => 
        array (
          'key' => 'Ngomba',
          'value' => 'jgo',
        ),
        523 => 
        array (
          'key' => 'Ngomba (Cameroon)',
          'value' => 'jgo_CM',
        ),
        524 => 
        array (
          'key' => 'Nigerian Pidgin',
          'value' => 'pcm',
        ),
        525 => 
        array (
          'key' => 'Nigerian Pidgin (Nigeria)',
          'value' => 'pcm_NG',
        ),
        526 => 
        array (
          'key' => 'North Ndebele',
          'value' => 'nd',
        ),
        527 => 
        array (
          'key' => 'North Ndebele (Zimbabwe)',
          'value' => 'nd_ZW',
        ),
        528 => 
        array (
          'key' => 'Northern Luri',
          'value' => 'lrc',
        ),
        529 => 
        array (
          'key' => 'Northern Luri (Iran)',
          'value' => 'lrc_IR',
        ),
        530 => 
        array (
          'key' => 'Northern Luri (Iraq)',
          'value' => 'lrc_IQ',
        ),
        531 => 
        array (
          'key' => 'Northern Sami',
          'value' => 'se',
        ),
        532 => 
        array (
          'key' => 'Northern Sami (Finland)',
          'value' => 'se_FI',
        ),
        533 => 
        array (
          'key' => 'Northern Sami (Norway)',
          'value' => 'se_NO',
        ),
        534 => 
        array (
          'key' => 'Northern Sami (Sweden)',
          'value' => 'se_SE',
        ),
        535 => 
        array (
          'key' => 'Norwegian',
          'value' => 'no',
        ),
        536 => 
        array (
          'key' => 'Norwegian Bokmål',
          'value' => 'nb',
        ),
        537 => 
        array (
          'key' => 'Norwegian Bokmål (Norway)',
          'value' => 'nb_NO',
        ),
        538 => 
        array (
          'key' => 'Norwegian Bokmål (Svalbard & Jan Mayen)',
          'value' => 'nb_SJ',
        ),
        539 => 
        array (
          'key' => 'Norwegian Nynorsk',
          'value' => 'nn',
        ),
        540 => 
        array (
          'key' => 'Norwegian Nynorsk (Norway)',
          'value' => 'nn_NO',
        ),
        541 => 
        array (
          'key' => 'Nuer',
          'value' => 'nus',
        ),
        542 => 
        array (
          'key' => 'Nuer (South Sudan)',
          'value' => 'nus_SS',
        ),
        543 => 
        array (
          'key' => 'Nyankole',
          'value' => 'nyn',
        ),
        544 => 
        array (
          'key' => 'Nyankole (Uganda)',
          'value' => 'nyn_UG',
        ),
        545 => 
        array (
          'key' => 'Odia',
          'value' => 'or',
        ),
        546 => 
        array (
          'key' => 'Odia (India)',
          'value' => 'or_IN',
        ),
        547 => 
        array (
          'key' => 'Oromo',
          'value' => 'om',
        ),
        548 => 
        array (
          'key' => 'Oromo (Ethiopia)',
          'value' => 'om_ET',
        ),
        549 => 
        array (
          'key' => 'Oromo (Kenya)',
          'value' => 'om_KE',
        ),
        550 => 
        array (
          'key' => 'Ossetic',
          'value' => 'os',
        ),
        551 => 
        array (
          'key' => 'Ossetic (Georgia)',
          'value' => 'os_GE',
        ),
        552 => 
        array (
          'key' => 'Ossetic (Russia)',
          'value' => 'os_RU',
        ),
        553 => 
        array (
          'key' => 'Pashto',
          'value' => 'ps',
        ),
        554 => 
        array (
          'key' => 'Pashto (Afghanistan)',
          'value' => 'ps_AF',
        ),
        555 => 
        array (
          'key' => 'Pashto (Pakistan)',
          'value' => 'ps_PK',
        ),
        556 => 
        array (
          'key' => 'Persian',
          'value' => 'fa',
        ),
        557 => 
        array (
          'key' => 'Persian (Afghanistan)',
          'value' => 'fa_AF',
        ),
        558 => 
        array (
          'key' => 'Persian (Iran)',
          'value' => 'fa_IR',
        ),
        559 => 
        array (
          'key' => 'Polish',
          'value' => 'pl',
        ),
        560 => 
        array (
          'key' => 'Polish (Poland)',
          'value' => 'pl_PL',
        ),
        561 => 
        array (
          'key' => 'Portuguese',
          'value' => 'pt',
        ),
        562 => 
        array (
          'key' => 'Portuguese (Angola)',
          'value' => 'pt_AO',
        ),
        563 => 
        array (
          'key' => 'Portuguese (Brazil)',
          'value' => 'pt_BR',
        ),
        564 => 
        array (
          'key' => 'Portuguese (Cape Verde)',
          'value' => 'pt_CV',
        ),
        565 => 
        array (
          'key' => 'Portuguese (Equatorial Guinea)',
          'value' => 'pt_GQ',
        ),
        566 => 
        array (
          'key' => 'Portuguese (Guinea-Bissau)',
          'value' => 'pt_GW',
        ),
        567 => 
        array (
          'key' => 'Portuguese (Luxembourg)',
          'value' => 'pt_LU',
        ),
        568 => 
        array (
          'key' => 'Portuguese (Macao SAR China)',
          'value' => 'pt_MO',
        ),
        569 => 
        array (
          'key' => 'Portuguese (Mozambique)',
          'value' => 'pt_MZ',
        ),
        570 => 
        array (
          'key' => 'Portuguese (Portugal)',
          'value' => 'pt_PT',
        ),
        571 => 
        array (
          'key' => 'Portuguese (Switzerland)',
          'value' => 'pt_CH',
        ),
        572 => 
        array (
          'key' => 'Portuguese (São Tomé & Príncipe)',
          'value' => 'pt_ST',
        ),
        573 => 
        array (
          'key' => 'Portuguese (Timor-Leste)',
          'value' => 'pt_TL',
        ),
        574 => 
        array (
          'key' => 'Punjabi',
          'value' => 'pa',
        ),
        575 => 
        array (
          'key' => 'Punjabi',
          'value' => 'pa_Arab',
        ),
        576 => 
        array (
          'key' => 'Punjabi',
          'value' => 'pa_Guru',
        ),
        577 => 
        array (
          'key' => 'Punjabi (India)',
          'value' => 'pa_Guru_IN',
        ),
        578 => 
        array (
          'key' => 'Punjabi (Pakistan)',
          'value' => 'pa_Arab_PK',
        ),
        579 => 
        array (
          'key' => 'Quechua',
          'value' => 'qu',
        ),
        580 => 
        array (
          'key' => 'Quechua (Bolivia)',
          'value' => 'qu_BO',
        ),
        581 => 
        array (
          'key' => 'Quechua (Ecuador)',
          'value' => 'qu_EC',
        ),
        582 => 
        array (
          'key' => 'Quechua (Peru)',
          'value' => 'qu_PE',
        ),
        583 => 
        array (
          'key' => 'Romanian',
          'value' => 'ro',
        ),
        584 => 
        array (
          'key' => 'Romanian (Moldova)',
          'value' => 'ro_MD',
        ),
        585 => 
        array (
          'key' => 'Romanian (Romania)',
          'value' => 'ro_RO',
        ),
        586 => 
        array (
          'key' => 'Romansh',
          'value' => 'rm',
        ),
        587 => 
        array (
          'key' => 'Romansh (Switzerland)',
          'value' => 'rm_CH',
        ),
        588 => 
        array (
          'key' => 'Rombo',
          'value' => 'rof',
        ),
        589 => 
        array (
          'key' => 'Rombo (Tanzania)',
          'value' => 'rof_TZ',
        ),
        590 => 
        array (
          'key' => 'Rundi',
          'value' => 'rn',
        ),
        591 => 
        array (
          'key' => 'Rundi (Burundi)',
          'value' => 'rn_BI',
        ),
        592 => 
        array (
          'key' => 'Russian',
          'value' => 'ru',
        ),
        593 => 
        array (
          'key' => 'Russian (Belarus)',
          'value' => 'ru_BY',
        ),
        594 => 
        array (
          'key' => 'Russian (Kazakhstan)',
          'value' => 'ru_KZ',
        ),
        595 => 
        array (
          'key' => 'Russian (Kyrgyzstan)',
          'value' => 'ru_KG',
        ),
        596 => 
        array (
          'key' => 'Russian (Moldova)',
          'value' => 'ru_MD',
        ),
        597 => 
        array (
          'key' => 'Russian (Russia)',
          'value' => 'ru_RU',
        ),
        598 => 
        array (
          'key' => 'Russian (Ukraine)',
          'value' => 'ru_UA',
        ),
        599 => 
        array (
          'key' => 'Rwa',
          'value' => 'rwk',
        ),
        600 => 
        array (
          'key' => 'Rwa (Tanzania)',
          'value' => 'rwk_TZ',
        ),
        601 => 
        array (
          'key' => 'Sakha',
          'value' => 'sah',
        ),
        602 => 
        array (
          'key' => 'Sakha (Russia)',
          'value' => 'sah_RU',
        ),
        603 => 
        array (
          'key' => 'Samburu',
          'value' => 'saq',
        ),
        604 => 
        array (
          'key' => 'Samburu (Kenya)',
          'value' => 'saq_KE',
        ),
        605 => 
        array (
          'key' => 'Sango',
          'value' => 'sg',
        ),
        606 => 
        array (
          'key' => 'Sango (Central African Republic)',
          'value' => 'sg_CF',
        ),
        607 => 
        array (
          'key' => 'Sangu',
          'value' => 'sbp',
        ),
        608 => 
        array (
          'key' => 'Sangu (Tanzania)',
          'value' => 'sbp_TZ',
        ),
        609 => 
        array (
          'key' => 'Sanskrit',
          'value' => 'sa',
        ),
        610 => 
        array (
          'key' => 'Sanskrit (India)',
          'value' => 'sa_IN',
        ),
        611 => 
        array (
          'key' => 'Santali',
          'value' => 'sat',
        ),
        612 => 
        array (
          'key' => 'Santali',
          'value' => 'sat_Olck',
        ),
        613 => 
        array (
          'key' => 'Santali (India)',
          'value' => 'sat_Olck_IN',
        ),
        614 => 
        array (
          'key' => 'Sardinian',
          'value' => 'sc',
        ),
        615 => 
        array (
          'key' => 'Sardinian (Italy)',
          'value' => 'sc_IT',
        ),
        616 => 
        array (
          'key' => 'Scottish Gaelic',
          'value' => 'gd',
        ),
        617 => 
        array (
          'key' => 'Scottish Gaelic (United Kingdom)',
          'value' => 'gd_GB',
        ),
        618 => 
        array (
          'key' => 'Sena',
          'value' => 'seh',
        ),
        619 => 
        array (
          'key' => 'Sena (Mozambique)',
          'value' => 'seh_MZ',
        ),
        620 => 
        array (
          'key' => 'Serbian',
          'value' => 'sr',
        ),
        621 => 
        array (
          'key' => 'Serbian',
          'value' => 'sr_Cyrl',
        ),
        622 => 
        array (
          'key' => 'Serbian',
          'value' => 'sr_Latn',
        ),
        623 => 
        array (
          'key' => 'Serbian (Bosnia & Herzegovina)',
          'value' => 'sr_Cyrl_BA',
        ),
        624 => 
        array (
          'key' => 'Serbian (Bosnia & Herzegovina)',
          'value' => 'sr_Latn_BA',
        ),
        625 => 
        array (
          'key' => 'Serbian (Kosovo)',
          'value' => 'sr_Cyrl_XK',
        ),
        626 => 
        array (
          'key' => 'Serbian (Kosovo)',
          'value' => 'sr_Latn_XK',
        ),
        627 => 
        array (
          'key' => 'Serbian (Montenegro)',
          'value' => 'sr_Cyrl_ME',
        ),
        628 => 
        array (
          'key' => 'Serbian (Montenegro)',
          'value' => 'sr_Latn_ME',
        ),
        629 => 
        array (
          'key' => 'Serbian (Serbia)',
          'value' => 'sr_Cyrl_RS',
        ),
        630 => 
        array (
          'key' => 'Serbian (Serbia)',
          'value' => 'sr_Latn_RS',
        ),
        631 => 
        array (
          'key' => 'Shambala',
          'value' => 'ksb',
        ),
        632 => 
        array (
          'key' => 'Shambala (Tanzania)',
          'value' => 'ksb_TZ',
        ),
        633 => 
        array (
          'key' => 'Shona',
          'value' => 'sn',
        ),
        634 => 
        array (
          'key' => 'Shona (Zimbabwe)',
          'value' => 'sn_ZW',
        ),
        635 => 
        array (
          'key' => 'Sichuan Yi',
          'value' => 'ii',
        ),
        636 => 
        array (
          'key' => 'Sichuan Yi (China)',
          'value' => 'ii_CN',
        ),
        637 => 
        array (
          'key' => 'Sindhi',
          'value' => 'sd',
        ),
        638 => 
        array (
          'key' => 'Sindhi',
          'value' => 'sd_Arab',
        ),
        639 => 
        array (
          'key' => 'Sindhi',
          'value' => 'sd_Deva',
        ),
        640 => 
        array (
          'key' => 'Sindhi (India)',
          'value' => 'sd_Deva_IN',
        ),
        641 => 
        array (
          'key' => 'Sindhi (Pakistan)',
          'value' => 'sd_Arab_PK',
        ),
        642 => 
        array (
          'key' => 'Sinhala',
          'value' => 'si',
        ),
        643 => 
        array (
          'key' => 'Sinhala (Sri Lanka)',
          'value' => 'si_LK',
        ),
        644 => 
        array (
          'key' => 'Slovak',
          'value' => 'sk',
        ),
        645 => 
        array (
          'key' => 'Slovak (Slovakia)',
          'value' => 'sk_SK',
        ),
        646 => 
        array (
          'key' => 'Slovenian',
          'value' => 'sl',
        ),
        647 => 
        array (
          'key' => 'Slovenian (Slovenia)',
          'value' => 'sl_SI',
        ),
        648 => 
        array (
          'key' => 'Soga',
          'value' => 'xog',
        ),
        649 => 
        array (
          'key' => 'Soga (Uganda)',
          'value' => 'xog_UG',
        ),
        650 => 
        array (
          'key' => 'Somali',
          'value' => 'so',
        ),
        651 => 
        array (
          'key' => 'Somali (Djibouti)',
          'value' => 'so_DJ',
        ),
        652 => 
        array (
          'key' => 'Somali (Ethiopia)',
          'value' => 'so_ET',
        ),
        653 => 
        array (
          'key' => 'Somali (Kenya)',
          'value' => 'so_KE',
        ),
        654 => 
        array (
          'key' => 'Somali (Somalia)',
          'value' => 'so_SO',
        ),
        655 => 
        array (
          'key' => 'Spanish',
          'value' => 'es',
        ),
        656 => 
        array (
          'key' => 'Spanish (Argentina)',
          'value' => 'es_AR',
        ),
        657 => 
        array (
          'key' => 'Spanish (Belize)',
          'value' => 'es_BZ',
        ),
        658 => 
        array (
          'key' => 'Spanish (Bolivia)',
          'value' => 'es_BO',
        ),
        659 => 
        array (
          'key' => 'Spanish (Brazil)',
          'value' => 'es_BR',
        ),
        660 => 
        array (
          'key' => 'Spanish (Canary Islands)',
          'value' => 'es_IC',
        ),
        661 => 
        array (
          'key' => 'Spanish (Ceuta & Melilla)',
          'value' => 'es_EA',
        ),
        662 => 
        array (
          'key' => 'Spanish (Chile)',
          'value' => 'es_CL',
        ),
        663 => 
        array (
          'key' => 'Spanish (Colombia)',
          'value' => 'es_CO',
        ),
        664 => 
        array (
          'key' => 'Spanish (Costa Rica)',
          'value' => 'es_CR',
        ),
        665 => 
        array (
          'key' => 'Spanish (Cuba)',
          'value' => 'es_CU',
        ),
        666 => 
        array (
          'key' => 'Spanish (Dominican Republic)',
          'value' => 'es_DO',
        ),
        667 => 
        array (
          'key' => 'Spanish (Ecuador)',
          'value' => 'es_EC',
        ),
        668 => 
        array (
          'key' => 'Spanish (El Salvador)',
          'value' => 'es_SV',
        ),
        669 => 
        array (
          'key' => 'Spanish (Equatorial Guinea)',
          'value' => 'es_GQ',
        ),
        670 => 
        array (
          'key' => 'Spanish (Guatemala)',
          'value' => 'es_GT',
        ),
        671 => 
        array (
          'key' => 'Spanish (Honduras)',
          'value' => 'es_HN',
        ),
        672 => 
        array (
          'key' => 'Spanish (Latin America)',
          'value' => 'es_419',
        ),
        673 => 
        array (
          'key' => 'Spanish (Mexico)',
          'value' => 'es_MX',
        ),
        674 => 
        array (
          'key' => 'Spanish (Nicaragua)',
          'value' => 'es_NI',
        ),
        675 => 
        array (
          'key' => 'Spanish (Panama)',
          'value' => 'es_PA',
        ),
        676 => 
        array (
          'key' => 'Spanish (Paraguay)',
          'value' => 'es_PY',
        ),
        677 => 
        array (
          'key' => 'Spanish (Peru)',
          'value' => 'es_PE',
        ),
        678 => 
        array (
          'key' => 'Spanish (Philippines)',
          'value' => 'es_PH',
        ),
        679 => 
        array (
          'key' => 'Spanish (Puerto Rico)',
          'value' => 'es_PR',
        ),
        680 => 
        array (
          'key' => 'Spanish (Spain)',
          'value' => 'es_ES',
        ),
        681 => 
        array (
          'key' => 'Spanish (United States)',
          'value' => 'es_US',
        ),
        682 => 
        array (
          'key' => 'Spanish (Uruguay)',
          'value' => 'es_UY',
        ),
        683 => 
        array (
          'key' => 'Spanish (Venezuela)',
          'value' => 'es_VE',
        ),
        684 => 
        array (
          'key' => 'Standard Moroccan Tamazight',
          'value' => 'zgh',
        ),
        685 => 
        array (
          'key' => 'Standard Moroccan Tamazight (Morocco)',
          'value' => 'zgh_MA',
        ),
        686 => 
        array (
          'key' => 'Sundanese',
          'value' => 'su',
        ),
        687 => 
        array (
          'key' => 'Sundanese',
          'value' => 'su_Latn',
        ),
        688 => 
        array (
          'key' => 'Sundanese (Indonesia)',
          'value' => 'su_Latn_ID',
        ),
        689 => 
        array (
          'key' => 'Swahili',
          'value' => 'sw',
        ),
        690 => 
        array (
          'key' => 'Swahili (Congo - Kinshasa)',
          'value' => 'sw_CD',
        ),
        691 => 
        array (
          'key' => 'Swahili (Kenya)',
          'value' => 'sw_KE',
        ),
        692 => 
        array (
          'key' => 'Swahili (Tanzania)',
          'value' => 'sw_TZ',
        ),
        693 => 
        array (
          'key' => 'Swahili (Uganda)',
          'value' => 'sw_UG',
        ),
        694 => 
        array (
          'key' => 'Swedish',
          'value' => 'sv',
        ),
        695 => 
        array (
          'key' => 'Swedish (Finland)',
          'value' => 'sv_FI',
        ),
        696 => 
        array (
          'key' => 'Swedish (Sweden)',
          'value' => 'sv_SE',
        ),
        697 => 
        array (
          'key' => 'Swedish (Åland Islands)',
          'value' => 'sv_AX',
        ),
        698 => 
        array (
          'key' => 'Swiss German',
          'value' => 'gsw',
        ),
        699 => 
        array (
          'key' => 'Swiss German (France)',
          'value' => 'gsw_FR',
        ),
        700 => 
        array (
          'key' => 'Swiss German (Liechtenstein)',
          'value' => 'gsw_LI',
        ),
        701 => 
        array (
          'key' => 'Swiss German (Switzerland)',
          'value' => 'gsw_CH',
        ),
        702 => 
        array (
          'key' => 'Tachelhit',
          'value' => 'shi',
        ),
        703 => 
        array (
          'key' => 'Tachelhit',
          'value' => 'shi_Latn',
        ),
        704 => 
        array (
          'key' => 'Tachelhit',
          'value' => 'shi_Tfng',
        ),
        705 => 
        array (
          'key' => 'Tachelhit (Morocco)',
          'value' => 'shi_Latn_MA',
        ),
        706 => 
        array (
          'key' => 'Tachelhit (Morocco)',
          'value' => 'shi_Tfng_MA',
        ),
        707 => 
        array (
          'key' => 'Taita',
          'value' => 'dav',
        ),
        708 => 
        array (
          'key' => 'Taita (Kenya)',
          'value' => 'dav_KE',
        ),
        709 => 
        array (
          'key' => 'Tajik',
          'value' => 'tg',
        ),
        710 => 
        array (
          'key' => 'Tajik (Tajikistan)',
          'value' => 'tg_TJ',
        ),
        711 => 
        array (
          'key' => 'Tamil',
          'value' => 'ta',
        ),
        712 => 
        array (
          'key' => 'Tamil (India)',
          'value' => 'ta_IN',
        ),
        713 => 
        array (
          'key' => 'Tamil (Malaysia)',
          'value' => 'ta_MY',
        ),
        714 => 
        array (
          'key' => 'Tamil (Singapore)',
          'value' => 'ta_SG',
        ),
        715 => 
        array (
          'key' => 'Tamil (Sri Lanka)',
          'value' => 'ta_LK',
        ),
        716 => 
        array (
          'key' => 'Tasawaq',
          'value' => 'twq',
        ),
        717 => 
        array (
          'key' => 'Tasawaq (Niger)',
          'value' => 'twq_NE',
        ),
        718 => 
        array (
          'key' => 'Tatar',
          'value' => 'tt',
        ),
        719 => 
        array (
          'key' => 'Tatar (Russia)',
          'value' => 'tt_RU',
        ),
        720 => 
        array (
          'key' => 'Telugu',
          'value' => 'te',
        ),
        721 => 
        array (
          'key' => 'Telugu (India)',
          'value' => 'te_IN',
        ),
        722 => 
        array (
          'key' => 'Teso',
          'value' => 'teo',
        ),
        723 => 
        array (
          'key' => 'Teso (Kenya)',
          'value' => 'teo_KE',
        ),
        724 => 
        array (
          'key' => 'Teso (Uganda)',
          'value' => 'teo_UG',
        ),
        725 => 
        array (
          'key' => 'Thai',
          'value' => 'th',
        ),
        726 => 
        array (
          'key' => 'Thai (Thailand)',
          'value' => 'th_TH',
        ),
        727 => 
        array (
          'key' => 'Tibetan',
          'value' => 'bo',
        ),
        728 => 
        array (
          'key' => 'Tibetan (China)',
          'value' => 'bo_CN',
        ),
        729 => 
        array (
          'key' => 'Tibetan (India)',
          'value' => 'bo_IN',
        ),
        730 => 
        array (
          'key' => 'Tigrinya',
          'value' => 'ti',
        ),
        731 => 
        array (
          'key' => 'Tigrinya (Eritrea)',
          'value' => 'ti_ER',
        ),
        732 => 
        array (
          'key' => 'Tigrinya (Ethiopia)',
          'value' => 'ti_ET',
        ),
        733 => 
        array (
          'key' => 'Tongan',
          'value' => 'to',
        ),
        734 => 
        array (
          'key' => 'Tongan (Tonga)',
          'value' => 'to_TO',
        ),
        735 => 
        array (
          'key' => 'Turkish',
          'value' => 'tr',
        ),
        736 => 
        array (
          'key' => 'Turkish (Cyprus)',
          'value' => 'tr_CY',
        ),
        737 => 
        array (
          'key' => 'Turkish (Turkey)',
          'value' => 'tr_TR',
        ),
        738 => 
        array (
          'key' => 'Turkmen',
          'value' => 'tk',
        ),
        739 => 
        array (
          'key' => 'Turkmen (Turkmenistan)',
          'value' => 'tk_TM',
        ),
        740 => 
        array (
          'key' => 'Ukrainian',
          'value' => 'uk',
        ),
        741 => 
        array (
          'key' => 'Ukrainian (Ukraine)',
          'value' => 'uk_UA',
        ),
        742 => 
        array (
          'key' => 'Upper Sorbian',
          'value' => 'hsb',
        ),
        743 => 
        array (
          'key' => 'Upper Sorbian (Germany)',
          'value' => 'hsb_DE',
        ),
        744 => 
        array (
          'key' => 'Urdu',
          'value' => 'ur',
        ),
        745 => 
        array (
          'key' => 'Urdu (India)',
          'value' => 'ur_IN',
        ),
        746 => 
        array (
          'key' => 'Urdu (Pakistan)',
          'value' => 'ur_PK',
        ),
        747 => 
        array (
          'key' => 'Uyghur',
          'value' => 'ug',
        ),
        748 => 
        array (
          'key' => 'Uyghur (China)',
          'value' => 'ug_CN',
        ),
        749 => 
        array (
          'key' => 'Uzbek',
          'value' => 'uz',
        ),
        750 => 
        array (
          'key' => 'Uzbek',
          'value' => 'uz_Arab',
        ),
        751 => 
        array (
          'key' => 'Uzbek',
          'value' => 'uz_Cyrl',
        ),
        752 => 
        array (
          'key' => 'Uzbek',
          'value' => 'uz_Latn',
        ),
        753 => 
        array (
          'key' => 'Uzbek (Afghanistan)',
          'value' => 'uz_Arab_AF',
        ),
        754 => 
        array (
          'key' => 'Uzbek (Uzbekistan)',
          'value' => 'uz_Cyrl_UZ',
        ),
        755 => 
        array (
          'key' => 'Uzbek (Uzbekistan)',
          'value' => 'uz_Latn_UZ',
        ),
        756 => 
        array (
          'key' => 'Vai',
          'value' => 'vai',
        ),
        757 => 
        array (
          'key' => 'Vai',
          'value' => 'vai_Latn',
        ),
        758 => 
        array (
          'key' => 'Vai',
          'value' => 'vai_Vaii',
        ),
        759 => 
        array (
          'key' => 'Vai (Liberia)',
          'value' => 'vai_Latn_LR',
        ),
        760 => 
        array (
          'key' => 'Vai (Liberia)',
          'value' => 'vai_Vaii_LR',
        ),
        761 => 
        array (
          'key' => 'Vietnamese',
          'value' => 'vi',
        ),
        762 => 
        array (
          'key' => 'Vietnamese (Vietnam)',
          'value' => 'vi_VN',
        ),
        763 => 
        array (
          'key' => 'Vunjo',
          'value' => 'vun',
        ),
        764 => 
        array (
          'key' => 'Vunjo (Tanzania)',
          'value' => 'vun_TZ',
        ),
        765 => 
        array (
          'key' => 'Walser',
          'value' => 'wae',
        ),
        766 => 
        array (
          'key' => 'Walser (Switzerland)',
          'value' => 'wae_CH',
        ),
        767 => 
        array (
          'key' => 'Welsh',
          'value' => 'cy',
        ),
        768 => 
        array (
          'key' => 'Welsh (United Kingdom)',
          'value' => 'cy_GB',
        ),
        769 => 
        array (
          'key' => 'Western Frisian',
          'value' => 'fy',
        ),
        770 => 
        array (
          'key' => 'Western Frisian (Netherlands)',
          'value' => 'fy_NL',
        ),
        771 => 
        array (
          'key' => 'Wolof',
          'value' => 'wo',
        ),
        772 => 
        array (
          'key' => 'Wolof (Senegal)',
          'value' => 'wo_SN',
        ),
        773 => 
        array (
          'key' => 'Xhosa',
          'value' => 'xh',
        ),
        774 => 
        array (
          'key' => 'Xhosa (South Africa)',
          'value' => 'xh_ZA',
        ),
        775 => 
        array (
          'key' => 'Yangben',
          'value' => 'yav',
        ),
        776 => 
        array (
          'key' => 'Yangben (Cameroon)',
          'value' => 'yav_CM',
        ),
        777 => 
        array (
          'key' => 'Yiddish',
          'value' => 'yi',
        ),
        778 => 
        array (
          'key' => 'Yiddish (world)',
          'value' => 'yi_001',
        ),
        779 => 
        array (
          'key' => 'Yoruba',
          'value' => 'yo',
        ),
        780 => 
        array (
          'key' => 'Yoruba (Benin)',
          'value' => 'yo_BJ',
        ),
        781 => 
        array (
          'key' => 'Yoruba (Nigeria)',
          'value' => 'yo_NG',
        ),
        782 => 
        array (
          'key' => 'Zarma',
          'value' => 'dje',
        ),
        783 => 
        array (
          'key' => 'Zarma (Niger)',
          'value' => 'dje_NE',
        ),
        784 => 
        array (
          'key' => 'Zulu',
          'value' => 'zu',
        ),
        785 => 
        array (
          'key' => 'Zulu (South Africa)',
          'value' => 'zu_ZA',
        ),
      ),
       'maxItems' => NULL,
       'renderType' => 'list',
       'dynamicOptions' => false,
       'height' => '',
       'width' => '',
       'optionsProviderType' => NULL,
       'optionsProviderClass' => NULL,
       'optionsProviderData' => NULL,
       'onlySystemLanguages' => false,
    )),
  ),
   'blockedVarsForExport' => 
  array (
  ),
   'fieldDefinitionsCache' => 
  array (
  ),
   'activeDispatchingEvents' => 
  array (
  ),
));
