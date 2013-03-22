<?php
require('../../../../../wp-blog-header.php');

# RECEBE AS VARIAVEIS
$productID = $_POST['pID'];
$productImagemTipo = $_POST['tipo'];
$page = $_POST['page'];

if(isset($_POST['parent'])) $parent = $_POST['parent'];

# VERIFICA SE ESTÁ CHAMANDO SOMENTE A IMAGEM DESTAQUE DA SINGLE
if($productImagemTipo == 'destaque') :

	$query = "
			SELECT * FROM wp_posts p
			WHERE ID = ".$productID." 
			AND post_type = 'wpsc-product'
			ORDER BY ID
			";					
	$results = $wpdb->get_results($query, OBJECT);
	  
	$post_thumbnail_id = get_post_thumbnail_id( reset($results)->ID );
	
	$imageFULL = reset(wp_get_attachment_image_src( $post_thumbnail_id, 'large' ));
	$imageURL = reset(wp_get_attachment_image_src( $post_thumbnail_id, array(477,436) ));
	
	echo "<img src='$imageURL' alt='".reset($results)->post_title." title='".reset($results)->post_title."' zoom='$imageFULL' />";
	?>
	
	<script type="text/javascript">
	jQuery(document).ready(function(){
		// Ativa o zoom na imagem destaque
		jQuery('#boxImageZoom').zoom({
			url: jQuery('#boxImageZoom img').attr('zoom')
		});
	
	});
	</script>
<?php 

# ESSE TRECHO VERIFICA SE AS VARIAÇÕES CHAMADAS SÃO DA SINGLE OU DA PAGE
else:
	if($page=='single') :
		 $args = array(
			   'post_type' => 'attachment',
			   'post_status' => 'any',
			   'posts_per_page' => 10,
			   'post_parent' => $productID,
			   'order' => 'ASC'
		  );
		  
		  // The Query
		query_posts( $args );
		
		// The Loop
		$i=0;
		if(have_posts())
		{		
			while ( have_posts() ) : the_post();
			
				if($i%4==0) { $style = 'style="margin-left:0px;"'; } else { $style = ''; }
			?>
				<li <?php echo $style; ?>>
												
					<?php 
					$default_attr = array(
						'class'	=> "img-".$post->ID,
						'alt'   => $productName,
						'title' => $productName,
						'thumb' => reset(wp_get_attachment_image_src($post->ID, array(477,436)))
					);
					echo wp_get_attachment_image( $post->ID, array(69,63), false, $default_attr );
					?>
				   
				</li>
			<?php
				$i++;
			endwhile;
		}
		wp_reset_query();

	else :
		$args = array(
			   'post_type' => 'attachment',
			   'post_status' => 'any',
			   'posts_per_page' => 1,
			   'post_parent' => $productID,
			   'order' => 'ASC'
		  );
		  
		  // The Query
		query_posts( $args );
		
		// The Loop
		$i=0;
		if(have_posts())
		{		
			while ( have_posts() ) : the_post();
		
				$imagemThumb = wp_get_attachment_image_src( $post->ID, array(69,63) );
				
				echo '<img id="'.$parent.'" src="'.$imagemThumb[0].'" product="'.$post->ID.'" parent="'. $parent.'" />';
				
				$i++;
			endwhile;
		}
		wp_reset_query();

	endif;
endif; 
?>