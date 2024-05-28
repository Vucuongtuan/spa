<?php // @codingStandardsIgnoreLine
/**
 * RealDev - Vĩnh Minh Đạo - Kích hoạt Bản quyền Flatsome mọi phiên bản.
 *
 * @package      RealDev - Vĩnh Minh Đạo
 * @link         https://www.realdev.vn/
 * @since        1.0
 *
 * @wordpress-plugin
 * Plugin Name:       A-Z Flatsome Activator
 * Version:           1.0
 * Plugin URI:        https://realdev.vn/downloads/plugin-kich-hoat-ban-quyen-cho-flatsome-activated-all-version-1692.html
 * Description:       Plugin này được viết và chia sẻ bởi RealDev.vn | Chia sẻ với Bạn vì tình yêu và tâm huyết với cộng đồng VietCoders.Chúc bạn gặt hái nhiều thành công, thu nhập cao với Flatsome. Plugin này sau khi Kích hoạt sẽ tự động Kích hoạt Bản quyền cho Flatsome và tự động hủy kích hoạt. Bạn chỉ cần xóa Plugin sau khi Kích hoạt. Quá đơn giản đúng không.?
 * Author:            RealDev - Vĩnh Minh Đạo
 * Author URI:        https://realdev.vn/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       realdev-vn-activate-flatsome
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit;

/**
 * Updater class.
 */
class Realdev_Vn_Activate_Flatsome {
	/**
	 * Admin notices.
	 */
	private $notices = array();
	public function __construct() {
		if ( get_option( 'realdev_notices' ) === false ) {
			$this->realdev_activated();
			return;
		}

		$this->notices = get_option( 'realdev_notices', array() );
		add_action( 'admin_notices', array( $this, 'show_notices' ) );
	}
	/**
	 * Add admin notice.
	 */
	private function add_notice( $message ) {
		$this->notices[] = $message;
	}
	/**
	 * Show admin notices.
	 */
	public function show_notices() {
		if ( empty( $this->notices ) ) {
			return;
		}
		echo '<div class="notice notice-info is-dismissible realdev-vn-activate-flatsome-notice">';
		if ( count( $this->notices ) == 1 ) {
			$this->add_notice( '<em>' . __( 'Bạn không cần phải làm gì thêm.', 'realdev-vn-activate-flatsome' ) . '</em>' );
		}
		$this->add_notice( '<em>' . __( 'Plugin đã tự động Hủy kích hoạt. Xin vui lòng thực hiện Xóa Plugin khỏi danh sách Plugin của Bạn ^^.', 'realdev-vn-activate-flatsome' ) . '</em>' );
		foreach ( $this->notices as $message ) {
			echo '<p>'.$message.'</p>';
		}
		echo '</div>';
		update_option( 'realdev_notices', array() );
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
	/**
	 * Save plugin data to DB.
	 */
	private function save_data() {
	update_option( 'realdev_notices', $this->notices );
	add_option( 'flatsome_wup_purchase_code', 'GWrxBEss-VqSg-cJbs-dVvg-QzLEDfLzzExZ' );
	add_option( 'flatsome_wup_supported_until', '14.07.2099' );
	add_option( 'flatsome_wup_buyer', 'Licensed' );
	add_option( 'flatsome_wup_sold_at', time() );
	delete_option( 'flatsome_wup_errors');
	delete_option( 'flatsome_wupdates');
	}
	/**
	 * Run the Activate Process.
	 */
	private function realdev_activated() {
		$this->suffix = '_' . substr( md5( microtime() ), 0, 4 );
		$this->add_notice( '<strong>' . __( 'Theme Flatsome của Bạn đã được Kích hoạt thành công.', 'realdev-vn-activate-flatsome' ) . '</strong>' . __( 'RealDev đã giúp bạn Kích hoạt.', 'realdev-vn-activate-flatsome' ) );
		$this->save_data();
	}
}
/**
 * Cleanup the database after the plugin is deactivated.
 */
function realdev_vn_activate_flatsome_clean() {
	delete_option( 'realdev_notices' );
}
register_deactivation_hook( __FILE__, 'realdev_vn_activate_flatsome_clean' );
/**
 * Initialize the plugin.
 */
$realdev_vn_activate_flatsome = new Realdev_Vn_Activate_Flatsome();
