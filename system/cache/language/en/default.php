<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['ERR']['general'] = 'An error occurred!';
$GLOBALS['TL_LANG']['ERR']['unique'] = 'Duplicate entry in field "%s"!';
$GLOBALS['TL_LANG']['ERR']['mandatory'] = 'Field "%s" must not be empty!';
$GLOBALS['TL_LANG']['ERR']['mdtryNoLabel'] = 'This field must not be empty!';
$GLOBALS['TL_LANG']['ERR']['minlength'] = 'Field "%s" has to be at least %d characters long!';
$GLOBALS['TL_LANG']['ERR']['maxlength'] = 'Field "%s" must not be longer than %d characters!';
$GLOBALS['TL_LANG']['ERR']['digit'] = 'Please enter digits only!';
$GLOBALS['TL_LANG']['ERR']['prcnt'] = 'Please enter a percentage between 0 and 100!';
$GLOBALS['TL_LANG']['ERR']['alpha'] = 'Please enter alphabetic characters only!';
$GLOBALS['TL_LANG']['ERR']['alnum'] = 'Please enter alphanumeric characters only!';
$GLOBALS['TL_LANG']['ERR']['phone'] = 'Please enter a valid phone number!';
$GLOBALS['TL_LANG']['ERR']['extnd'] = 'For security reasons you can not use the following characters here: =<>&/()#';
$GLOBALS['TL_LANG']['ERR']['email'] = 'Please enter a valid e-mail address!';
$GLOBALS['TL_LANG']['ERR']['emails'] = 'There is at least one invalid e-mail address!';
$GLOBALS['TL_LANG']['ERR']['url'] = 'Please enter a valid URL format and encode special characters!';
$GLOBALS['TL_LANG']['ERR']['alias'] = 'Please enter only alphanumeric characters and the following special characters: .-_';
$GLOBALS['TL_LANG']['ERR']['folderalias'] = 'Please enter only alphanumeric characters and the following special characters: .-/_';
$GLOBALS['TL_LANG']['ERR']['date'] = 'Please enter the date as "%s"!';
$GLOBALS['TL_LANG']['ERR']['time'] = 'Please enter the time as "%s"!';
$GLOBALS['TL_LANG']['ERR']['dateTime'] = 'Please enter date and time as "%s"!';
$GLOBALS['TL_LANG']['ERR']['invalidDate'] = 'Invalid date "%s"!';
$GLOBALS['TL_LANG']['ERR']['noSpace'] = 'Field "%s" must not contain any whitespace characters!';
$GLOBALS['TL_LANG']['ERR']['filesize'] = 'The maximum size for file uploads is %s (Contao or php.ini settings)!';
$GLOBALS['TL_LANG']['ERR']['filetype'] = 'File type "%s" is not allowed to be uploaded!';
$GLOBALS['TL_LANG']['ERR']['filepartial'] = 'File %s was only partially uploaded!';
$GLOBALS['TL_LANG']['ERR']['filewidth'] = 'File %s exceeds the maximum image width of %d pixels!';
$GLOBALS['TL_LANG']['ERR']['fileheight'] = 'File %s exceeds the maximum image height of %d pixels!';
$GLOBALS['TL_LANG']['ERR']['filetarget'] = 'Cannot move %s to %s because the target exists!';
$GLOBALS['TL_LANG']['ERR']['invalidReferer'] = 'Access denied! The current host address (%s) does not match the referer host address (%s)!';
$GLOBALS['TL_LANG']['ERR']['invalidPass'] = 'Invalid password!';
$GLOBALS['TL_LANG']['ERR']['passwordLength'] = 'A password has to be at least %d characters long!';
$GLOBALS['TL_LANG']['ERR']['passwordName'] = 'Your username and password must not be the same!';
$GLOBALS['TL_LANG']['ERR']['passwordMatch'] = 'The passwords did not match!';
$GLOBALS['TL_LANG']['ERR']['accountLocked'] = 'This account has been locked! You can log in again in %d minutes.';
$GLOBALS['TL_LANG']['ERR']['invalidLogin'] = 'Login failed!';
$GLOBALS['TL_LANG']['ERR']['invalidColor'] = 'Invalid color format!';
$GLOBALS['TL_LANG']['ERR']['all_fields'] = 'Please select at least one field!';
$GLOBALS['TL_LANG']['ERR']['aliasExists'] = 'The alias "%s" already exists!';
$GLOBALS['TL_LANG']['ERR']['importFolder'] = 'The folder "%s" cannot be imported!';
$GLOBALS['TL_LANG']['ERR']['notWriteable'] = 'The file "%s" is not writeable and can therefore not be updated!';
$GLOBALS['TL_LANG']['ERR']['invalidName'] = 'This file or folder name is invalid!';
$GLOBALS['TL_LANG']['ERR']['invalidFile'] = 'The file or folder "%s" is invalid!';
$GLOBALS['TL_LANG']['ERR']['fileExists'] = 'The file "%s" already exists!';
$GLOBALS['TL_LANG']['ERR']['circularReference'] = 'Invalid redirect target (circular reference)!';
$GLOBALS['TL_LANG']['ERR']['ie6warning'] = '<strong>Attention!</strong> Your web browser is %sout of date%s and <strong>you cannot use all features of this website</strong>.';
$GLOBALS['TL_LANG']['ERR']['noFallbackEmpty'] = 'None of the active website root pages without an explicit DNS setting has the language fallback option set, which means that these websites are only available in the one language you have defined in the page settings! Visitors and search engines who do not speak this language will not be able to browse your website.';
$GLOBALS['TL_LANG']['ERR']['noFallbackDns'] = 'None of the active website root pages for <strong>%s</strong> has the language fallback option set, which means that these websites are only available in the one language you have defined in the page settings! Visitors and search engines who do not speak this language will not be able to browse your website.';
$GLOBALS['TL_LANG']['ERR']['multipleFallback'] = 'You can only define one website root page per domain as language fallback.';
$GLOBALS['TL_LANG']['ERR']['topLevelRoot'] = 'Top-level pages must be website root pages!';
$GLOBALS['TL_LANG']['ERR']['topLevelRegular'] = 'There are pages on the top-level which are not website root pages. Creating websites without a website root page is no longer supported, so please ensure that all pages are grouped under a website root page.';
$GLOBALS['TL_LANG']['ERR']['invalidTokenUrl'] = 'The link you were trying to open could not be verified. If you have clicked the link yourself or have received it by a trustworthy person, you can confirm the process below.';
$GLOBALS['TL_LANG']['ERR']['version2format'] = 'This element still uses the old Contao 2 SRC format. Did you upgrade the database?';
$GLOBALS['TL_LANG']['ERR']['form'] = 'The form could not be sent';
$GLOBALS['TL_LANG']['ERR']['captcha'] = 'Please answer the security question!';
$GLOBALS['TL_LANG']['ERR']['download'] = 'File "%s" is not available for download!';
$GLOBALS['TL_LANG']['ERR']['invalid'] = 'Invalid input: %s';
$GLOBALS['TL_LANG']['ERR']['fileNotFoundSync'] = 'No database entry found for %s. Please synchronize the file system.';
$GLOBALS['TL_LANG']['SEC']['question1'] = 'Please add %d and %d.';
$GLOBALS['TL_LANG']['SEC']['question2'] = 'What is the sum of %d and %d?';
$GLOBALS['TL_LANG']['SEC']['question3'] = 'Please calculate %d plus %d.';
$GLOBALS['TL_LANG']['CTE']['texts'] = 'Text elements';
$GLOBALS['TL_LANG']['CTE']['headline'][0] = 'Headline';
$GLOBALS['TL_LANG']['CTE']['headline'][1] = 'Generates a headline (h1 - h6).';
$GLOBALS['TL_LANG']['CTE']['text'][0] = 'Text';
$GLOBALS['TL_LANG']['CTE']['text'][1] = 'Generates a rich text element.';
$GLOBALS['TL_LANG']['CTE']['html'][0] = 'HTML';
$GLOBALS['TL_LANG']['CTE']['html'][1] = 'Allows you to add custom HTML code.';
$GLOBALS['TL_LANG']['CTE']['list'][0] = 'List';
$GLOBALS['TL_LANG']['CTE']['list'][1] = 'Generates an ordered or unordered list.';
$GLOBALS['TL_LANG']['CTE']['table'][0] = 'Table';
$GLOBALS['TL_LANG']['CTE']['table'][1] = 'Generates an optionally sortable table.';
$GLOBALS['TL_LANG']['CTE']['accordion'][0] = 'Accordion';
$GLOBALS['TL_LANG']['CTE']['accordion'][1] = 'Generates a MooTools accordion pane.';
$GLOBALS['TL_LANG']['CTE']['code'][0] = 'Code';
$GLOBALS['TL_LANG']['CTE']['code'][1] = 'Highlights code snippets and prints them to the screen.';
$GLOBALS['TL_LANG']['CTE']['links'] = 'Link elements';
$GLOBALS['TL_LANG']['CTE']['hyperlink'][0] = 'Hyperlink';
$GLOBALS['TL_LANG']['CTE']['hyperlink'][1] = 'Generates a link to another website.';
$GLOBALS['TL_LANG']['CTE']['toplink'][0] = 'Top link';
$GLOBALS['TL_LANG']['CTE']['toplink'][1] = 'Generates a link to jump to the top of the page.';
$GLOBALS['TL_LANG']['CTE']['media'] = 'Media elements';
$GLOBALS['TL_LANG']['CTE']['image'][0] = 'Image';
$GLOBALS['TL_LANG']['CTE']['image'][1] = 'Generates a stand-alone image.';
$GLOBALS['TL_LANG']['CTE']['gallery'][0] = 'Gallery';
$GLOBALS['TL_LANG']['CTE']['gallery'][1] = 'Generates a lightbox image gallery.';
$GLOBALS['TL_LANG']['CTE']['player'][0] = 'Video/audio';
$GLOBALS['TL_LANG']['CTE']['player'][1] = 'Generates a video or audio player.';
$GLOBALS['TL_LANG']['CTE']['youtube'][0] = 'YouTube';
$GLOBALS['TL_LANG']['CTE']['youtube'][1] = 'Adds a YouTube video.';
$GLOBALS['TL_LANG']['CTE']['files'] = 'File elements';
$GLOBALS['TL_LANG']['CTE']['download'][0] = 'Download';
$GLOBALS['TL_LANG']['CTE']['download'][1] = 'Generates a link to download a file.';
$GLOBALS['TL_LANG']['CTE']['downloads'][0] = 'Downloads';
$GLOBALS['TL_LANG']['CTE']['downloads'][1] = 'Generates multiple links to download files.';
$GLOBALS['TL_LANG']['CTE']['includes'] = 'Include elements';
$GLOBALS['TL_LANG']['CTE']['article'][0] = 'Article';
$GLOBALS['TL_LANG']['CTE']['article'][1] = 'Includes another article.';
$GLOBALS['TL_LANG']['CTE']['alias'][0] = 'Content element';
$GLOBALS['TL_LANG']['CTE']['alias'][1] = 'Includes another content element.';
$GLOBALS['TL_LANG']['CTE']['form'][0] = 'Form';
$GLOBALS['TL_LANG']['CTE']['form'][1] = 'Includes a form.';
$GLOBALS['TL_LANG']['CTE']['module'][0] = 'Module';
$GLOBALS['TL_LANG']['CTE']['module'][1] = 'Includes a front end module.';
$GLOBALS['TL_LANG']['CTE']['teaser'][0] = 'Article teaser';
$GLOBALS['TL_LANG']['CTE']['teaser'][1] = 'Displays the teaser text of an article.';
$GLOBALS['TL_LANG']['PTY']['regular'][0] = 'Regular page';
$GLOBALS['TL_LANG']['PTY']['regular'][1] = 'A regular page contains articles and content elements. It is the default page type.';
$GLOBALS['TL_LANG']['PTY']['redirect'][0] = 'External redirect';
$GLOBALS['TL_LANG']['PTY']['redirect'][1] = 'This type of page automatically redirects visitors to an external website. It works like a hyperlink.';
$GLOBALS['TL_LANG']['PTY']['forward'][0] = 'Internal redirect';
$GLOBALS['TL_LANG']['PTY']['forward'][1] = 'This type of page automatically forwards visitors to another page within the site structure.';
$GLOBALS['TL_LANG']['PTY']['root'][0] = 'Website root';
$GLOBALS['TL_LANG']['PTY']['root'][1] = 'This type of page marks the starting point of a new website within the site structure.';
$GLOBALS['TL_LANG']['PTY']['error_403'][0] = '403 Access denied';
$GLOBALS['TL_LANG']['PTY']['error_403'][1] = 'If a user requests a protected page without permission, a 403 error page will be loaded instead.';
$GLOBALS['TL_LANG']['PTY']['error_404'][0] = '404 Page not found';
$GLOBALS['TL_LANG']['PTY']['error_404'][1] = 'If a user requests a non-existent page, a 404 error page will be loaded instead.';
$GLOBALS['TL_LANG']['FOP']['fop'][0] = 'File operation permissions';
$GLOBALS['TL_LANG']['FOP']['fop'][1] = 'Here you can select the file operations you want to allow.';
$GLOBALS['TL_LANG']['FOP']['f1'] = 'Upload files to the server';
$GLOBALS['TL_LANG']['FOP']['f2'] = 'Edit, copy or move files and folders';
$GLOBALS['TL_LANG']['FOP']['f3'] = 'Delete single files and empty folders';
$GLOBALS['TL_LANG']['FOP']['f4'] = 'Delete folders including all files and subfolders (!)';
$GLOBALS['TL_LANG']['FOP']['f5'] = 'Edit files in the source editor';
$GLOBALS['TL_LANG']['CHMOD']['editpage'] = 'Edit page';
$GLOBALS['TL_LANG']['CHMOD']['editnavigation'] = 'Edit page hierarchy';
$GLOBALS['TL_LANG']['CHMOD']['deletepage'] = 'Delete page';
$GLOBALS['TL_LANG']['CHMOD']['editarticles'] = 'Edit articles';
$GLOBALS['TL_LANG']['CHMOD']['movearticles'] = 'Edit article hierarchy';
$GLOBALS['TL_LANG']['CHMOD']['deletearticles'] = 'Delete articles';
$GLOBALS['TL_LANG']['CHMOD']['cuser'] = 'Owner';
$GLOBALS['TL_LANG']['CHMOD']['cgroup'] = 'Group';
$GLOBALS['TL_LANG']['CHMOD']['cworld'] = 'Everybody';
$GLOBALS['TL_LANG']['DAYS'][0] = 'Sunday';
$GLOBALS['TL_LANG']['DAYS'][1] = 'Monday';
$GLOBALS['TL_LANG']['DAYS'][2] = 'Tuesday';
$GLOBALS['TL_LANG']['DAYS'][3] = 'Wednesday';
$GLOBALS['TL_LANG']['DAYS'][4] = 'Thursday';
$GLOBALS['TL_LANG']['DAYS'][5] = 'Friday';
$GLOBALS['TL_LANG']['DAYS'][6] = 'Saturday';
$GLOBALS['TL_LANG']['DAYS_SHORT'][0] = 'Sun';
$GLOBALS['TL_LANG']['DAYS_SHORT'][1] = 'Mon';
$GLOBALS['TL_LANG']['DAYS_SHORT'][2] = 'Tue';
$GLOBALS['TL_LANG']['DAYS_SHORT'][3] = 'Wed';
$GLOBALS['TL_LANG']['DAYS_SHORT'][4] = 'Thu';
$GLOBALS['TL_LANG']['DAYS_SHORT'][5] = 'Fri';
$GLOBALS['TL_LANG']['DAYS_SHORT'][6] = 'Sat';
$GLOBALS['TL_LANG']['MONTHS'][0] = 'January';
$GLOBALS['TL_LANG']['MONTHS'][1] = 'February';
$GLOBALS['TL_LANG']['MONTHS'][2] = 'March';
$GLOBALS['TL_LANG']['MONTHS'][3] = 'April';
$GLOBALS['TL_LANG']['MONTHS'][4] = 'May';
$GLOBALS['TL_LANG']['MONTHS'][5] = 'June';
$GLOBALS['TL_LANG']['MONTHS'][6] = 'July';
$GLOBALS['TL_LANG']['MONTHS'][7] = 'August';
$GLOBALS['TL_LANG']['MONTHS'][8] = 'September';
$GLOBALS['TL_LANG']['MONTHS'][9] = 'October';
$GLOBALS['TL_LANG']['MONTHS'][10] = 'November';
$GLOBALS['TL_LANG']['MONTHS'][11] = 'December';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][0] = 'Jan';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][1] = 'Feb';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][2] = 'Mar';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][3] = 'Apr';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][4] = 'May';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][5] = 'Jun';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][6] = 'Jul';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][7] = 'Aug';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][8] = 'Sep';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][9] = 'Oct';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][10] = 'Nov';
$GLOBALS['TL_LANG']['MONTHS_SHORT'][11] = 'Dec';
$GLOBALS['TL_LANG']['MSC']['dayShortLength'] = '3';
$GLOBALS['TL_LANG']['MSC']['monthShortLength'] = '3';
$GLOBALS['TL_LANG']['MSC']['weekOffset'] = '0';
$GLOBALS['TL_LANG']['MSC']['titleFormat'] = '%B %d%o, %Y';
$GLOBALS['TL_LANG']['MSC']['url'][0] = 'Link target';
$GLOBALS['TL_LANG']['MSC']['url'][1] = 'Please enter a web address (http://…), an e-mail address (mailto:…) or an insert tag.';
$GLOBALS['TL_LANG']['MSC']['target'][0] = 'Open in new window';
$GLOBALS['TL_LANG']['MSC']['target'][1] = 'Open the link in a new browser window.';
$GLOBALS['TL_LANG']['MSC']['decimalSeparator'] = '.';
$GLOBALS['TL_LANG']['MSC']['thousandsSeparator'] = ',';
$GLOBALS['TL_LANG']['MSC']['separator'][0] = 'Separator';
$GLOBALS['TL_LANG']['MSC']['separator'][1] = 'Please choose a field delimiter.';
$GLOBALS['TL_LANG']['MSC']['source'][0] = 'Source files';
$GLOBALS['TL_LANG']['MSC']['source'][1] = 'Please upload the CSV files to be imported.';
$GLOBALS['TL_LANG']['MSC']['comma'] = 'Comma';
$GLOBALS['TL_LANG']['MSC']['semicolon'] = 'Semicolon';
$GLOBALS['TL_LANG']['MSC']['tabulator'] = 'Tabulator';
$GLOBALS['TL_LANG']['MSC']['linebreak'] = 'Line break';
$GLOBALS['TL_LANG']['MSC']['lw_import'][0] = 'CSV import';
$GLOBALS['TL_LANG']['MSC']['lw_import'][1] = 'Import list items from a CSV file';
$GLOBALS['TL_LANG']['MSC']['lw_copy'] = 'Duplicate the element';
$GLOBALS['TL_LANG']['MSC']['lw_up'] = 'Move the element one position up';
$GLOBALS['TL_LANG']['MSC']['lw_down'] = 'Move the element one position down';
$GLOBALS['TL_LANG']['MSC']['lw_delete'] = 'Delete the element';
$GLOBALS['TL_LANG']['MSC']['tw_import'][0] = 'CSV import';
$GLOBALS['TL_LANG']['MSC']['tw_import'][1] = 'Import table items from a CSV file';
$GLOBALS['TL_LANG']['MSC']['tw_expand'] = 'Increase the input field size';
$GLOBALS['TL_LANG']['MSC']['tw_shrink'] = 'Decrease the input field size';
$GLOBALS['TL_LANG']['MSC']['tw_rcopy'] = 'Duplicate the row';
$GLOBALS['TL_LANG']['MSC']['tw_rup'] = 'Move the row one position up';
$GLOBALS['TL_LANG']['MSC']['tw_rdown'] = 'Move the row one position down';
$GLOBALS['TL_LANG']['MSC']['tw_rdelete'] = 'Delete the row';
$GLOBALS['TL_LANG']['MSC']['tw_ccopy'] = 'Duplicate the column';
$GLOBALS['TL_LANG']['MSC']['tw_cmovel'] = 'Move the column one position left';
$GLOBALS['TL_LANG']['MSC']['tw_cmover'] = 'Move the column one position right';
$GLOBALS['TL_LANG']['MSC']['tw_cdelete'] = 'Delete the column';
$GLOBALS['TL_LANG']['MSC']['ow_copy'] = 'Duplicate the row';
$GLOBALS['TL_LANG']['MSC']['ow_up'] = 'Move the row one position up';
$GLOBALS['TL_LANG']['MSC']['ow_down'] = 'Move the row one position down';
$GLOBALS['TL_LANG']['MSC']['ow_delete'] = 'Delete the row';
$GLOBALS['TL_LANG']['MSC']['ow_value'] = 'Value';
$GLOBALS['TL_LANG']['MSC']['ow_label'] = 'Label';
$GLOBALS['TL_LANG']['MSC']['ow_key'] = 'Key';
$GLOBALS['TL_LANG']['MSC']['ow_default'] = 'Default';
$GLOBALS['TL_LANG']['MSC']['ow_group'] = 'Group';
$GLOBALS['TL_LANG']['MSC']['mw_copy'] = 'Duplicate the row';
$GLOBALS['TL_LANG']['MSC']['mw_up'] = 'Move the row one position up';
$GLOBALS['TL_LANG']['MSC']['mw_down'] = 'Move the row one position down';
$GLOBALS['TL_LANG']['MSC']['mw_delete'] = 'Delete the row';
$GLOBALS['TL_LANG']['MSC']['mw_module'] = 'Module';
$GLOBALS['TL_LANG']['MSC']['mw_column'] = 'Column';
$GLOBALS['TL_LANG']['MSC']['aw_title'] = 'Title';
$GLOBALS['TL_LANG']['MSC']['aw_link'] = 'Link';
$GLOBALS['TL_LANG']['MSC']['aw_caption'] = 'Caption';
$GLOBALS['TL_LANG']['MSC']['aw_delete'] = 'Delete the language';
$GLOBALS['TL_LANG']['MSC']['aw_new'] = 'Add language';
$GLOBALS['TL_LANG']['MSC']['relative'] = 'Relative dimensions';
$GLOBALS['TL_LANG']['MSC']['proportional'][0] = 'Proportional';
$GLOBALS['TL_LANG']['MSC']['proportional'][1] = 'The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.';
$GLOBALS['TL_LANG']['MSC']['box'][0] = 'Fit the box';
$GLOBALS['TL_LANG']['MSC']['box'][1] = 'The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.';
$GLOBALS['TL_LANG']['MSC']['crop'] = 'Exact dimensions';
$GLOBALS['TL_LANG']['MSC']['left_top'][0] = 'Left | Top';
$GLOBALS['TL_LANG']['MSC']['left_top'][1] = 'Preserves the left part of a landscape image and the top part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['center_top'][0] = 'Center | Top';
$GLOBALS['TL_LANG']['MSC']['center_top'][1] = 'Preserves the center part of a landscape image and the top part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['right_top'][0] = 'Right | Top';
$GLOBALS['TL_LANG']['MSC']['right_top'][1] = 'Preserves the right part of a landscape image and the top part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['left_center'][0] = 'Left | Center';
$GLOBALS['TL_LANG']['MSC']['left_center'][1] = 'Preserves the left part of a landscape image and the center part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['center_center'][0] = 'Center | Center';
$GLOBALS['TL_LANG']['MSC']['center_center'][1] = 'Preserves the center part of a landscape image and the center part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['right_center'][0] = 'Right | Center';
$GLOBALS['TL_LANG']['MSC']['right_center'][1] = 'Preserves the right part of a landscape image and the center part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['left_bottom'][0] = 'Left | Bottom';
$GLOBALS['TL_LANG']['MSC']['left_bottom'][1] = 'Preserves the left part of a landscape image and the bottom part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['center_bottom'][0] = 'Center | Bottom';
$GLOBALS['TL_LANG']['MSC']['center_bottom'][1] = 'Preserves the center part of a landscape image and the bottom part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['right_bottom'][0] = 'Right | Bottom';
$GLOBALS['TL_LANG']['MSC']['right_bottom'][1] = 'Preserves the right part of a landscape image and the bottom part of a portrait image.';
$GLOBALS['TL_LANG']['MSC']['id'][0] = 'ID';
$GLOBALS['TL_LANG']['MSC']['id'][1] = 'Note that changing the ID can break data integrity!';
$GLOBALS['TL_LANG']['MSC']['pid'][0] = 'Parent ID';
$GLOBALS['TL_LANG']['MSC']['pid'][1] = 'Note that changing the parent ID can break data integrity!';
$GLOBALS['TL_LANG']['MSC']['sorting'][0] = 'Sorting value';
$GLOBALS['TL_LANG']['MSC']['sorting'][1] = 'The sorting value is usually assigned automatically.';
$GLOBALS['TL_LANG']['MSC']['all'][0] = 'Edit multiple';
$GLOBALS['TL_LANG']['MSC']['all'][1] = 'Edit multiple records at once';
$GLOBALS['TL_LANG']['MSC']['all_override'][0] = 'Override multiple';
$GLOBALS['TL_LANG']['MSC']['all_override'][1] = 'Override multiple records at once';
$GLOBALS['TL_LANG']['MSC']['all_fields'][0] = 'Available fields';
$GLOBALS['TL_LANG']['MSC']['all_fields'][1] = 'Please select the fields you want to edit.';
$GLOBALS['TL_LANG']['MSC']['password'][0] = 'Password';
$GLOBALS['TL_LANG']['MSC']['password'][1] = 'Please enter a password.';
$GLOBALS['TL_LANG']['MSC']['confirm'][0] = 'Confirmation';
$GLOBALS['TL_LANG']['MSC']['confirm'][1] = 'Please confirm the password.';
$GLOBALS['TL_LANG']['MSC']['dateAdded'][0] = 'Date added';
$GLOBALS['TL_LANG']['MSC']['dateAdded'][1] = 'Date added: %s';
$GLOBALS['TL_LANG']['MSC']['lastLogin'][0] = 'Last login';
$GLOBALS['TL_LANG']['MSC']['lastLogin'][1] = 'Last login: %s';
$GLOBALS['TL_LANG']['MSC']['move_up'][0] = 'Move up';
$GLOBALS['TL_LANG']['MSC']['move_up'][1] = 'Move the item one position up';
$GLOBALS['TL_LANG']['MSC']['move_down'][0] = 'Move down';
$GLOBALS['TL_LANG']['MSC']['move_down'][1] = 'Move the item one position down';
$GLOBALS['TL_LANG']['MSC']['staticFiles'][0] = 'Files URL';
$GLOBALS['TL_LANG']['MSC']['staticFiles'][1] = 'The files URL applies to the <em>files</em> directory (page speed optimization).';
$GLOBALS['TL_LANG']['MSC']['staticPlugins'][0] = 'Assets URL';
$GLOBALS['TL_LANG']['MSC']['staticPlugins'][1] = 'The assets URL applies to the <em>assets</em> directory (page speed optimization).';
$GLOBALS['TL_LANG']['MSC']['shortcuts'][0] = 'Back end keyboard shortcuts';
$GLOBALS['TL_LANG']['MSC']['shortcuts'][1] = 'Learn more about speeding up your workflow by using <a href="https://contao.org/en/manual/3.0/administration-area.html#keyboard-shortcuts" title="Keyboard shortcuts overview on contao.org" target="_blank">keyboard shortcuts</a>.';
$GLOBALS['TL_LANG']['MSC']['toggleAll'][0] = 'Toggle all';
$GLOBALS['TL_LANG']['MSC']['toggleAll'][1] = 'Expand or collapse all nodes';
$GLOBALS['TL_LANG']['MSC']['lockedAccount'][0] = 'A Contao account has been locked';
$GLOBALS['TL_LANG']['MSC']['lockedAccount'][1] = "The following Contao account has been locked for security reasons.\n\nUsername: %s\nReal name: %s\nWebsite: %s\n\nThe account has been locked for %d minutes, because the user has entered an invalid password three times in a row. After this period of time, the account will be unlocked automatically.\n\nThis e-mail has been generated by Contao. You can not reply to it directly.\n";
$GLOBALS['TL_LANG']['MSC']['toggleMobile'][0] = 'Mobile version';
$GLOBALS['TL_LANG']['MSC']['toggleMobile'][1] = 'Go to the mobile version';
$GLOBALS['TL_LANG']['MSC']['toggleDesktop'][0] = 'Desktop version';
$GLOBALS['TL_LANG']['MSC']['toggleDesktop'][1] = 'Go to the desktop version';
$GLOBALS['TL_LANG']['MSC']['feLink'] = 'Go to front end';
$GLOBALS['TL_LANG']['MSC']['fePreview'] = 'Front end preview';
$GLOBALS['TL_LANG']['MSC']['fePreviewTitle'] = 'Preview of the website in a new window';
$GLOBALS['TL_LANG']['MSC']['feUser'] = 'Front end user';
$GLOBALS['TL_LANG']['MSC']['backToTop'] = 'Back to top';
$GLOBALS['TL_LANG']['MSC']['backToTopTitle'] = 'Go to the top of the page';
$GLOBALS['TL_LANG']['MSC']['home'] = 'Home';
$GLOBALS['TL_LANG']['MSC']['homeTitle'] = 'Back to the back end start page';
$GLOBALS['TL_LANG']['MSC']['user'] = 'User';
$GLOBALS['TL_LANG']['MSC']['loginTo'] = 'Log into %s';
$GLOBALS['TL_LANG']['MSC']['loginBT'] = 'Login';
$GLOBALS['TL_LANG']['MSC']['logoutBT'] = 'Logout';
$GLOBALS['TL_LANG']['MSC']['logoutBTTitle'] = 'Close the current session';
$GLOBALS['TL_LANG']['MSC']['backBT'] = 'Go back';
$GLOBALS['TL_LANG']['MSC']['backBTTitle'] = 'Back to the previous page';
$GLOBALS['TL_LANG']['MSC']['cancelBT'] = 'Cancel';
$GLOBALS['TL_LANG']['MSC']['deleteConfirm'] = 'Do you really want to delete entry ID %s?';
$GLOBALS['TL_LANG']['MSC']['delAllConfirm'] = 'Do you really want to delete the selected records?';
$GLOBALS['TL_LANG']['MSC']['filterRecords'] = 'Records';
$GLOBALS['TL_LANG']['MSC']['filterAll'] = 'All';
$GLOBALS['TL_LANG']['MSC']['showRecord'] = 'Show the details of record %s';
$GLOBALS['TL_LANG']['MSC']['editRecord'] = 'Edit record %s';
$GLOBALS['TL_LANG']['MSC']['all_info'] = 'Edit selected records of table %s';
$GLOBALS['TL_LANG']['MSC']['showOnly'] = 'Show';
$GLOBALS['TL_LANG']['MSC']['sortBy'] = 'Sort';
$GLOBALS['TL_LANG']['MSC']['filter'] = 'Filter';
$GLOBALS['TL_LANG']['MSC']['search'] = 'Search';
$GLOBALS['TL_LANG']['MSC']['noResult'] = 'No records found.';
$GLOBALS['TL_LANG']['MSC']['save'] = 'Save';
$GLOBALS['TL_LANG']['MSC']['saveNclose'] = 'Save and close';
$GLOBALS['TL_LANG']['MSC']['saveNedit'] = 'Save and edit';
$GLOBALS['TL_LANG']['MSC']['saveNback'] = 'Save and go back';
$GLOBALS['TL_LANG']['MSC']['saveNcreate'] = 'Save and new';
$GLOBALS['TL_LANG']['MSC']['continue'] = 'Continue';
$GLOBALS['TL_LANG']['MSC']['close'] = 'Close';
$GLOBALS['TL_LANG']['MSC']['skipNavigation'] = 'Skip navigation';
$GLOBALS['TL_LANG']['MSC']['selectAll'] = 'Select all';
$GLOBALS['TL_LANG']['MSC']['pw_new'] = 'Change password';
$GLOBALS['TL_LANG']['MSC']['pw_change'] = 'Please enter a new password';
$GLOBALS['TL_LANG']['MSC']['pw_changed'] = 'The password has been updated.';
$GLOBALS['TL_LANG']['MSC']['fallback'] = 'default';
$GLOBALS['TL_LANG']['MSC']['view'] = 'View in a new window';
$GLOBALS['TL_LANG']['MSC']['fullsize'] = 'Open full size image in a new window';
$GLOBALS['TL_LANG']['MSC']['datepicker'] = 'Date picker';
$GLOBALS['TL_LANG']['MSC']['colorpicker'] = 'Color picker';
$GLOBALS['TL_LANG']['MSC']['pagepicker'] = 'Page picker';
$GLOBALS['TL_LANG']['MSC']['filepicker'] = 'File picker';
$GLOBALS['TL_LANG']['MSC']['ppHeadline'] = 'Contao pages';
$GLOBALS['TL_LANG']['MSC']['fpHeadline'] = 'Contao files';
$GLOBALS['TL_LANG']['MSC']['yes'] = 'yes';
$GLOBALS['TL_LANG']['MSC']['no'] = 'no';
$GLOBALS['TL_LANG']['MSC']['goBack'] = 'Go back';
$GLOBALS['TL_LANG']['MSC']['reload'] = 'Reload';
$GLOBALS['TL_LANG']['MSC']['above'] = 'above';
$GLOBALS['TL_LANG']['MSC']['below'] = 'below';
$GLOBALS['TL_LANG']['MSC']['date'] = 'Date';
$GLOBALS['TL_LANG']['MSC']['tstamp'] = 'Revision date';
$GLOBALS['TL_LANG']['MSC']['entry'] = '%s entry';
$GLOBALS['TL_LANG']['MSC']['entries'] = '%s entries';
$GLOBALS['TL_LANG']['MSC']['files'] = '%s file(s)';
$GLOBALS['TL_LANG']['MSC']['left'] = 'left';
$GLOBALS['TL_LANG']['MSC']['center'] = 'center';
$GLOBALS['TL_LANG']['MSC']['right'] = 'right';
$GLOBALS['TL_LANG']['MSC']['justify'] = 'justified';
$GLOBALS['TL_LANG']['MSC']['filetree'] = 'File system';
$GLOBALS['TL_LANG']['MSC']['male'] = 'Male';
$GLOBALS['TL_LANG']['MSC']['female'] = 'Female';
$GLOBALS['TL_LANG']['MSC']['fileSize'] = 'File size';
$GLOBALS['TL_LANG']['MSC']['fileCreated'] = 'Created';
$GLOBALS['TL_LANG']['MSC']['fileModified'] = 'Last modified';
$GLOBALS['TL_LANG']['MSC']['fileAccessed'] = 'Last accessed';
$GLOBALS['TL_LANG']['MSC']['fileDownload'] = 'Download';
$GLOBALS['TL_LANG']['MSC']['fileDownloadTitle'] = 'Download this file';
$GLOBALS['TL_LANG']['MSC']['fileImageSize'] = 'Width/height in pixel';
$GLOBALS['TL_LANG']['MSC']['filePath'] = 'Relative path';
$GLOBALS['TL_LANG']['MSC']['version'] = 'Version';
$GLOBALS['TL_LANG']['MSC']['restore'] = 'Restore';
$GLOBALS['TL_LANG']['MSC']['backendModules'] = 'Back end modules';
$GLOBALS['TL_LANG']['MSC']['welcomeTo'] = '%s back end';
$GLOBALS['TL_LANG']['MSC']['updateVersion'] = 'Contao version %s available';
$GLOBALS['TL_LANG']['MSC']['wordWrap'] = 'Word wrap';
$GLOBALS['TL_LANG']['MSC']['saveAlert'] = 'ATTENTION! You will lose any unsaved changes. Continue?';
$GLOBALS['TL_LANG']['MSC']['toggleNodes'] = 'Toggle all nodes';
$GLOBALS['TL_LANG']['MSC']['expandNode'] = 'Expand node';
$GLOBALS['TL_LANG']['MSC']['collapseNode'] = 'Collapse node';
$GLOBALS['TL_LANG']['MSC']['loadingData'] = 'Loading data';
$GLOBALS['TL_LANG']['MSC']['deleteSelected'] = 'Delete';
$GLOBALS['TL_LANG']['MSC']['editSelected'] = 'Edit';
$GLOBALS['TL_LANG']['MSC']['overrideSelected'] = 'Override';
$GLOBALS['TL_LANG']['MSC']['moveSelected'] = 'Move';
$GLOBALS['TL_LANG']['MSC']['copySelected'] = 'Copy';
$GLOBALS['TL_LANG']['MSC']['aliasSelected'] = 'Generate aliases';
$GLOBALS['TL_LANG']['MSC']['changeSelected'] = 'Change selection';
$GLOBALS['TL_LANG']['MSC']['resetSelected'] = 'Reset selection';
$GLOBALS['TL_LANG']['MSC']['fileManager'] = 'Open file manager in a popup window';
$GLOBALS['TL_LANG']['MSC']['systemMessages'] = 'System messages';
$GLOBALS['TL_LANG']['MSC']['clearClipboard'] = 'Clear clipboard';
$GLOBALS['TL_LANG']['MSC']['hiddenElements'] = 'Unpublished elements';
$GLOBALS['TL_LANG']['MSC']['hiddenHide'] = 'hide';
$GLOBALS['TL_LANG']['MSC']['hiddenShow'] = 'show';
$GLOBALS['TL_LANG']['MSC']['apply'] = 'Apply';
$GLOBALS['TL_LANG']['MSC']['applyTitle'] = 'Apply the changes';
$GLOBALS['TL_LANG']['MSC']['mandatory'] = 'Mandatory field';
$GLOBALS['TL_LANG']['MSC']['create'] = 'Create';
$GLOBALS['TL_LANG']['MSC']['delete'] = 'Delete';
$GLOBALS['TL_LANG']['MSC']['protected'] = 'protected';
$GLOBALS['TL_LANG']['MSC']['guests'] = 'guests only';
$GLOBALS['TL_LANG']['MSC']['updateMode'] = 'Update mode';
$GLOBALS['TL_LANG']['MSC']['updateAdd'] = 'Add the selected values';
$GLOBALS['TL_LANG']['MSC']['updateRemove'] = 'Remove the selected values';
$GLOBALS['TL_LANG']['MSC']['updateReplace'] = 'Replace the existing entries';
$GLOBALS['TL_LANG']['MSC']['ascending'] = 'ascending';
$GLOBALS['TL_LANG']['MSC']['descending'] = 'descending';
$GLOBALS['TL_LANG']['MSC']['default'] = 'Default';
$GLOBALS['TL_LANG']['MSC']['helpWizard'] = 'Open the help wizard';
$GLOBALS['TL_LANG']['MSC']['helpWizardTitle'] = 'Help wizard';
$GLOBALS['TL_LANG']['MSC']['noCookies'] = 'You have to allow cookies to use Contao.';
$GLOBALS['TL_LANG']['MSC']['copyOf'] = '%s (copy)';
$GLOBALS['TL_LANG']['MSC']['coreOnlyMode'] = 'Contao is currently running in <strong>safe mode</strong>, in which only core modules are loaded, to prevent possible incompatibilities with third-party extensions (e.g. after a Live Update). After you have checked the installed extensions, you can disable the safe mode again.';
$GLOBALS['TL_LANG']['MSC']['name'] = 'Name';
$GLOBALS['TL_LANG']['MSC']['emailAddress'] = 'E-mail address';
$GLOBALS['TL_LANG']['MSC']['register'] = 'Register';
$GLOBALS['TL_LANG']['MSC']['accountActivated'] = 'Your account has been activated.';
$GLOBALS['TL_LANG']['MSC']['accountError'] = 'Unable to process the current request.';
$GLOBALS['TL_LANG']['MSC']['emailSubject'] = 'Your registration on %s';
$GLOBALS['TL_LANG']['MSC']['adminSubject'] = 'New registration on %s';
$GLOBALS['TL_LANG']['MSC']['adminText'] = 'A new member (ID %s) has registered at your website.%sIf you did not allow e-mail activation, you have to enable the account manually in the back end.';
$GLOBALS['TL_LANG']['MSC']['requestPassword'] = 'Request password';
$GLOBALS['TL_LANG']['MSC']['setNewPassword'] = 'Set new password';
$GLOBALS['TL_LANG']['MSC']['newPasswordSet'] = 'Your password has been updated.';
$GLOBALS['TL_LANG']['MSC']['passwordSubject'] = 'Your password request for %s';
$GLOBALS['TL_LANG']['MSC']['accountNotFound'] = 'No matching account found';
$GLOBALS['TL_LANG']['MSC']['securityQuestion'] = 'Security question';
$GLOBALS['TL_LANG']['MSC']['closeAccount'] = 'Close account';
$GLOBALS['TL_LANG']['MSC']['changeSelection'] = 'Change selection';
$GLOBALS['TL_LANG']['MSC']['currentlySelected'] = 'Selected';
$GLOBALS['TL_LANG']['MSC']['selectNode'] = 'Only show this node';
$GLOBALS['TL_LANG']['MSC']['selectAllNodes'] = 'Show all nodes';
$GLOBALS['TL_LANG']['MSC']['showDifferences'] = 'Show differences';
$GLOBALS['TL_LANG']['MSC']['editElement'] = 'Edit the element';
$GLOBALS['TL_LANG']['MSC']['table'] = 'Table';
$GLOBALS['TL_LANG']['MSC']['description'] = 'Description';
$GLOBALS['TL_LANG']['MSC']['noVersions'] = 'Currently there are no versions.';
$GLOBALS['TL_LANG']['MSC']['latestChanges'] = 'Latest changes';
$GLOBALS['TL_LANG']['MSC']['identicalVersions'] = 'The two selected versions are identical.';
$GLOBALS['TL_LANG']['MSC']['selectNewPosition'] = 'Next, please choose the (new) position of the element';
$GLOBALS['TL_LANG']['MSC']['go'] = 'Go';
$GLOBALS['TL_LANG']['MSC']['quicknav'] = 'Quick navigation';
$GLOBALS['TL_LANG']['MSC']['quicklink'] = 'Quick link';
$GLOBALS['TL_LANG']['MSC']['username'] = 'Username';
$GLOBALS['TL_LANG']['MSC']['login'] = 'Login';
$GLOBALS['TL_LANG']['MSC']['logout'] = 'Logout';
$GLOBALS['TL_LANG']['MSC']['loggedInAs'] = 'You are logged in as %s.';
$GLOBALS['TL_LANG']['MSC']['emptyField'] = 'Please enter your username and password!';
$GLOBALS['TL_LANG']['MSC']['confirmation'] = 'Confirmation';
$GLOBALS['TL_LANG']['MSC']['sMatches'] = '%s occurrences for %s';
$GLOBALS['TL_LANG']['MSC']['sEmpty'] = 'No matches for <strong>%s</strong>';
$GLOBALS['TL_LANG']['MSC']['sResults'] = 'Results %s - %s of %s for <strong>%s</strong>';
$GLOBALS['TL_LANG']['MSC']['sNoResult'] = 'Your search for <strong>%s</strong> returned no results.';
$GLOBALS['TL_LANG']['MSC']['seconds'] = 'seconds';
$GLOBALS['TL_LANG']['MSC']['up'] = 'Up';
$GLOBALS['TL_LANG']['MSC']['first'] = '&#171; First';
$GLOBALS['TL_LANG']['MSC']['previous'] = 'Previous';
$GLOBALS['TL_LANG']['MSC']['next'] = 'Next';
$GLOBALS['TL_LANG']['MSC']['last'] = 'Last &#187;';
$GLOBALS['TL_LANG']['MSC']['goToPage'] = 'Go to page %s';
$GLOBALS['TL_LANG']['MSC']['totalPages'] = 'Page %s of %s';
$GLOBALS['TL_LANG']['MSC']['fileUploaded'] = 'File %s uploaded successfully.';
$GLOBALS['TL_LANG']['MSC']['fileExceeds'] = 'Image %s uploaded successfully, however it is too big to be resized automatically.';
$GLOBALS['TL_LANG']['MSC']['fileResized'] = 'Image %s uploaded successfully and was scaled down to the maximum dimensions.';
$GLOBALS['TL_LANG']['MSC']['searchLabel'] = 'Search';
$GLOBALS['TL_LANG']['MSC']['keywords'] = 'Keywords';
$GLOBALS['TL_LANG']['MSC']['options'] = 'Options';
$GLOBALS['TL_LANG']['MSC']['matchAll'] = 'match all words';
$GLOBALS['TL_LANG']['MSC']['matchAny'] = 'match any word';
$GLOBALS['TL_LANG']['MSC']['saveData'] = 'Save data';
$GLOBALS['TL_LANG']['MSC']['printPage'] = 'Print this page';
$GLOBALS['TL_LANG']['MSC']['printAsPdf'] = 'Print article as PDF';
$GLOBALS['TL_LANG']['MSC']['facebookShare'] = 'Share on Facebook';
$GLOBALS['TL_LANG']['MSC']['twitterShare'] = 'Share on Twitter';
$GLOBALS['TL_LANG']['MSC']['gplusShare'] = 'Share on Google+';
$GLOBALS['TL_LANG']['MSC']['pleaseWait'] = 'Please wait';
$GLOBALS['TL_LANG']['MSC']['loading'] = 'Loading …';
$GLOBALS['TL_LANG']['MSC']['more'] = 'Read more …';
$GLOBALS['TL_LANG']['MSC']['readMore'] = 'Read the article: %s';
$GLOBALS['TL_LANG']['MSC']['targetPage'] = 'Target page';
$GLOBALS['TL_LANG']['MSC']['invalidPage'] = 'Sorry, item "%s" does not exist.';
$GLOBALS['TL_LANG']['MSC']['list_orderBy'] = 'Order by %s';
$GLOBALS['TL_LANG']['MSC']['list_perPage'] = 'Results per page';
$GLOBALS['TL_LANG']['MSC']['published'] = 'Published';
$GLOBALS['TL_LANG']['MSC']['unpublished'] = 'Unpublished';
$GLOBALS['TL_LANG']['MSC']['addComment'] = 'Add a comment';
$GLOBALS['TL_LANG']['MSC']['autologin'] = 'Remember me';
$GLOBALS['TL_LANG']['MSC']['relevance'] = '%s relevance';
$GLOBALS['TL_LANG']['MSC']['invalidTokenUrl'] = 'Invalid token';
$GLOBALS['TL_LANG']['MSC']['changelog'] = 'Changelog';
$GLOBALS['TL_LANG']['MSC']['coreOnlyOff'] = 'Disable';
$GLOBALS['TL_LANG']['MSC']['dragItemsHint'] = 'Drag the items to re-order them';
$GLOBALS['TL_LANG']['MSC']['templatesTheme'] = 'Theme %s';
$GLOBALS['TL_LANG']['UNITS'][0] = 'Byte';
$GLOBALS['TL_LANG']['UNITS'][1] = 'KiB';
$GLOBALS['TL_LANG']['UNITS'][2] = 'MiB';
$GLOBALS['TL_LANG']['UNITS'][3] = 'GiB';
$GLOBALS['TL_LANG']['UNITS'][4] = 'TiB';
$GLOBALS['TL_LANG']['UNITS'][5] = 'PiB';
$GLOBALS['TL_LANG']['UNITS'][6] = 'EiB';
$GLOBALS['TL_LANG']['UNITS'][7] = 'ZiB';
$GLOBALS['TL_LANG']['UNITS'][8] = 'YiB';
$GLOBALS['TL_LANG']['CONFIRM']['do'] = 'Module';
$GLOBALS['TL_LANG']['CONFIRM']['table'] = 'Affected table';
$GLOBALS['TL_LANG']['CONFIRM']['act'] = 'Action';
$GLOBALS['TL_LANG']['CONFIRM']['id'] = 'Affected record';
$GLOBALS['TL_LANG']['DP']['select_a_time'] = 'Select a time';
$GLOBALS['TL_LANG']['DP']['use_mouse_wheel'] = 'Use the mouse wheel to quickly change value';
$GLOBALS['TL_LANG']['DP']['time_confirm_button'] = 'OK';
$GLOBALS['TL_LANG']['DP']['apply_range'] = 'Apply';
$GLOBALS['TL_LANG']['DP']['cancel'] = 'Cancel';
$GLOBALS['TL_LANG']['DP']['week'] = 'Wk';


