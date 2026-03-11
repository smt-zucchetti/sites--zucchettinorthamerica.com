# ih (Salient) Child Theme

This is the ih/Salient starter theme. It utilizes GULP as a task runner to facilitate SASS and webpack

## Setup
- Adjust the params in lib/theme_info.php for the global variables.
- Setup TINYMCE WYSIWYG color picker colors in `lib/extras/tinymce_custom_colors.php`
- You can also adjust WYSIWYG formats in `lib/extras/tinymce_formats.php`
- There are some templates that can be set to use a transparent header by using `lib/extras/salient_force_transparent_header.php` when the UI element is not available in Salient.

## Installation

To install dependencies ensure you have node installed:
https://nodejs.org/en/

Install NPM dependencies:
`npm install`

Install JS dependencies
`bower install --save`

Build the dist folder
`gulp build`

Watch file changes
`gulp watch`

## SAAS
The theme uses SaaS for style generation.  The directory organization is an opionated structure for the theme.

## JS
JS is minified on build/watch.  There are some separated files/folders to keep it clean. Take note of the example JS includes to understand how to setup a good structure.

## Icons
To regenerate the icon font, simply take note of the icon naming convention in assets/icons/, and add a new icon with an incremented number prefix. Gulp takes care of the rest.