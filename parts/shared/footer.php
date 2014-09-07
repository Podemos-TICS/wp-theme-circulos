<footer id="main_footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<div class="container">
		<h1><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<aside class="contact_info">
			<address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span class="icon location" itemprop="streetAddress"><?php echo esc_attr( get_the_author_meta( 'direccion_postal', $user->ID ) ); ?></span>
				<p><span itemprop="addressLocality"><?php echo esc_attr( get_the_author_meta( 'localidad', $user->ID ) ); ?></span>, </span><span itemprop="addressRegion"><?php echo esc_attr( get_the_author_meta( 'provincia', $user->ID ) ); ?></span></p>
				<p><span itemprop="postalCode"><?php echo esc_attr( get_the_author_meta( 'codigo_postal', $user->ID ) ); ?></span> - <span itemprop="addressCountry"><?php echo esc_attr( get_the_author_meta( 'pais', $user->ID ) ); ?></span></p>
				<a class="icon mail" href="/contactar" itemprop="email">Contactar</a>
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
