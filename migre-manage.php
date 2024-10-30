<?php
### Check Whether User Can Manage Migre.me ReTweet
if(!current_user_can('manage_migre')) {
	die('Acesso Negado!');
}


### Variables Variables Variables
$base_name = plugin_basename('migreme_retweet/migre-me.php');
$base_page = 'admin.php?page='.$base_name;
$id = intval($_GET['id']);




### If Form Is Submitted
if($_POST['Submit']) {
	$id_twitter_migre = strip_tags(trim($_POST['id_twitter_migre']));
	$url_botao_migre = strip_tags(trim($_POST['url_botao_migre']));
	$width_botao_migre = strip_tags(trim($_POST['width_botao_migre']));
	$height_botao_migre = strip_tags(trim($_POST['height_botao_migre']));
	$twitter_migreme = array('id' => $id_twitter_migre);
	$botao_migreme = array('imagem' => intval($_POST['botao_migreme_imagem']), 'url' => $url_botao_migre,'height' => $height_botao_migre,'width' => $width_botao_migre);
	$mostra_migreme = array('mostra' => intval($_POST['migreme_show_bt']));
	$ordem_migreme = array('ordem_1' => intval($_POST['ordem_1_migreme']), 'ordem_2' => intval($_POST['ordem_2_migreme']),'ordem_3' => intval($_POST['ordem_3_migreme']),);
	$update_migre_queries = array();
	$update_migre_text = array();	
	$update_migre_queries[] = update_option('twitter_migreme', $twitter_migreme);
	$update_migre_queries[] = update_option('botao_migreme', $botao_migreme);
	$update_migre_queries[] = update_option('mostra_migreme', $mostra_migreme);
	$update_migre_queries[] = update_option('ordem_migreme', $ordem_migreme);
	$update_migre_text[] = __('URL do Tweet', 'migre');
	$update_migre_text[] = __('Imagem do Bot&atilde;o', 'migre');
	$update_migre_text[] = __('Bot&atilde;o Autom&aacute;tico', 'migre');
	$update_migre_text[] = __('Configura&ccedil;&atilde;o do link', 'migre');
	$i=0;
	$text = '';
	foreach($update_migre_queries as $update_migre_query) {
		if($update_migre_query) {
			$text .= '<font color="green">'.$update_migre_text[$i].' '.__('foi atualizado(a)', 'migre').'</font><br />';
		}
		$i++;
	}
	if(empty($text)) {
		$text = '<font color="red">'.__('Nenhuma Op&ccedil;&atilde;o foi atualizada', 'migre').'</font>';
	}
	
}
?>

<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form id="migreme_options" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
<div class="wrap">
	<h2><?php _e('Administra&ccedil;&atilde;o Migre.me ReTweet', 'migre'); ?></h2>
	<!-- Botao Migre.me Retweet	-->
	<?php $mostra_migreme = get_option('mostra_migreme'); ?>
	<h3><?php _e('Bot&atilde;o Autom&aacute;tico', 'migre'); ?></h3>
	<table class="form-table">
		 <tr>
			<th scope="row" valign="top"><?php _e('Autom&aacute;tico abaixo do artigo:', 'migre'); ?></th>
			<td>
				<select name="migreme_show_bt" size="1">
					<option value="0"<?php selected('0', $mostra_migreme['mostra']); ?>><?php _e('N&atilde;o', 'migre'); ?></option>
					<option value="1"<?php selected('1', $mostra_migreme['mostra']); ?>><?php _e('Sim', 'migre'); ?></option>
				</select>
				

				
				<div id="message" class="updated fade"><p><?php _e('Caso escolhas n&atilde;o, para exibir o bot&atilde;o voc&ecirc; dever adicionar o c&oacute;digo <code>&lsaquo;?php get_migre(); ?&rsaquo;</code> onde deseja exibir o bot&atilde;o.', 'migre'); ?></p></div>
			</td>
		</tr>
	</table>
	<?php $botao_migreme = get_option('botao_migreme'); ?>
	<?php $twitter_migreme = get_option('twitter_migreme'); ?>
		<h3><?php _e('Imagem do Bot&atilde;o', 'migre'); ?></h3>
	<table class="form-table">
		 <tr>
			<th scope="row" valign="top"><?php _e('Selecione uma imagem:', 'migre'); ?></th>
			<td colspan="2">
				<select name="botao_migreme_imagem" size="1">
					<option value="0"<?php selected('0', $botao_migreme['imagem']); ?>><?php _e('Azul', 'migre'); ?></option>
					<option value="1"<?php selected('1', $botao_migreme['imagem']); ?>><?php _e('Vermelho', 'migre'); ?></option>
					<option value="2"<?php selected('2', $botao_migreme['imagem']); ?>><?php _e('Laranja', 'migre'); ?></option>
					<option value="3"<?php selected('3', $botao_migreme['imagem']); ?>><?php _e('Amarelo', 'migre'); ?></option>
					<option value="4"<?php selected('4', $botao_migreme['imagem']); ?>><?php _e('Verde', 'migre'); ?></option>
					<option value="5"<?php selected('5', $botao_migreme['imagem']); ?>><?php _e('Rosa', 'migre'); ?></option>
					<option value="6"<?php selected('6', $botao_migreme['imagem']); ?>><?php _e('Preto', 'migre'); ?></option>
					<option value="7"<?php selected('7', $botao_migreme['imagem']); ?>><?php _e('Personalizado', 'migre'); ?></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<th scope="row" valign="top"><?php _e('ID no Twitter', 'migre'); ?></th>
			<td width="50%" dir="ltr"><input type="text" id="id_twitter_migre" name="id_twitter_migre" value="<?php echo $twitter_migreme['id']; ?>" size="20" onblur="update_migre('id');" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Url Bot&atilde;o Retweet', 'migre'); ?></th>
			<td width="50%" dir="ltr"><input type="text" id="url_botao_migre" name="url_botao_migre" value="<?php echo $botao_migreme['url']; ?>" size="50" onblur="update_migre('url');" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Altura do Bot&atilde;o [Height]', 'migre'); ?></th>
			<td width="20%" dir="ltr"><input type="text" id="height_botao_migre" name="height_botao_migre" value="<?php echo $botao_migreme['height']; ?>" size="6" onblur="update_migre('height');" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('Largura do Bot&atilde;o [Width]', 'migre'); ?></th>
			<td width="20%" dir="ltr"><input type="text" id="width_botao_migre" name="width_botao_migre" value="<?php echo $botao_migreme['width']; ?>" size="6" onblur="update_migre('width');" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" valign="top"><?php _e('O Bot&atilde;o ficar&aacute; desta maneira:', 'migre'); ?></th>
			<td colspan="2">
				<?php
					$botao_migreme_height = '20';
					$botao_migreme_width = '100';
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
					} else {
						$botao_imagem_migreme = plugins_url('migreme-retweet/images/botao_preto.png');
					}
					if($botao_migreme['imagem'] == '7') {
						echo '<div id="wp-migreme-bt" style="min-width: '. $botao_migreme['width'] .'px; max-width: '. $botao_migreme['width'] .'px; min-height: '. $botao_migreme['height'] .'px; background-image: url(\''. $botao_migreme['url'] .'\');"></div>'."\n";
					} else {
						echo '<div id="wp-migreme-bt" style="min-width: '. $botao_migreme_width .'px; max-width: '. $botao_migreme_width .'px; min-height: '. $botao_migreme_height .'px; background-image: url(\''. $botao_imagem_migreme .'\');"></div>'."\n";
					}
				?>
			</td>
		</tr>
		
		<?php

