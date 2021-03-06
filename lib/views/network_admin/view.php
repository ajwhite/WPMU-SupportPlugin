<?php
use Atticoos\Plugins\MultisiteSupport\Services\NetworkAdminSupportService;
$service = new NetworkAdminSupportService();
$ticket = $service->getTicket($_REQUEST['post'], $_REQUEST['site']);
$assignees = $service->getAssignees();
?>

<div class="wrap">

  <h2>View Message</h2>

  <div id="poststuff">
    <div id="post-body" class="columns-2">

      <div id="post-body-content">
        <div class="postbox">
          <h3 class="hndle ">Ticket Details</h3>
          <div class="inside">
            <strong>Subject</strong>
            <?php echo $ticket->getSubject(); ?><br/>
            <strong>Message</strong><br/>

            <?php echo $ticket->getDescription(); ?>
          </div>
        </div>
      </div>

      <div id="postbox-container-1">
        <div id="submitdiv" class="postbox">
          <h3 class="hndle">Message Information</h3>
          <div class="inside">
            <div id="submitpost" class="submitbox">

              <div id="misc-publishing-actions">

                <div class="misc-pub-section">
                  <label style="font-weight:bold;">Assignee</label><br/>
                  <select class="widefat">
                    <option value="">-- Select Assignee --</option>
                    <?php foreach($assignees as $assignee): ?>
                      <option
                        value="<?php echo $assignee->ID; ?>"
                        <?php if ($ticket->hasAssignee() && $ticket->getAssignee()->ID === $assignee->ID): ?>
                        selected
                        <?php endif; ?>
                        ><?php echo $assignee->display_name; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="misc-pub-section">
                  <label style="font-weight:bold;">Priority</label><br/>
                  <select class="widefat">
                    <option value="">-- Select Priority --</option>
                    <?php foreach (NetworkAdminSupportService::$priorities as $key=>$value): ?>
                    <option
                      value="<?php echo $key; ?>"
                      <?php if ($ticket->getPriority() == $key): ?>
                      selected
                      <?php endif; ?>
                      ><?php echo $value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="misc-pub-section">
                  <label style="font-weight:bold;">Category</label><br/>
                  <select class="widefat">
                    <option value="">-- Select Category--</option>
                    <?php foreach (NetworkAdminSupportService::$categories as $key=>$value): ?>
                      <option
                        value="<?php echo $key; ?>"
                        <?php if ($ticket->getCategory() == $key): ?>
                        selected
                        <?php endif; ?>
                        ><?php echo $value; ?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>

              <div id="major-publishing-actions">
                <div id="delete-action">
                  <a href="#" class="submitdelete deletion">Close</a>
                </div>
                <div id="publishing-action">
                  <input type="button" value="Save" id="publish" class="button button-primary button-large" />
                </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="postbox-container-2" class="postbox-container">
        <?php foreach ($ticket->thread as $message): ?>
        <div class="postbox">
          <h3 class="hndle"><?php echo $message->author->display_name; ?></h3>
          <div class="inside">
            <?php echo apply_filters('the_content', $message->post_content); ?>
          </div>
        </div>
        <?php endforeach; ?>
        <?php wp_editor('', 'ticket-message'); ?>
        <br>
        <input type="button" value="Reply" id="reply" class="button button-primary button-large" />
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
(function ($) {
  $(document).ready(function () {
    $('#reply').click(function () {
      $.post('/wp-admin/admin-ajax.php', {
        action: 'respondToTicket',
        ticket: {
          message: tinyMCE.activeEditor.getContent(),
          id: <?php echo $_REQUEST['post']; ?>,
          site: <?php echo $_REQUEST['site']; ?>
        }
      }, function () {
        location.reload();
      });
    });
  });
})(jQuery);
</script>
