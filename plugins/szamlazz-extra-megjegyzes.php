

add_filter('wc_szamlazz_xml', 'add_note_to_szallitolevel', 10, 3);

function add_note_to_szallitolevel($szamla, $order, $type) {
  if($type == 'delivery') {
    if($order->get_meta('_egyedi_mezo_neve')) {
      $szamlaz->fejlec->megjegyzes .= $order->get_meta('_egyedi_mezo_neve')
    }
  }
  return $szamla;
}