?>
	</table>
	
	<h3><?php _e('Configura&ccedil;&atilde;o do Tweet', 'migre'); ?></h3>
	<?php $ordem_migreme = get_option('ordem_migreme'); ?>
		<table class="form-table">
		 <tr>
			<th scope="row" valign="top"><?php _e('Editar o Link:', 'migre'); ?></th>
			<td colspan="2">
				<select name="ordem_1_migreme" size="1">
					<option value="0"<?php selected('0', $ordem_migreme['ordem_1']); ?>><?php _e('ID do Twitter', 'migre'); ?></option>
					<option value="1"<?php selected('1', $ordem_migreme['ordem_1']); ?>><?php _e('Titulo do Artigo', 'migre'); ?></option>
					<option value="2"<?php selected('2', $ordem_migreme['ordem_1']); ?>><?php _e('Migre.me Link', 'migre'); ?></option>
					<option value="3"<?php selected('3', $ordem_migreme['ordem_1']); ?>><?php _e('Deixa em Branco', 'migre'); ?></option>
				</select>
				<select name="ordem_2_migreme" size="1">
					<option value="0"<?php selected('0', $ordem_migreme['ordem_2']); ?>><?php _e('ID do Twitter', 'migre'); ?></option>
					<option value="1"<?php selected('1', $ordem_migreme['ordem_2']); ?>><?php _e('Titulo do Artigo', 'migre'); ?></option>
					<option value="2"<?php selected('2', $ordem_migreme['ordem_2']); ?>><?php _e('Migre.me Link', 'migre'); ?></option>
					<option value="3"<?php selected('3', $ordem_migreme['ordem_2']); ?>><?php _e('Deixa em Branco', 'migre'); ?></option>
				</select>
				<select name="ordem_3_migreme" size="1">
					<option value="0"<?php selected('0', $ordem_migreme['ordem_3']); ?>><?php _e('ID do Twitter', 'migre'); ?></option>
					<option value="1"<?php selected('1', $ordem_migreme['ordem_3']); ?>><?php _e('Titulo do Artigo', 'migre'); ?></option>
					<option value="2"<?php selected('2', $ordem_migreme['ordem_3']); ?>><?php _e('Migre.me Link', 'migre'); ?></option>
					<option value="3"<?php selected('3', $ordem_migreme['ordem_3']); ?>><?php _e('Deixa em Branco', 'migre'); ?></option>
				</select>
			</td>
		</tr>
		</table>
	<!-- Submit Button -->
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('Salvar Configura&ccedil;&otilde;es', 'migre'); ?>" />
	</p>
</div> 
</form> 