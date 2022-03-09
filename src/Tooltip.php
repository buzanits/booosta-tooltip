<?php
namespace booosta\tooltip;

use \booosta\Framework as b;
b::init_module('tooltip');

class Tooltip extends \booosta\ui\UI
{
  use moduletrait_tooltip;

  protected $content, $caption;
  protected $position;

  public function after_instanciation()
  {
    parent::after_instanciation();

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\Webapp")):
      $this->topobj->moduleinfo['tooltip'] = true;
      if($this->topobj->moduleinfo['jquery']['use'] == '') $this->topobj->moduleinfo['jquery']['use'] = true;
    endif;
  }

  public function get_htmlonly()
  {
    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\webapp")) $libpath = $this->topobj->base_dir;

    $libpath .= 'vendor/booosta/tooltip/src';

    $caption = $this->caption ? $this->caption : "<img src='$libpath/info.png'>";
    return "<span id='tooltip_$this->id'>$caption</span>";
  }

  public function get_js()
  {
    $position = $this->position ? $this->position : 'right';
    $content = str_replace("\n", "' +\n'", $this->content);

    if(is_object($this->topobj) && is_a($this->topobj, "\\booosta\\webapp\\webapp")):
      $this->topobj->add_jquery_ready("\$('#tooltip_$this->id').tooltipster({ content: \$('<span>$content</span>'), 
        position: '$position', animation: 'grow', theme: 'tooltipster-shadow' });");
      return '';
    else:
      return "\$(document).ready(function(){\$('#tooltip_$this->id').tooltipster({ content: \$('<span>$content</span>'), 
        position: '$position', animation: 'grow' }); });";
    endif;
  }

  public function set_content($content) { $this->content = $content; }
  public function set_caption($caption) { $this->caption = $caption; }
  public function set_position($position) { $this->position = $position; }
}
