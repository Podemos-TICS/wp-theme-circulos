<footer id="main_footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<div class="container">
		<h1><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>

		<?php
		$direccion_postal = of_get_option('direccion_postal','');
		$codigo_postal = of_get_option('codigo_postal','');
		$provincia = of_get_option('provincia','');
		$localidad = of_get_option('localidad','');
		$pais = of_get_option('pais','');

		if ( ($direccion_postal) || ($codigo_postal) || ($provincia) || ($localidad) || ($pais)) { ?>
		<aside class="contact_info">
			<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php if ($direccion_postal) { ?>
					<span class="icon location" itemprop="streetAddress"><?php echo $direccion_postal  ?></span>
				<?php } ?>
				<?php if ($codigo_postal) { ?>
					<span itemprop="postalCode"><?php echo $codigo_postal ?></span>
				<?php } ?>
				<?php if ($provincia) { ?>
					<span itemprop="addressLocality"><?php echo $localidad ?></span>
				<?php } ?>
				<?php if ($pais) { ?>
					<span itemprop="addressCountry"><?php echo $pais ?></span></span>
				<?php } ?>
				<a class="icon mail" href="/contactar" itemprop="email">Contactar</a>
			</address>
		</aside>

		<?php } ?>

		<?php
		$twitter = of_get_option('twitter','');
		$google_plus = of_get_option('google_plus','');
		$google_group = of_get_option('google_group','');
		$facebook_fan_page = of_get_option('facebook_fan_page','');
		$facebook_grupo = of_get_option('facebook_grupo','');
		$diaspora = of_get_option('diaspora','');
		$loomio = of_get_option('loomio','');
		$reddit = of_get_option('reddit','');
		$ene_uno = of_get_option('ene_uno','');

		if ( ($twitter) || ($google_plus) || ($google_group) || ($facebook_fan_page) || ($facebook_grupo) || ($diaspora) || ($loomio) || ($reddit) || ($ene_uno)  ) { ?>
			<nav class="rrss-circulo">
			<ul>
				<?php if ($twitter) { ?><li><a class="icon twitter" target="_blank" href="<?php echo $twitter  ?>" title="Perfil de Twitter de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($google_plus) { ?><li><a class="icon gplus" target="_blank" href="<?php echo $google_plus  ?>" title="Perfil de Google Plus de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($google_group) { ?><li><a class="icon gplus" target="_blank" href="<?php echo $google_group  ?>" title="Perfil de Google Group de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($facebook_fan_page) { ?><li><a class="icon facebook" target="_blank" href="<?php echo $facebook_fan_page  ?>" title="Facebook fan page de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($facebook_grupo) { ?><li><a class="icon facebook" target="_blank" href="<?php echo $facebook_grupo  ?>" title="Grupo de Facebook de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($diaspora) { ?><li><a class="icon diaspora" target="_blank" href="<?php echo $diaspora  ?>" title="Diaspora de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($loomio) { ?><li><a class="icon loomio" target="_blank" href="<?php echo $loomio  ?>" title="Loomio de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($reddit) { ?><li><a class="icon reddit" target="_blank" href="<?php echo $reddit  ?>" title="Reddit de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
				<?php if ($ene_uno) { ?><li><a class="icon ene_uno" target="_blank" href="<?php echo $ene_uno  ?>" title="Reddit de <?php bloginfo( 'name' ); ?>"></a></li><?php  } ?>
			</ul>
		</nav>
		<?php } ?>

		<nav class="legal">
			<a href="/aviso-legal">Aviso legal</a>
			<a href="/privacidad">Privacidad</a>
			<a href="/politica-de-cookies">Política de Cookies</a>
		</nav>
	</div>
</footer>
