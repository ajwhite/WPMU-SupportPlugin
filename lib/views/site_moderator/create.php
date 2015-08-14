<div class="wrap">
  <h2>Create Support Ticket</h2>

  <form id="ticket-form" method="post">
    <input type="hidden" id="ticket-nonce" name="nonce" value="<?php echo wp_create_nonce('create_support_ticket'); ?>" />
    <input type="text" id="ticket-title" name="ticket[title]" />
    <br/>
    <textarea id="ticket-message" name="ticket[message]"></textarea>
    <br/>
    <input type="submit" value="Create" />
  </form>
</div>

<script type="text/javascript">
(function ($) {
  $(document).ready(function () {
    $('#ticket-form').submit(function () {
      $.post('/wp-admin/admin-ajax.php', {
        action: 'composeSiteModeratorTicket',
        nonce: $('#ticket-nonce').val(),
        ticket: {
          title: $('#ticket-title').val(),
          message: $('#ticket-message').val()
        }
      });
      return false;
    });
  });
})(jQuery);
</script>