/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['MSC']['cal_events'] = '%d event(s)';
$GLOBALS['TL_LANG']['MSC']['cal_previous'] = '&lt;';
$GLOBALS['TL_LANG']['MSC']['cal_next'] = '&gt;';
$GLOBALS['TL_LANG']['MSC']['cal_emptyDay'] = 'There are no events on this day.';
$GLOBALS['TL_LANG']['MSC']['cal_emptyWeek'] = 'There are no events for this week.';
$GLOBALS['TL_LANG']['MSC']['cal_emptyMonth'] = 'There are no events for this month.';
$GLOBALS['TL_LANG']['MSC']['cal_emptyYear'] = 'There are no events for this year.';
$GLOBALS['TL_LANG']['MSC']['cal_empty'] = 'Currently there are no events.';
$GLOBALS['TL_LANG']['MSC']['cal_days'] = 'This event is repeated every %s. day';
$GLOBALS['TL_LANG']['MSC']['cal_weeks'] = 'This event is repeated every %s. week';
$GLOBALS['TL_LANG']['MSC']['cal_months'] = 'This event is repeated every %s. month';
$GLOBALS['TL_LANG']['MSC']['cal_years'] = 'This event is repeated every %s. year';
$GLOBALS['TL_LANG']['MSC']['cal_until'] = 'until %s';


