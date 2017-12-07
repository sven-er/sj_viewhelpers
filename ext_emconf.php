<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sj_viewhelpers".
 *
 * Auto generated 20-08-2013 09:22
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'SJ_Viewhelpers',
    'description' => 'some specific Viewhelpers',
    'category' => 'misc',
    'author' => 'Sven Jürgens',
    'author_email' => 'typo3@blue-side.de',
    'shy' => '',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'author_company' => '',
    'version' => '4.0.0',
    'constraints' => [
        'depends' => [
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' =>[
        'psr-4' => ['SvenJuergens\\SjViewhelpers\\' => 'Classes']
    ],
    '_md5_values_when_last_written' => 'a:5:{s:9:"ChangeLog";s:4:"3112";s:12:"ext_icon.gif";s:4:"1bdc";s:10:"README.txt";s:4:"ee2d";s:19:"doc/wizard_form.dat";s:4:"4001";s:20:"doc/wizard_form.html";s:4:"2d68";}',
];
