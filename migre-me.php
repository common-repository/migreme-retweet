<?php
/*
Plugin Name: Migre.me Retweet
Plugin URI: http://webord.net/desenvolvimento/migre-me
Description: Possibilita o usuário adicionar um botão de retweet no seu blog, usando as urls criadas pelo site <a href="http://migre.me/" target="_blank">Migre.me</a>, caso queira ajudar em algo no projeto entre em contato no blog <a href="http://webord.net/gustavo-s-bordoni/" target="_blank">Webord</a>. Para adicionar o botão de retweet basta colocar a função <code>&lt;?php get_migre(); ?&gt;</code> onde você desejar, dentro do <a href="http://codex.wordpress.org/The_Loop" target="_blank">Loop do Wordpress</a>.
Version: 0.7
Author: Gustavo S. Bordoni
Author URI: http://webord.net
*/

load_plugin_textdomain('migre','wp-content/plugins/migreme-retweet/');

### Function:  Migre.me Adminstração
add_action('admin_menu', 'migre_me');
function migre_me() {
	if (function_exists('add_menu_page')) {
		add_menu_page(__('Migre.me Retweet', 'migre'), __('Migre.me', 'migre'), 'manage_migre', 'migreme-retweet/migre-contato.php', '', plugins_url('migreme-retweet/images/icon.png'));
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('migreme-retweet/migre-contato.php', __('Opções do Migre.me ReTweet', 'migre'), __('Opções', 'migre'), 'manage_migre', 'migreme-retweet/migre-manage.php');
	}
}

function dashboard_migreme() {
			wp_add_dashboard_widget( 'dashboard_func_migreme', __( 'Migre.me Retweet' ), 'dashboard_func_migreme' );
		}
		add_action('wp_dashboard_setup', 'dashboard_migreme');
		
function dashboard_func_migreme() {	?>

		<?php _e('O Migre.me Retweet &eacute; um projeto Brasileiro de um plugin para Wordpress, que tem em mente facilitar a vida dos blogueiros que desejam adicionar um bot&atilde;o para seus usu&aacute;rios twittarem os artigos que foram publicados no blogs.', 'migre'); ?><br><br>
		<?php _e('O plugin &eacute; completamente gratuito e sem fins lucrativos, caso deseje nos ajudar a desenvolver o plugin para que se torne algo melhor, v&aacute; ao site <a href="http://webord.net/">Webord</a> e entre em contato.', 'migre'); ?> 

<?php	}


function get_migre($custom = false, $display = true) {

  $get_migre_permalink = get_permalink();
  $get_migre_twitter = get_option('twitter_migreme');
  $get_migre_twitter_id = $get_migre_twitter['id'];
  $get_migre_title = get_the_title_rss();
  $get_migre_url= "$get_migre_permalink";
  $get_migre_receber = new DOMDocument();
  $get_migre_receber->load('http://migre.me/api.xml?url=' . $get_migre_url . ''); //Não modifique esta linha!

  $get_migre_item = $get_migre_receber->getElementsByTagName("item");

  foreach( $get_migre_item as $get_migre_value )
  {
    $get_migre_migre_me = $get_migre_value->getElementsByTagName("migre");
    $get_migre_migre  = $get_migre_migre_me->item(0)->nodeValue;
  }

  $ordem_migreme = get_option('ordem_migreme');
	if ($ordem_migreme['ordem_1']==0) {
		$link1_migreme = "@$get_migre_twitter_id - ";
	} elseif ($ordem_migreme['ordem_1']==1) {
		$link1_migreme = "$get_migre_title ";
	} elseif ($ordem_migreme['ordem_1']==2) {
		$link1_migreme = "Em: $get_migre_migre - ";
	} else { 
		$link1_migreme = "";
	}
	
	if ($ordem_migreme['ordem_2']==0) {
		$link2_migreme = "@$get_migre_twitter_id - ";
	} elseif ($ordem_migreme['ordem_2']==1) {
		$link2_migreme = "$get_migre_title ";
	} elseif ($ordem_migreme['ordem_2']==2) {
		$link2_migreme = "Em: $get_migre_migre - ";
	} else { 
		$link2_migreme = "";
	}
	
	if ($ordem_migreme['ordem_3']==0) {
		$link3_migreme = "@$get_migre_twitter_id";
	} elseif ($ordem_migreme['ordem_3']==1) {
		$link3_migreme = "$get_migre_title";
	} elseif ($ordem_migreme['ordem_3']==2) {
		$link3_migreme = "Em: $get_migre_migre";
	} else { 
		$link3_migreme = "";
	}
  
	echo "<a href='http://twitter.com/home/?status=$link1_migreme$link2_migreme$link3_migreme' target='_blank' class='retweet-out'><div class='retweet'></div></a>";
  
}


function migreme_getPost() 
{ 
	global $wp_query; 
	$post = $wp_query->post; 
	return $post; 
} 

function migreme_getPostLink() 
{ 
	$post = migreme_getPost(); 
	$link = get_permalink($post->ID); 
	return $link; 
} 

function migreme_getPostTitle() 
{ 
	$post = migreme_getPost(); 
	$title = $post->post_title; 
	return $title; 
} 

