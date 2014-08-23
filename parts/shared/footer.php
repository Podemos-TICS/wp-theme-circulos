<footer id="main_footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<div class="container">
		<h1><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<aside class="contact_info">
			<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span class="icon location" itemprop="streetAddress"><?php echo get_option( 'direccion' ); ?></span>
				<p><span itemprop="addressLocality"><?php echo get_option( 'localidad' ); ?></span><span itemprop="addressRegion">, <?php echo get_option( 'provincia' ); ?></span></p>
				<p><span itemprop="postalCode"><?php echo get_option( 'codigo_postal' ); ?></span> - <span itemprop="addressCountry"><?php echo get_option( 'pais' ); ?></span></p>
				<a class="icon mail" href="mailto:<?php bloginfo( 'admin_email' ); ?>" itemprop="email"><?php bloginfo( 'admin_email' ); ?></a>
				<a class="icon url" href="/contactar" itemprop="email">Contactar</a>
				<!--<span class="icon phone" itemprop="telephone"><?php echo get_option( 'telefono' ); ?></span>-->
			</address>
		</aside>
		<nav class="legal">
			<a href="/aviso-legal">Aviso legal</a>
			<a href="/privacidad">Privacidad</a>
			<a href="/uso-de-cookies">Uso de Cookies</a>
		</nav>
	</div>
</footer>
