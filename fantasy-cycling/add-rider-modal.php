<?php
/**
 * template for add rider modal
 *
 * It can be overriden
 *
 * @since 0.1.0
 */
?>

<div id="fc-add-rider-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content fc-add-riders-modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Rider</h4>
      </div>
      <div class="modal-body">
        <div id="fc-add-rider"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <input type="hidden" name="rider-row-id" id="rider-row-id" value="">
</div><!-- /.modal -->

<div id="my-team-page-loader"><div id="loader-gif"><img src="/wp-includes/images/wpspin-2x.gif"></div></div>