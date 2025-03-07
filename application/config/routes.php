<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Please see the user guide for complete details:
| https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|   $route['default_controller'] = 'welcome';
|   $route['404_override'] = 'errors/page_missing';
|   $route['translate_uri_dashes'] = FALSE;
|
*/

$route['default_controller'] = 'Register_Form_Controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// USER ROUTES
$route['Home'] = 'User/Home';
$route['Home2'] = 'User/Home2';
$route['Menu'] = 'User/Menu';
$route['TableBooking'] = 'User/TableBooking';
$route['login'] = 'Login/Login';
$route['forget'] = 'Login/Forget';
$route['register'] = 'Login/Register';

// ADMIN ROUTES
$route['dashboard'] = 'Admin/Dashboard';
$route['bookings'] = 'Admin/Bookings';
$route['offers'] = 'Admin/Offers';
$route['menus'] = 'Admin/Menus';
$route['profile'] = 'Admin/Profile';
$route['gallery'] = 'Admin/Gallery';
$route['table'] = 'Admin/Table';
$route['report'] = 'Admin/Report';

// ADMIN BACKEND URLS

$route['admin/save_offers'] = 'Admin/Add_offer';
$route['admin/get_offers'] = 'Admin/Get_offers';
$route['admin/delete_offer'] = 'Admin/Delete_offer';
$route['admin/get_offer_by_id'] = 'Admin/Get_offer_by_id';
$route['admin/update_offer'] = 'Admin/Update_offer';
$route['admin/changePasswordAdmin'] = 'Admin/ChangePasswordAdmin';
$route['admin/bill'] = 'Admin/Bill';
$route['admin/getcounts'] = 'Admin/GetCounts';
$route['admin/GetMenuCounts'] = 'Admin/GetMenuCounts';
$route['admin/GetBookingCounts'] = 'Admin/GetBookingCounts';






// AUTHENTICATION ROUTES
$route['auth/register_user'] = 'Auth/Register_user';
$route['auth/login'] = 'Auth/Login';
$route['auth/logout'] = 'Auth/Logout';
$route['auth/request_otp'] = 'Auth/Request_otp';
$route['auth/verify_otp_forget'] = 'Auth/Verify_otp_forget';
$route['auth/reset_password'] = 'Auth/Reset_password';

// PROFILE ROUTES
$route['userprofile'] = 'UserProfile/Profile';
$route['userbookings'] = 'UserProfile/Booking';
$route['userhistory'] = 'UserProfile/History';
$route['User/getUserInfo'] = 'UserProfile/GetUserInfo';
$route['user/get_offers'] = 'User/Get_offers';
$route['user/updateProfileImage'] = 'UserProfile/UpdateProfileImage';
$route['user/updateProfile'] = 'UserProfile/UpdateProfile';
$route['user/changePassword'] = 'UserProfile/changePassword';

// MENU ROUTES
$route['addMenu'] = 'MenuController/AddMenu';
$route['editMenu'] = 'MenuController/EditMenu';
$route['deleteMenu/(:any)'] = 'MenuController/DeleteMenu/$1';
$route['getSingleMenu'] = 'MenuController/GetSingleMenu';
$route['addCategory'] = 'MenuController/AddCategory';
$route['deleteCategory'] = 'MenuController/DeleteCategory';
$route['editCategory'] = 'MenuController/EditCategory';

// GALLERY ROUTES
$route['gallery'] = 'GalleryController/FetchGalleryImages';
$route['addGalleryImg'] = 'GalleryController/UploadGalleryImages';
$route['deleteGalleryImg/(:any)'] = 'GalleryController/DeleteGalleryImage/$1';
$route['getImages'] = 'GalleryController/GetImages';
$route['getFeedbacks'] = 'GalleryController/GetFeedback';




//routes for the tables 
$route['getAreas'] = 'TablesController/GetAreas';
$route['addTable'] = 'TablesController/AddTable';

// BOOKING ROUTES
$route['getAvailableTables'] = 'BookingController/GetAvailableTables';
$route['createBooking'] = 'BookingController/CreateBooking';
$route['getBookingData'] = 'BookingController/GetBookingData';
$route['approveBooking'] = 'BookingController/ApproveBooking';
$route['submitFeedback'] = 'BookingController/SubmitFeedback';
// get the booking of the logged in user
$route['user/getBookings'] = 'BookingController/GetBookings';
$route['notifications'] = 'Notification/Fetch';
$route['notifications_markread'] = 'Notification/Mark_read';


// ROUTES FOR INVOICE
$route['user/createInvoice'] = 'InvoiceController/CreateInvoice';
$route['admin/bill'] = 'Admin/Bill';
$route['admin/getRevenueData'] = 'InvoiceController/GetRevenueData';
$route['admin/getInvoicesByDateRange'] = 'InvoiceController/GetInvoicesByDateRange';

 

