#Versions

##1.2.5

Same as 1.1.21

##1.1.21

* German support
* Bootstrap 3.1.1 upgrade
* User activation by email
* Number of items per page in option
* Unit tests now run with mockery 0.9.0

##1.2.4

Same as 1.1.20

##1.1.20

* Fix redirection after login
* Unit tests refactoring (now use mockery)

##1.2.3

Same as 1.1.19

##1.1.19

* Refactoring codes
* RTL languages support
* Uyghur support
* Bootstrap 3.1.x support
* jQuery 2.1.x support

##1.2.2

Same as 1.1.18

##1.1.18

* Refactoring code (deleting src/start.php, routes & filters are now loaded in SyntaraServiceProvider)
* Dutch support
* Turkish support
* Swedish support
* Greek support

##1.2.1

Same as 1.1.17 

##1.1.17

08/01/2014

* New documentation
* Bootstrap 3.0.2 to 3.0.3
* Return of validation rules in a config file
* Update user validation rules (expend string to 255 chars)
* External assets now uses cdnjs by cloudfare
* Self ban are now disabled

##1.2

15/12/2013

* Laravel 4.1 support
* Fix permissions unit tests
* Fix "create" user button

##1.1.16

08/12/2013

* Add spanish support
* Fix typos

##1.1.15

* i18 support : vietnamese
* Possibility to add favicon
* Upgrade to Bootstrap 3.0.2
* Add Syntara Update command
* Possibility to change master layout
* Possibility to change dashboard uri

##1.1.14

* Fix Php 5.3 compatibility

##1.1.13

* Fix error on create user command

##1.1.12

* Fix error on create permission

##1.1.11

* i18n support : Slovenian

##1.1.10

* i18n support : Russian

##1.1.9

* i18n support : EN/FR/IT/RO

##1.1.8

* Prepare Syntara for Syntara Logviewer (https://github.com/MrJuliuss/syntara-logviewer)

##1.1.7

* Activate user on users list
* Change validators rules for last_name/first_name
* Fix errors on create/update permissions

##1.1.6

* Fixing errors (appeared with Syntara 1.1.5) on install

##1.1.5

* Refactoring config files
* Fix search user by user ID
* Possibility to override views

##1.1.4

* Uban/unban user from the user profile
* Search banned user in users list

##1.1.3

* Can add new permission to custom routes
* Refresh user informations in ajax on user update
* PushState support for ajax redirects (Thanks to Kofel)


##1.1.2

* Update "Custom development" doc
* Redirect attempted url after login
* create an empty Permission model from Permission provider : PermissionProvider::createModel()

##1.1.1

* Add superuser permission to "Admin" group on install.
* New migration : update "Admin" group with superuser permission

##1.1

* Permissions stored in a specific table
* User may have permissions

##1.0.4

* Fix delete item link
* Add confirm modal on deleting item
* Fix font-weight

##1.0.3

* Changes site name
* Add custom navigation
* Fix breadcrumbs on error page
* Fix css
* Fix minor text fixes

##1.0.2

* Fix redirections errors when create user/group
* Fix error message for duplicate email.

##1.0.1

* Update bootstrap 3RC1 to Release
* Fix username existing on create user
* Fix placeholder in login form ("Username" in Email input...)

##1.0

* First release