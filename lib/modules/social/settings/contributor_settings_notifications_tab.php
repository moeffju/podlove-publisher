<?php 
namespace Podlove\Modules\Social\Settings;

use \Podlove\Settings\Podcast\Tab;
use \Podlove\Modules\Social\Model\ShowService;

class ContributorSettingsNotificationsTab extends Tab {

	public function getObject() {
		return new self( 'podlove_contributor_settings' );
	}

	public function init() {
		add_action( $this->page_hook, array( $this, 'register_page' ) );
		add_action( 'admin_init', array( $this, 'process_form' ) );
	}

	public function process_form() {
		if (!isset($_POST['podlove_contributor_notifications']) )
			return;

		update_option('_podlove_contributor_notifications', $_POST['podlove_contributor_notifications']);
		header('Location: ' . 'admin.php?page=' . $_REQUEST['page'] . '&podlove_tab=notifications');
	}

	public function register_page() {
		$options = get_option( '_podlove_contributor_notifications' );
		?>
		<div class="wrap">
			Contributors for new Episodes will receive notifications via the selected services, if a new episode is published.
			<form method="post" action="admin.php?page=podlove_contributor_settings&action=save">
				<ul>
					<li>
						<div class="_podlove_contributor_notifications_triangles">
							<span class="_podlove_contributor_notifications_triangle">&#9658;</span>
							<span class="_podlove_contributor_notifications_triangle_expanded">&#9660;</span>
						</div>
							<input type="checkbox" id="_podlove_contributor_notifications_adn_pm"
								   name="podlove_contributor_notifications[adn_pm]" 
								   <?php echo ( isset( $options['adn_pm'] ) && $options['adn_pm'] == 'on' ? 'checked' : '' ) ?> />
							<label for="_podlove_contributor_notifications_adn_pm"
								   class="_podlove_contributor_notifications_label">
								App.net Private Message
							</label>
							<div class="_podlove_contributor_notifications_template">
								<table class="form-table">
									<tr>
										<th scope="row">
											<label for="">Template</label>
										</th>
										<td>
											<textarea class="large-text code autogrow"
										  name="podlove_contributor_notifications[adn_pm_template]"><?php echo ( isset( $options['adn_pm_template'] ) ? $options['adn_pm_template'] : '' ); ?></textarea>
										  <span class="description">Fuuu</span>
										</td>
									</tr>
								</table>
							</div>
					</li>
					<li>
						<div class="_podlove_contributor_notifications_triangles">
							<span class="_podlove_contributor_notifications_triangle">&#9658;</span>
							<span class="_podlove_contributor_notifications_triangle_expanded">&#9660;</span>
						</div>
							<input type="checkbox" id="_podlove_contributor_notifications_email"
								   name="podlove_contributor_notifications[email]" 
								   <?php echo ( isset( $options['email'] ) && $options['email'] == 'on' ? 'checked' : '' ) ?> />
							<label for="_podlove_contributor_notifications_email"
								   class="_podlove_contributor_notifications_label">
								E-Mail
							</label>
							<div class="_podlove_contributor_notifications_template">
								<table class="form-table">
									<tr>
										<th scope="row">
											<label for="">Title</label>
										</th>
										<td>
											<input type="text" name="podlove_contributor_notifications[email_template_title]" 
											       id="_podlove_contributor_notifications_email_title"
											       class="regular-text" value="<?php echo ( isset( $options['email_template_title'] ) ? $options['email_template_title'] : '' ); ?>" />
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label for="">Template</label>
										</th>
										<td>
											<textarea class="large-text code autogrow"
										  name="podlove_contributor_notifications[email_template]"><?php echo ( isset( $options['email_template'] ) ? $options['email_template'] : '' ); ?></textarea>
										  <span class="description">Fuuu</span>
										</td>
									</tr>
								</table>
							</div>
					</li>
				</ul>
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  />
			</form>
		</div>	
		<?php
	}

}