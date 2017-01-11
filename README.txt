Circulos Podemos
=========

Este tema de Wordpress ha sido concebido para el proyecto de Wordpress-Multisite del círculo tic.

Wordpress-Multisite es un servicio que nos permite desplegar de una forma rápida y efectiva un blog para cualquier círculo Podemos que lo solicite, con plantillas pre-instaladas totalmente configurables y un mecanismo de actualización que permite tener a la ultima toda la red de blogs de círculos Podemos.


Version 1.0
----

En esta primera versión hemos abordado todos los aspectos iniciales que hemos creído indispensables para la publicación. Entre otras cosas hemos creído conveniente la adaptación a dispositivos móviles, el diseño limpio y sencillo y la apuesta por el código propio.

Tenemos pensadas muchas mejoras pero quien realmente decidirá estas mejoras serán los propios círculos que lo soliciten.


Licencia
----

Licencia Pública General de [GNU]


Notas de Instalación
----
Para que el thème se vea correctamente se ha de importar el contenido del archivo incluido en el tema. circulospodemos_volcado_inicial_de_datos_para_que_el_tema funcione_2016-08-11.xml

Sin él , las características css no se comienzan a ver en la web y el theme no se ve correctamente. 


A partir de la actualización de Wordpress 4.5.3 es necesario añadir este código al theme. Por falta de tiempo para probarlo te invito a que lo incluyas usando el modulo Jetpack que tiene esa funcionalidad o el plugin Simple Custom CSS 

En mi caso con jetpack es visitando este enlace 
http://tusitio.es/wp-admin/themes.php?page=editcss

Y este es el código a añadir que soluciona algunos problemas de actualizaciones

/*
Te damos la bienvenida a CSS personalizado

Para saber cómo funciona, ve a http://wp.me/PEmnE-Bt
*/
/*
Solución problema fondo del icono de buscar no transparente
*/
.quicktags, .search {
	background-color: transparent;
}

/*
 replicado aquí desde common.css ya que no eran incluidos estos estilos por razon desconocida, tiene que ver con la ultima actualizacion de wordpresss a 4.5.3 Coleman
  PROJECT: CÍRCULO PODEMOS
  FIRST UPDATE: 13.08.2014
  Actualizado por Jorge Valencia  11 de agosto de 2016
*/
/* TABLE OF CONTENTS
==================================================
  #COMMON
  #TYPOGRAPHY
  #HELP CLASSES


/* #COMMON
================================================== */
body {
	font-family: 'open_sans-regular', sans-serif;
	font-size: 1em;
	color: #333;
}

li {
	list-style: none;
}

ol {
	list-style-type: decimal;
}

.module {
	padding-bottom: 10px;
	margin-bottom: 10px;
}

/* #TYPOGRAPHY
================================================== */
h1, h2, h3, h4, h5, h6 {
	margin: 0;
	font-family: 'open_sans-bold';
	color: #612D62;
	font-weight: normal;
}

p {
	margin: 0 0 10px;
}

a {
	text-decoration: none;
	color: #612D62;
}

strong {
	font-family: 'open_sans-bold';
}

.bloquote {
	font-style: italic;
}

.section_title,
.section_title a {
	font-size: 35px;
	color: #612D62;
	display: block;
	text-align: center;
	text-transform: uppercase;
	font-family: 'open_sans-bold';
	margin: 55px auto 15px;
}

.module_title,
.widget_title,
#reply-title {
	font-size: 1.3em;
	font-family: 'open_sans-semibold';
	margin-bottom: 10px;
}

/* #BUTTONS
================================================== */
.page_nav a,
.button,
input[type="submit"] {
	background-color: #4B244C;
	color: #fff;
	font-family: 'open_sans-semibold';
	display: block;
	border-top: none;
	border-left: none;
	border-right: none;
	border-bottom: 4px solid #391D3A;
	padding: 15px 10px;
	font-size: 20px;
	text-transform: uppercase;
	text-align: center;
	margin: 15px auto;
	border-radius: 3px;
	width: 260px;
	-webkit-transition: background-color 200ms ease-in-out;
	-moz-transition: background-color 200ms ease-in-out;
	-ms-transition: background-color 200ms ease-in-out;
	-o-transition: background-color 200ms ease-in-out;
	transition: background-color 200ms ease-in-out;
}

.page_nav a:hover,
.button:hover,
input[type="submit"]:hover {
	background-color: #391D3A;
}

/* #IMAGES
================================================== */
.post header figure {
	background: url("../img/thumbnail.jpg") no-repeat center;
	background-size: 100%;
}

/* #HELP CLASSES
================================================== */
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}

* html .clearfix {
	zoom: 1;
}

:first-child+html .clearfix {
	zoom: 1;
}

.center {
	text-align: center;
}

.right {
	text-align: right;
}

.site-description {
	font: 300 italic 44px "Source Sans Pro", Helvetica, sans-serif;
	margin: 0;
	color: #ffffff;
}


