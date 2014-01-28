<?php $view_order_link = add_query_arg('order', $order->id, get_permalink(get_option('jigoshop_view_order_page_id'))); ?>

<?php if ($state == 'cancelled'): ?>
  <h4><?php print __('Su pedido ha sido CANCELADO.', 'pagosonline'); ?></h4>
  <p>
    <?php print __('¿Por qué? Estamos dispuestos a ayudarle a completar su compra. No dude en contactar con nosotros con respecto a la asistencia o quejas.'); ?> 
    <?php if ($contact = get_option('pagosonline_contact_page', FALSE)): ?>
     <a href="<?php print get_permalink($contact); ?>"><?php print __('Go to contact page', 'pagosonline'); ?></a>
    <?php endif; ?>
  </p>

<?php elseif ($state == 'on-hold' or $state == 'processing'): ?>
  <h4><?php print __('We\'re processing your payment!', 'pagosonline'); ?></h4>
  <p>
    <?php print __('Your payment is being processed. We will send you a confirmation once it arrives.', 'pagosonline'); ?> <a href="<?php print $view_order_link; ?><?php print __('View order', 'pagosonline'); ?></a>
  </p>

<?php elseif ($state == 'completed'): ?>
  <h4><?php print __('GRACIAS POR SU ORDEN!', 'pagosonline'); ?></h4>
  <p>
    <?php print __('Su compra se ha completado.', 'pagosonline'); ?> <!--a href="<?php print $view_order_link; ?>"><?php print __('View order', 'pagosonline'); ?></a-->
  </p>
  <?php print pagosonline_jigoshop::render('order_details.php', compact('order')); ?>
  <div style="display:none">
    <div id='mesagge'> <h2>Mesnaje de confirmacion de compra</h2>
    <p>Esto es el mensaje de compra llamar al x.xxx.xxx</p></div>
   
</div>

  <?
    $item = '5810';
    $items = $order->items;
    if($items){
      foreach($items as $k => $v){
          if($v['id'] == $item){ ?>
          <script>
          jQuery(document).ready(function() {
                $.fancybox(
                  jQuery('#mesagge').html(),
                  {
                          'autoDimensions'  : false,
                    'width'             : 350,
                    'height'            : 'auto',
                    'transitionIn'    : 'none',
                    'transitionOut'   : 'none'
                  }
                );
              });
              </script>
          <? }
      }
    }
  ?>

<?php elseif ($state == 'pending'): ?>
  <h4><?php print __('Your order is pending for payment.', 'pagosonline'); ?></h4>
  <p>
    <?php print __('We were unable to process the payment information. Please try again or cancel your order', 'pagosonline'); ?>. <a href="<?php print $order->get_checkout_payment_url(); ?><?php print __('Go to checkout', 'pagosonline'); ?></a> or  <a href="<?php print $order->get_cancel_order_url(); ?>"><?php print __('cancel order', 'pagosonline'); ?></a>
  </p>
<?php endif; ?>


