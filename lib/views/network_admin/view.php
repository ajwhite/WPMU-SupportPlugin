<?php
use Atticoos\Plugins\MultisiteSupport\Services\NetworkAdminSupportService;
$service = new NetworkAdminSupportService();
$ticket = $service->getTicket($_REQUEST['post'], $_REQUEST['site']);
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
                    <option>Atticus</option>
                  </select>
                </div>
                <div class="misc-pub-section">
                  <label style="font-weight:bold;">Priority</label><br/>
                  <select class="widefat">
                    <option>High</option>
                  </select>
                </div>
                <div class="misc-pub-section">
                  <label style="font-weight:bold;">Category</label><br/>
                  <select class="widefat">
                    <option>Needs Help</option>
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
        <?php for($i = 0; $i< 4; $i++): ?>
        <div class="postbox">
          <h3 class="hndle">Foobar</h3>
          <div class="inside">
            Message one
          </div>
        </div>
        <?php endfor; ?>
        <?php wp_editor('', 'foobar'); ?>
      </div>
    </div>
  </div>
</div>
