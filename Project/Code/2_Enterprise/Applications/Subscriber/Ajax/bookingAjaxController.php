<?php 
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';

require_once 'Project/Code/System/Accounts/userAccounts/userAccount.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Authorization/authorization.php';

require_once 'Project/Code/1_Website/Applications/Booking/Controllers/inquiry/inquiryView.php';
require_once 'Project/Code/1_Website/Applications/Booking/Controllers/inquiry/inquiryModel.php';
require_once 'Project/Code/System/Bookings/booking.php';
require_once 'Project/Code/1_Website/Applications/Booking/Modules/calendarEvent.php';

require_once 'Project/Code/2_Enterprise/Applications/Bookings_Manager/Module/notificationsModule.php';
require_once 'Project/Code/System/Bookings/notifications.php';

require_once 'Project/Code/2_Enterprise/Applications/User_Account_Admin/Module/mailer.php';

class bookingAjaxController extends applicationsSuperController {
	
	public function submit_requestAction() {
		
		$booking = new booking();	

		$user_account_id = authorization::getUserSession()->user_account_id;
		$check_in = strtotime($_POST['check_in']);
		$check_out = strtotime($_POST['check_out']);
		$number_of_rooms = $_POST['numberOfRooms'];
		$guests = $_POST['guests'];
		
		if ($check_in == $check_out)
			$check_out = strtotime('+1 day', $check_in);
		
		$stay_days = calendarEvent::daysOfStay($check_in, $check_out);
		
		if(calendarEvent::hasConflict($check_in, $check_out)) {
			$conflict_msg = '';
			$conflict = 'true';
			jQuery('#reservation-response span')->html($conflict_msg);
			jQuery('#response-true-or-false')->html($conflict);
			
		} 
		elseif(calendarEvent::hasConflict($check_in, $check_out, "Reserved")) {
			$conflict_msg = 'Sorry, The date you prefer is already booked';
			$conflict = 'true';
			jQuery('#reservation-response span')->html($conflict_msg);
			jQuery('#response-true-or-false')->html($conflict);
			
		} 
		else {
			$booking->setUserAccountID($user_account_id);
			$booking->setCheckIn($check_in);
			$booking->setCheckOut($check_out);
			$booking->setGuests($guests);
			$booking->setStayDays($stay_days);
			$booking->setNumberOfRooms($number_of_rooms);
			$booking->insert();		
			
			$no_conflict = 'Thank you for your reservation request. We will be on contact with you shortly to confirm your booking.';
			$conflict = 'false';
			
			$mailer = new mailer();
			$mailer->bookingRequesMailer($user_account_id, $check_in, $check_out);
			
			jQuery('#reservation-response span')->html($no_conflict);
			jQuery('#response-true-or-false')->html($conflict);
		}
		
		jQuery::getResponse();
	}
	
	public function deleteNotificationAction() {
		
		$notification_id = $_REQUEST['notification_id'];
		
		$notificationModule = new notificationsModule();
		$notificationModule->delete_notification($notification_id);
		
		jQuery::getResponse();
	}
	
	
}
