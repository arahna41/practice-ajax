<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AJAX_Practice
 */

?>

		<footer id="colophon" class="site-footer">
			<div class="container_boxed">
				<a class="logo" href="/">AJAX Practice</a>
				<p>Theme: ajaxpractice by <a class="author" href="https://t.me/LiudmylaTyt">liudmyla tytarenko</a></p>
			</div>
		</footer><!-- #colophon -->
	</div>
</div><!-- #page -->
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyCzCTRUMd3B_m-BjgNstrx8Vhn5WcXvlY8", v: "beta"});</script>
<?php wp_footer(); ?>

</body>
</html>