/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['MSC']['com_name'] = 'Name';
$GLOBALS['TL_LANG']['MSC']['com_email'] = 'E-mail (not published)';
$GLOBALS['TL_LANG']['MSC']['com_website'] = 'Website';
$GLOBALS['TL_LANG']['MSC']['com_comment'] = 'Comment';
$GLOBALS['TL_LANG']['MSC']['com_notify'] = 'Notify me of new comments by e-mail';
$GLOBALS['TL_LANG']['MSC']['com_submit'] = 'Submit comment';
$GLOBALS['TL_LANG']['MSC']['com_by'] = 'Comment by';
$GLOBALS['TL_LANG']['MSC']['com_reply'] = 'Reply by';
$GLOBALS['TL_LANG']['MSC']['com_quote'] = '%s wrote:';
$GLOBALS['TL_LANG']['MSC']['com_code'] = 'Code:';
$GLOBALS['TL_LANG']['MSC']['com_subject'] = 'New comment on %s';
$GLOBALS['TL_LANG']['MSC']['com_message'] = "%s has created a new comment on your website.\n\n---\n\n%s\n\n---\n\nView: %s\nEdit: %s\n\nIf you are moderating comments, you have to log in to the back end to publish it.";
$GLOBALS['TL_LANG']['MSC']['com_confirm'] = 'Your comment has been added and is now pending for approval.';
$GLOBALS['TL_LANG']['MSC']['com_optInConfirm'] = 'Your subscription has been activated';
$GLOBALS['TL_LANG']['MSC']['com_optInCancel'] = 'Your subscription has been cancelled';
$GLOBALS['TL_LANG']['MSC']['com_optInSubject'] = 'Your subscription on %s';
$GLOBALS['TL_LANG']['MSC']['com_optInMessage'] = "Hello %s,\n\nplease confirm that you want to be notified of new comments by e-mail on this page:\n\n%s\n\n---\n\nConfirm: %s\nCancel: %s\n";
$GLOBALS['TL_LANG']['MSC']['com_notifySubject'] = 'A new comment has been added on %s';
$GLOBALS['TL_LANG']['MSC']['com_notifyMessage'] = "Hello %s,\n\na new comment has been added on a page you have subscribed to:\n\n%s\n\n---\n\nTo cancel your subscription, please click here:\n%s\n";


