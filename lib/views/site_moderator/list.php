<?php
use Atticoos\Plugins\MultisiteSupport\Tables\SiteModeratorSupportTicketTable;
$table = new SiteModeratorSupportTicketTable();
$table->prepare_items();
?>

<div class="wrap">
  <h2>Support Tickets</h2>
  <a href="?page=<?php echo $_REQUEST['page']; ?>&action=create">Create Ticket</a>
  <form method="post">
    <?php $table->views(); ?>
    <?php $table->display(); ?>
  </form>
</div>
