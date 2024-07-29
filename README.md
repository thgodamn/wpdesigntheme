Theme For Wordpress  
Author: Magomed Saybulaev  
Url: https://h176557.srv12.test-hf.su/  

Description:  Тема включает два основных блока: калькулятор и слайдер, оба построены с использованием Advanced Custom Fields (ACF). Тема написана с нуля, включает интеграцию с REST API и следует методологии БЭМ. Тема полностью построена на нативном JavaScript.  

Version: 1.0

Slider (ACF):

-- Text + Image
![Slider Text-Image](theme-1.jpg)

-- Accordion (only text)
![Slider Accordion](theme-3.jpg)


Calculator (ACF):
![Slider Calculator](theme-2.jpg)

PageSpeed Report:
![Slider Calculator](theme-page-speed.jpg)


## Usage

Write to hosts file
```
#wpdesigntheme.local
127.0.0.1 wpdesigntheme.local
```

## Links

- dev copy: http://wpdesigntheme.local
- database: http://wpdesigntheme.local:8085

## Credentials

MySQL root:

**User**: `root`  
**Password**: `password`

MySQL access:

**User**: `wordpress`  
**Password**: `wordpress`  
**Database**: `wordpress`  
**Host**: `mariadb`

## Directory Structure

* `www` - The web root of your web application.

## Commands

`make help` - Print commands help.  
`make up` - Start containers.  
`make down` - Stop containers.  
`make start` - Start containers without updating.  
`make stop` - Stop containers.  
`make shell` - Access `php` container via shell.  
`make wp` - Executes `wp cli` command in a specified `WP_ROOT` directory (default is `/var/www/html/`).  


