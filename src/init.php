<?php
namespace booosta\tooltip;

\booosta\Framework::add_module_trait('webapp', 'tooltip\webapp');

trait webapp
{
  protected function preparse_tooltip()
  {
    $lib = 'vendor/tooltipster/tooltipster/dist';

    if($this->moduleinfo['tooltip']):
      $this->add_includes("<script type='text/javascript' src='{$this->base_dir}$lib/js/tooltipster.bundle.js'></script>
            <link rel='stylesheet' type='text/css' href='{$this->base_dir}$lib/css/tooltipster.bundle.css' />");
    endif;
  }
}
