// ==ClosureCompiler==
// @compilation_level ADVANCED_OPTIMIZATIONS
// @output_file_name superfish.compat.min.js
// @externs_url http://closure-compiler.googlecode.com/svn/trunk/contrib/externs/jquery-1.8.js
// ==/ClosureCompiler==
// http://closure-compiler.appspot.com/home

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery*/

jQuery(function ($) {
    'use strict';
    $('a.sf-with-ul').append('<span class="sf-sub-indicator"> &raquo;</span>');
});
