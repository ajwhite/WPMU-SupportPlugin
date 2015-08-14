<div class="wrap">
  <h2>Create Support Ticket</h2>

  <form method="post" action="?page=<?php echo $_REQUEST['page']; ?>&action=create">
    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('create_support_ticket'); ?>" />
    <input type="text" name="ticket[title]" />
    <br/>
    <textareaname="ticket[message]"></textareaname>
    <br/>
    <input type="submit" value="Create" />
  </form>
</div>
