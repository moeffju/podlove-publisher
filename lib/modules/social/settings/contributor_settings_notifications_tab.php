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
		if (!isset($_POST['podlove_podcast']) || !$this->is_active())
			return;

		$formKeys = array('donations');

		$settings = get_option('podlove_podcast');
		foreach ($formKeys as $key) {
			$settings[$key] = $_POST['podlove_podcast'][$key];
		}
		update_option('podlove_podcast', $settings);
		
		header('Location: ' . $this->get_url());
	}

	public function register_page() {
		?>
		<div class="wrap">
			Contributors for new Episodes will receive notifications via the selected services, if a new episode is published.
			<form>
				<ul>
					<li>
						<div class="_podlove_contributor_notifications_triangles">
							<span class="_podlove_contributor_notifications_triangle">&#9658;</span>
							<span class="_podlove_contributor_notifications_triangle_expanded">&#9660;</span>
						</div>
							<input type="checkbox" id="_podlove_contributor_notifications_adn_pm"
								   name="_podlove_contributor_notifications_adn_pm" />
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
										  name="_podlove_contributor_notifications_adn_pm_template"></textarea>
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
								   name="_podlove_contributor_notifications_email" />
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
											<input type="text" name="_podlove_contributor_notifications_email_title" 
											       id="_podlove_contributor_notifications_email_title" 
											       class="regular-text" />
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label for="">Template</label>
										</th>
										<td>
											<textarea class="large-text code autogrow"
										  name="_podlove_contributor_notifications_email_template"></textarea>
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