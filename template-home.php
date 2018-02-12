<?php
/*
* Template Name: Home Template
*/
get_header();

/* HOME Page Slider */
$hide_slider = array('No');
if( function_exists( 'ot_get_option' ) )
{
	$hide_slider = ot_get_option('hide_slider',array('No'));
}

if( empty($_GET['type']) || (!empty($_GET['type']) && ($hide_slider[0] != 'Yes'))  )
{
	get_template_part( 'sliders/slider' );
}
?>

<div style="width: 980px;" id="content">

        <?php
        if(!empty($_GET['type']) )
        {
         		?>

        		<?php
        }
		else
		{
				?>

        		<?php
		}
		?>

        <div class="new-property-wrapper">
		        <div class="property-list">

		            	<?php

							// taxonomy query and meta query arrays
							$tax_query = array();
							$meta_query = array();

							// if property-type is set add it to taxonomy query
							if(!empty($_GET['type']) )
							{
								$property_type = $_GET['type'];
								if( $property_type != 'any' )
								{
									$tax_query[] = array(
														'taxonomy' => 'property-type',
														'field' => 'slug',
														'terms' => $property_type
													);
								}
							}

							// if city is set add it to taxonomy query
							if(!empty($_GET['city']))
							{
								$city = $_GET['city'];
								if( $city != 'any' )
								{
									$tax_query[] = array(
														'taxonomy' => 'property-city',
														'field' => 'slug',
														'terms' => $city
													);
								}
							}

							// if beds are set add it to meta query
							if(!empty($_GET['beds']) )
							{
								$beds = $_GET['beds'];
								if($beds != 'any' ) {
								    if ($beds >= 1) {
									$meta_query[] = array(
										'key' 		=> 'locality_property_bedrooms',
										'value' 	=> $beds,
										'compare' 	=> '>=',
										'type'		=> 'NUMERIC'
									);
								    }
								    else {
									$meta_query[] = array(
										'key' 		=> 'locality_property_bedrooms',
										'value' 	=> $beds,
										'compare' 	=> '=',
										'type'		=> 'NUMERIC'
									);
								    }
								}
							}

							// if baths are set and not any then add it to meta query
							if(!empty($_GET['baths']) )
							{
								$baths = $_GET['baths'];
								if($baths != 'any'){
									if ($baths >= 1) {
										$meta_query[] = array(
											'key' 		=> 'locality_property_bathrooms',
											'value' 	=> $baths,
											'compare' 	=> '>=',
											'type'		=> 'NUMERIC'
										);
									}
									else {
										$meta_query[] = array(
											'key' 		=> 'locality_property_bathrooms',
											'value' 	=> $baths,
											'compare' 	=> '=',
											'type'		=> 'NUMERIC'
										);
									}
								}
							}

							// if baths are set and not any then add it to meta query
							if(!empty($_GET['status']) )
							{
								$status = $_GET['status'];
								if( $status != 'any' )
								{
										$meta_query[] = array(
											 			'key' => 'locality_status',
											 			'value' => $status,
											 			'compare' => '='
											 		);
								}
							}

							// if both of the min and max prices are specified then add them to meta query
							if(!empty($_GET['min_price']) && !empty($_GET['max_price']) )
							{
								$min_price = intval($_GET['min_price']);
								$max_price = intval($_GET['max_price']);
								if( $min_price > 0 && $max_price > $min_price )
								{
									$meta_query[] = array(
											 			'key' => 'locality_property_price',
											 			'value' => array( $min_price, $max_price ),
											 			'type' => 'NUMERIC',
											 			'compare' => 'BETWEEN'
											 		);
								}
							}


							// if two taxonomies exist then specify the relation
							$tax_count = count($tax_query);
							if($tax_count > 1)
							{
								$tax_query['relation'] = 'AND';
							}

							// if two meta query elements exist then specify the relation
							$meta_count = count($meta_query);
							if($meta_count > 1)
							{
								$meta_query['relation'] = 'AND';
							}

							// properties per page as specified in theme options
							$properties_per_page = 6;
							if( function_exists( 'ot_get_option' ) )
							{
								$properties_per_page = intval(ot_get_option('properties_per_page'));
							}

							// base query arguments for home page properties
							$asdee = 50; // Вывод квартир на главной
							$search_args = array(
										'post_type' => 'property',
										'posts_per_page' => $asdee,
										'paged' => get_query_var( 'page' )
							);

							// skip slider properties logic
							if( function_exists( 'ot_get_option' ) )
							{
								$skip_slider_prop = ot_get_option('skip_prop',array('No'));

								if($skip_slider_prop[0] == 'Yes')
								{
									global $slider_properties;
									$search_args['post__not_in'] = $slider_properties;
								}
							}


							// if taxonomy query has some values then add it to base home page query
							if($tax_count > 0)
							{
								$search_args['tax_query'] = $tax_query;
							}

							// if meta query has some values then add it to base home page query
							if($meta_count > 0)
							{
								$search_args['meta_query'] = $meta_query;
							}

							// wp query
							$query = new WP_Query( $search_args );

							$i = 0;
							if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								$i++;
								?>
				                <div class="home-property-item">
				                        <h4>
											<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
												<?php the_title(); ?>
											</a>
										</h4>

				                        <div class="property-detail-block">
				                                <div class="property-pic-wrapper">

														<?php
														if ( has_post_thumbnail() )
														{
															$image_id = get_post_thumbnail_id();
															$image_url = wp_get_attachment_image_src($image_id,'full-size', true);

															$lightbox_array = array('No');
															if( function_exists( 'ot_get_option' ) )
															{
																$lightbox_array = ot_get_option('lightbox',array('No'));
															}

															if($lightbox_array[0] == 'Yes')
															{
																?>
																<a class="pretty-photo" href="<?php echo $image_url[0]; ?>" title="<?php the_title(); ?>">
																<?php
															}
															else
															{
																?>
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																<?php
															}
																		the_post_thumbnail('property-post-thumb',array(
																								'alt'	=> trim(strip_tags( get_the_title($post->ID) )),
																								'title'	=> trim(strip_tags( get_the_title($post->ID) ))
																		));	?>
															</a>
															<?php
														}
														?>

				                                        <div class="price-tag">

															<?php
															$terms = get_the_terms( $post->ID,"property-type" );

															if ( $terms && ! is_wp_error( $terms ) )
															{
															   foreach ( $terms as $term )
															   {
																	echo '<small><a class="property-type" href="' . get_term_link($term->slug, "property-type" ) .'">'.$term->name.'</a></small>';

																	break; // to display only one property type
																}
															}
															?>
		                                                	<h5 class="price">
															<?php
																//echo number_format(intval(get_post_meta($post->ID, 'locality_property_price', true)));
																//theme_currency();
																$price_min = number_format(intval(get_post_meta($post->ID, 'locality_property_price', true)));
																$price_max = number_format(intval(get_post_meta($post->ID, 'locality_property_price_max', true)));
																$price = number_format(intval(get_post_meta($post->ID, 'locality_property_price', true)));
																
																if (is_numeric($price_max) && $price_max>0)
																	$price = "от $price_min до $price_max ";

																
																echo $price;
																theme_currency();
															?>
															</h5>
                              
                      
				                                        </div>

														<?php
														$porperty_status = get_post_meta($post->ID, 'locality_status', true);
														if(!empty($porperty_status))
														{
															if( function_exists( 'ot_get_option' ) )
															{
																$hide_ribbons = ot_get_option('hide_ribbons',array('No'));
																if($hide_ribbons[0] != 'Yes')
																{
																	?>
																	<p class="<?php echo $porperty_status; ?>">
																		<?php echo $porperty_status; ?>
																	</p>
													    			<?php
																}
															}
														}
														?>

				                                </div>
				                                <div class="freatures-wrapper">
				                                        <span class="size"><?php echo get_post_meta($post->ID, 'locality_property_size', true); theme_unit(); ?></span>
				                                        <span class="bed"><?php echo get_post_meta($post->ID, 'locality_property_bedrooms', true); ?> <?php _e('Комнат', 'locality') ?></span>
				                                        <span class="bath"><?php echo get_post_meta($post->ID, 'locality_property_bathrooms', true); ?> <?php _e('Места', 'locality') ?></span>
				                                </div>
				                        </div>
				                        <p class="home-property-detail"><?php locality_excerpt(15); ?></p>
				                </div>


								<?php
								 if ($i % 3 == 0)
								 {
									 ?>
									 <div class="line-wrapper">
										<hr />
									 </div>
									 <?php
								 }

						endwhile;
						wp_reset_query();

						else:
							?>
                            <div class="alert-wrapper">
                                    <h4><?php _e('Извините, квартиры с такими параметрами не найдено', 'locality') ?></h4>
                                    <p class="sub-title"><?php _e('Можно выполнить поиск с другими критериями или посмотреть', 'locality') ?><a href="/">все квартиры</a></p>
                            </div>
                        	<?php
						endif;
						?>
				</div>

                <div class="pagination-wrapper">
		       		<?php theme_pagination($query->max_num_pages); ?>
				</div><!-- CONTENT-BLOCK CLOSED -->
		</div>

		<?php
		wp_reset_postdata();

			if (have_posts()) : while (have_posts()) : the_post();
				?>
				<!-- NEWS POST  OPENING-->
				<div <?php post_class('post-wrapper'); ?>>
						<div class="post-data">
								<?php the_content(); ?>
						</div>
				</div><!-- NEWS POST CLOSING-->
	        	<?php
			endwhile;

		endif;
		?>

</div><!-- CONTENT HOME CLOSED -->

<!-- SIDEBAR HOME -->


<?php get_footer(); ?>