function migreBotao($content) { 
  $mostra_migreme = get_option('mostra_migreme');
  $link  = migreme_getPostLink(); 
  $title = migreme_getPostTitle(); 
  $get_migre_twitter = get_option('twitter_migreme');
  $get_migre_twitter_id = $get_migre_twitter['id'];
  $get_migre_permalink = get_permalink();
  $get_migre_blog = get_bloginfo('title');
  $get_migre_title = get_the_title_rss();
  $get_migre_url= "$get_migre_permalink";
  $get_migre_receber = new DOMDocument();
  $get_migre_receber->load('http://migre.me/api.xml?url=' . $get_migre_url . ''); //Não modifique esta linha!

  $get_migre_item = $get_migre_receber->getElementsByTagName("item");

  foreach( $get_migre_item as $get_migre_value )
  {
    $get_migre_migre_me = $get_migre_value->getElementsByTagName("migre");
    $get_migre_migre  = $get_migre_migre_me->item(0)->nodeValue;
  }
  
  $ordem_migreme = get_option('ordem_migreme');
	if ($ordem_migreme['ordem_1']==0) {
		$link1_migreme = "@$get_migre_twitter_id - ";
	} elseif ($ordem_migreme['ordem_1']==1) {
		$link1_migreme = "$get_migre_title ";
	} elseif ($ordem_migreme['ordem_1']==2) {
		$link1_migreme = "Em: $get_migre_migre - ";
	} else { 
		$link1_migreme = "";
	}
	
	if ($ordem_migreme['ordem_2']==0) {
		$link2_migreme = "@$get_migre_twitter_id - ";
	} elseif ($ordem_migreme['ordem_2']==1) {
		$link2_migreme = "$get_migre_title ";
	} elseif ($ordem_migreme['ordem_2']==2) {
		$link2_migreme = "Em: $get_migre_migre - ";
	} else { 
		$link2_migreme = "";
	}
	
	if ($ordem_migreme['ordem_3']==0) {
		$link3_migreme = "@$get_migre_twitter_id";
	} elseif ($ordem_migreme['ordem_3']==1) {
		$link3_migreme = "$get_migre_title";
	} elseif ($ordem_migreme['ordem_3']==2) {
		$link3_migreme = "Em: $get_migre_migre";
	} else { 
		$link3_migreme = "";
	}

 	$botao = "<a href='http://twitter.com/home/?status=$link1_migreme$link2_migreme$link3_migreme' target='_blank' class='retweet-out'><div class='retweet'></div></a>"; 
  if ($mostra_migreme['mostra']=='1') {
	return $content . $botao; 
	} else {
	return $content;
	}

}



add_filter('the_content', 'migreBotao');

### Function: Displays Polls Header
add_action('wp_head', 'migre_header');
function migre_header() {	
	$botao_migreme = get_option('botao_migreme');
	
	if ($botao_migreme['imagem'] == '0') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_azul.png');
	} elseif ($botao_migreme['imagem'] == '1') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_vermelho.png');
	} elseif ($botao_migreme['imagem'] == '2') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_laranja.png');
	} elseif ($botao_migreme['imagem'] == '3') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_amarelo.png');
	} elseif ($botao_migreme['imagem'] == '4') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_verde.png');
	} elseif ($botao_migreme['imagem'] == '5') {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_rosa.png');
	} elseif ($botao_migreme['imagem'] == '6')  {
		$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_preto.png');
	} else {
		$botao_migreme_height = $botao_migreme['height'];
		$botao_migreme_width = $botao_migreme['width'];
		$botao_imagem_migreme = $botao_migreme['url'];
	}

	echo '<!-- Começa o Código gerado por Migre.me Retweet 0.7 -->'."\n";
	if ($botao_migreme['imagem'] == '7') {
		global $text_direction;
		echo '<style type="text/css">'."\n";	
			echo '.retweet { min-width:'. $botao_migreme_width .'px; min-height:'. $botao_migreme_height .'px; width:'. $botao_migreme_width .'px; height:'. $botao_migreme_height .'px; max-width:'. $botao_migreme_width .'px; max-height:'. $botao_migreme_height .'px; background:url(' . $botao_imagem_migreme .') no-repeat; }'."\n";
			echo 'a.retweet-out { outline:none; border:none; }	'."\n";
		echo '</style>'."\n";
		
	} else {

		global $text_direction;
		echo '<style type="text/css">'."\n";	
			echo '.retweet { min-width:100px; min-height:20px; width:100px; height:20px; max-width:100px; max-height:20px; background:url(' . $botao_imagem_migreme .') no-repeat 0 0 ; }'."\n";
			echo '.retweet:hover { background:url(' . $botao_imagem_migreme . ') no-repeat 0 -20px; }	'."\n";
			echo 'a.retweet-out { outline:none; border:none; }	'."\n";
		echo '</style>'."\n";
	} 
	echo '<!-- Termina o Código gerado por Migre.me Retweet 0.7  -->'."\n";

}

	$role = get_role('administrator');
	if(!$role->has_cap('manage_migre')) {
		$role->add_cap('manage_migre');
	}

?>