/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['MSC']['faqCreatedBy'] = 'Last update on %s by %s.';


/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['MSC']['open'] = 'Read more on %s';
$GLOBALS['TL_LANG']['MSC']['author'] = 'Author';
$GLOBALS['TL_LANG']['MSC']['by'] = 'by';
$GLOBALS['TL_LANG']['MSC']['empty'] = 'There are no news items for this period.';
$GLOBALS['TL_LANG']['MSC']['emptyList'] = 'Currently there are no news items.';
$GLOBALS['TL_LANG']['MSC']['comments'] = 'Comments';
$GLOBALS['TL_LANG']['MSC']['commentCount'] = '(comments: %s)';
$GLOBALS['TL_LANG']['MSC']['news_items'] = '%d item(s)';
$GLOBALS['TL_LANG']['MSC']['news_previous'] = '&lt;';
$GLOBALS['TL_LANG']['MSC']['news_next'] = '&gt;';


/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * Core translations are managed using Transifex. To create a new translation
 * or to help to maintain an existing one, please register at transifex.com.
 * 
 * @link http://help.transifex.com/intro/translating.html
 * @link https://www.transifex.com/projects/p/contao/language/en/
 * 
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$GLOBALS['TL_LANG']['ERR']['subscribed'] = 'You are subscribed to the selected channels already.';
$GLOBALS['TL_LANG']['ERR']['unsubscribed'] = 'You are not subscribed to the selected channels.';
$GLOBALS['TL_LANG']['ERR']['invalidToken'] = 'The activation link is invalid or outdated.';
$GLOBALS['TL_LANG']['ERR']['noChannels'] = 'Please select at least one channel.';
$GLOBALS['TL_LANG']['MSC']['subscribe'] = 'Subscribe';
$GLOBALS['TL_LANG']['MSC']['unsubscribe'] = 'Unsubscribe';
$GLOBALS['TL_LANG']['MSC']['nl_subject'] = 'Your subscription on %s';
$GLOBALS['TL_LANG']['MSC']['nl_confirm'] = 'Thank you for your subscription. You will receive a confirmation e-mail.';
$GLOBALS['TL_LANG']['MSC']['nl_activate'] = 'Your subscription has been activated.';
$GLOBALS['TL_LANG']['MSC']['nl_removed'] = 'Your subscription has been cancelled.';
$GLOBALS['TL_LANG']['MSC']['nl_channels'] = 'Channels';


/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Christian de la Haye 2010
 * @author     Christian de la Haye 
 * @package    dlh_googlemaps 
 * @license    LGPL
 * @filesource
 */


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MOD']['dlh_googlemaps'] = array('Google Maps','Here you can administrate your Google Maps.');
$GLOBALS['TL_LANG']['CTE']['dlh_googlemaps'] = array('Google Map','Integrate a Google Map.');


/**
 * Labels
 */
$GLOBALS['TL_LANG']['dlh_googlemaps']['labels']['noscript']			= 'Google Map';
$GLOBALS['TL_LANG']['dlh_googlemaps']['labels']['routingLink']		= 'Routing';
$GLOBALS['TL_LANG']['dlh_googlemaps']['labels']['routingLabel']		= '? from your address:';
$GLOBALS['TL_LANG']['dlh_googlemaps']['labels']['routingSubmit']	= 'ok';
