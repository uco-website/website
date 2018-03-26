// ==ClosureCompiler==
// @compilation_level ADVANCED_OPTIMIZATIONS
// @output_file_name superfish.args.min.js
// @externs_url http://closure-compiler.googlecode.com/svn/trunk/contrib/externs/jquery-1.8.js
// ==/ClosureCompiler==
// http://closure-compiler.appspot.com/home

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery*/

jQuery(function ($) {
    'use strict';
    $('.js-superfish').superfish({
        'delay': 100,                                         // 0.1 second delay on mouseout
        'animation':   {'opacity': 'show', 'height': 'show'}, // fade-in and slide-down animation
        'dropShadows': false                                  // disable drop shadows
    });
});
