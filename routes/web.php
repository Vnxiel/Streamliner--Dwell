<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\External\MainController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\SuperAdmin\SuperAdminFunctionController;
use App\Http\Controllers\SuperAdmin\SuperAdminMainController;
use App\Http\Controllers\SuperAdmin\SuperAdminBookingController;
use App\Http\Controllers\SuperAdmin\SuperAdminPdfController;
use App\Http\Controllers\Client\ClientFunctionController;
use App\Http\Controllers\Client\ClientMainController;
use App\Http\Controllers\Client\ClientBookingController;
use App\Http\Controllers\Client\ClientPdfController;
use App\Http\Controllers\Client\ClientRatingController;
use App\Http\Controllers\AdminGH\AdminGHMainController;
use App\Http\Controllers\AdminGH\AdminGHBookingController;
use App\Http\Controllers\AdminGH\AdminGHFunctionController;
use App\Http\Controllers\AdminGH\AdminGHPreReservationController;
use App\Http\Controllers\AdminGH\AdminGHPdfController;
use App\Http\Controllers\AdminSH\AdminSHMainController;
use App\Http\Controllers\AdminSH\AdminSHBookingController;
use App\Http\Controllers\AdminSH\AdminSHFunctionController;
use App\Http\Controllers\AdminSH\AdminSHPreReservationController;
use App\Http\Controllers\AdminSH\AdminSHPdfController;
use App\Http\Controllers\AdminDFTC\AdminDFTCMainController;
use App\Http\Controllers\AdminDFTC\AdminDFTCBookingController;
use App\Http\Controllers\AdminDFTC\AdminDFTCFunctionController;
use App\Http\Controllers\AdminDFTC\AdminDFTCPreReservationController;
use App\Http\Controllers\AdminDFTC\AdminDFTCPdfController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(MainController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('/main/view-home', 'home');
    Route::get('/main/view-guesthouse-rooms', 'guestHouseRooms');
    Route::get('/main/view-staffhouse-rooms','staffHouseRooms');
    Route::get('/main/view-DFTC-rooms', 'dftcRooms');
    Route::get('/main/view-DFTC-halls', 'dftcHalls');
    Route::get('/get-guestHousePreBooking-detailsMain', 'getGuestHousePreBookingDetailsMain');
    Route::get('/get-staffHousePreBooking-detailsMain','getStaffHousePreBookingDetailsMain');
    Route::get('/get-dftcRoomPreBooking-detailsMain', 'getDftcRoomPreBookingDetailsMain');
    Route::get('/get-dftcHallPreBooking-detailsMain', 'getDftcRoomPreBookingDetailsMain');
});
Route::controller(RegisterController::class)->group(function(){
    Route::post('/register-client', 'registerClient');
    Route::post('/forgotPassword', 'forgotPassword');
});
Route::controller(LoginController::class)->group(function(){
    Route::post('/login-client', 'loginClient');
});
Route::group(['middleware' => 'LoginCheckSuperAdmin'], function () {
    Route::controller(SuperAdminMainController::class)->group(function(){
        Route::get('superAdmin/', 'index');
        Route::get('/superAdmin/view-home', 'goToHome');
        Route::get('/superAdmin/view-guesthouse-rooms', 'goToGuestHouseRooms');
        Route::get('/superAdmin/view-staffhouse-rooms', 'goToStaffHouseRooms');
        Route::get('/superAdmin/view-dftc-rooms', 'goToDftcRooms');
        Route::get('/superAdmin/view-dftc-halls', 'goToDftcHalls');
        Route::get('/superAdmin/view-guesthouse-form', 'goToGuestHousePreBooking');
        Route::get('/superAdmin/guestHouses-get-room-data', 'getRoomData1');
        Route::get('/superAdmin/staffHouse-get-room-data', 'getRoomDataStaffHouseBook1');
        Route::get('/superAdmin/DFTC/get-room-data', 'getRoomDataDftcBook1');
        Route::get('/superAdmin/DFTChall-get-room-data', 'getRoomDataDftcHallBook1');
        Route::get('/superAdmin/view-dftc-room-form', 'goToDftcPreBooking');
        Route::get('/superAdmin/view-staffhouse-form', 'goToStaffHousePreBooking');
        Route::get('/superAdmin/view-dftc-hall-form', 'goToDftcPreBookingHall');
        Route::post('/superAdmin/view-dftc-hall-form', 'goToDftcPreBookingHall');
        Route::post('/superAdmin/view-dftc-room-form', 'goToDftcPreBooking');
        Route::post('/superAdmin/view-guesthouse-form', 'goToGuestHousePreBooking');
        Route::post('/superAdmin/view-staffhouse-form', 'goToStaffHousePreBooking');
    });
    Route::controller(SuperAdminBookingController::class)->group(function(){
       Route::post('/superAdmin/guestHouse-booking', 'storeGuestHouseBooking');
       Route::post('/superAdmin/staffHouse-booking', 'storeStaffHouseBooking');
       Route::post('/superAdmin/booking-dftc', 'storeDftcBooking');
       Route::post('/superAdmin/booking-dftcHall', 'storeDftcHallBooking');
       Route::post('/superAdmin/updateGuestHouseBooking', 'storeEditGuestHouseBooking');
       Route::post('/superAdminDeleteBookingGuestHouse', 'deleteGuestHouseBooking');
       Route::post('/superAdmin/updateStaffHouseBooking', 'storeEditStaffHouseBooking');
       Route::post('/superAdminDeleteBookingStaffHouse', 'deleteStaffHouseBooking');
       Route::post('/superAdmin/updateDftcRoomBooking', 'storeEditDftcRoomBooking');
       Route::post('/superAdminDeleteBookingDftc', 'deleteDftcBooking');
       Route::post('/superAdmin/updateDftcHallBooking', 'storeEditDftcHallBooking');
       Route::post('/superAdmin/cancelGuestHouseBooking' , 'cancelGuestHouseBooking');
       Route::post('/superAdmin/cancelStaffHouseBooking' , 'cancelStaffHouseBooking');
       Route::post('/superAdmin/cancelDftcRoomBooking' , 'cancelDftcBooking');
       Route::get('/superAdmin/getGuestHousePreBookingsDetails', 'getGuestHousePreBookingDetails');
       Route::get('/superAdmin/getStaffHousePreBookingsDetails', 'getStaffHousePreBookingDetails');
       Route::get('/superAdmin/getDftcRoomPreBookingsDetails', 'getDftcRoomPreBookingDetails');
       Route::get('/superAdmin/getDftcHallPreBookingsDetails', 'getDftcRoomPreBookingDetails');
    });
    Route::controller(SuperAdminFunctionController::class)->group(function(){
        Route::get('superAdmin/', 'index');
        Route::get('superAdminDashboard', 'goToDashboard');
        Route::get('superAdminDashboardGraphs', 'goToViewDashBoardGraphs');
        Route::get('superAdmin/view-create-room', 'goToAddRoom');
        Route::get('/logoutSuperAdmin', 'logoutSuperAdmin');
        Route::post('/superAdmin/createRoom', 'addRoom');
        Route::get('/superAdmin/view-guesthouse-preservations', 'goToViewGuestHouseBooking');
        Route::get('/superAdmin/view-staffhouse-preservations', 'goToViewStaffHouseBooking');
        Route::get('/superAdmin/editGuestHouse-get-room-data', 'getRoomDataEditGuestHouse');
        Route::get('/superAdmin/editStaffHouse-get-room-data', 'getRoomDataEditStaffHouse');
        Route::get('/superAdmin/view-DFTC-preservations' , 'goToViewDftcRoomBooking');
        Route::get('/superAdmin/editDftcRoom-get-room-data' , 'getRoomDataEditDftcRoom');
        Route::get('/superAdmin/editDftcHall-get-room-data', 'getRoomDataEditDftcHall');
        Route::get('/superAdmin/view-rooms', 'goToViewRooms');
        Route::post('/superAdmin/updateRoom', 'updateRoom');
        Route::post('/superAdmin/deleteRoom', 'deleteRoom');
        Route::get('/superAdmin/view-guesthouse-history', 'goToGuestHouseHistory');
        Route::get('/superAdmin/view-staffhouse-history', 'goToStaffHouseHistory');
        Route::get('/superAdmin/view-DFTC-history', 'goToDftcHistory');
        Route::get('/superAdmin/view-clients', 'goToClients');
        Route::post('/superAdmin/deactivateClient', 'deactivateClient');
        Route::post('/superAdmin/activateClient', 'activateClient');
        Route::post('/superAdmin/setPermissionClient', 'setPermissionClient');
        Route::get('/superAdmin/view-account', 'goToViewAccount');
        Route::post('/superAdmin/edit-account' , 'editAccount');
        Route::get('/superAdmin/view-activity-logs' , 'goToActivityLogs');
        Route::get('/superAdmin/view-guesthouse-canceled-preservations', 'goToVoidGuestHouseBookings');
        Route::get('/superAdmin/view-staffhouse-canceled-preservations' ,'goToVoidStaffHouseBookings');
        Route::get('/superAdmin/view-DFTC-canceled-preservations', 'goToVoidDftcBookings');
        Route::get('/superAdmin/view-guesthouse-rejected-preservations', 'goToRejectedGuestHouseBooking');
        Route::get('/superAdmin/view-staffhouse-rejected-preservations', 'goToRejectedStaffHouseBooking');
        Route::get('/superAdmin/view-DFTC-rejected-preservations', 'goToRejectedDftcBooking');
    });
    Route::controller(SuperAdminPdfController::class)->group(function () {
        Route::get('generateGuestHousePdfReport', 'generateReportGuestHouseBooking');
        Route::get('goToGuestHouseReport', 'goToGenerateReportGuestHouseBooking');
        Route::get('generateStaffHousePdfReport', 'generateReportStaffHouseBooking');
        Route::get('generateDftcPdfReport', 'generateReportDftcBooking');
        Route::get('generateGuestHouseHistoryPdfReport', 'generateReportGuestHouseHistory');
        Route::get('generateStaffHouseHistoryPdfReport', 'generateReportStaffHouseHistory');
        Route::get('generateDftcHistoryPdfReport', 'generateReportDftcHistory');
        Route::post('/superAdmin/generateClientGuestHousePdfForm', 'generateClientGuestHouseBooking');
        Route::post('/superAdmin/generateClientStaffHousePdfForm', 'generateClientStaffHouseBooking');
        Route::post('/superAdmin/generateClientDftcPdfForm', 'generateClientDftcBooking');
    });
});
Route::group(['middleware' => 'LoginCheckAdminGH'], function () {
    Route::controller(AdminGHMainController::class)->group(function(){
        Route::get('adminGH/', 'index');
        Route::get('/logoutAdminGH', 'logoutAdminGH');
        Route::get('/adminGH/view-home', 'goToHome');
        Route::get('/adminGH/view-guesthouse-rooms' , 'goToGuestHouseRooms');
        Route::get('/adminGH/view-staffhouse-rooms' ,'goToStaffHouseRooms');
        Route::get('/adminGH/view-DFTC-rooms' , 'goToDftcRooms');
        Route::get('/adminGH/view-DFTC-halls', 'goToDftcHalls');
        Route::get('/adminGH/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBookingAdminGH');
        Route::get('/get-room-dataGuestHouseAdminGH', 'getRoomDataGuestHouseAdminGH');
        Route::post('/adminGH/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBookingAdminGH');
        Route::get('/adminGH/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBookingAdminGH');
        Route::post('/adminGH/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBookingAdminGH');
        Route::get('/get-room-dataStaffHouseAdminGH' , 'getRoomDataStaffHouseAdminGH');
        Route::get('/adminGH/view-DFTC-room-pre-reservation-form','goToDftcRoomPreBookingAdminGH');
        Route::post('/adminGH/view-DFTC-room-pre-reservation-form', 'goToDftcRoomPreBookingAdminGH');
        Route::get('/get-room-dataDftcRoomAdminGH','getRoomDataDftcRoomAdminGH');
        Route::get('/adminGH/view-DFTC-hall-pre-reservation-form','goToDftcHallPreBookingAdminGH');
        Route::post('/adminGH/view-DFTC-hall-pre-reservation-form', 'goToDftcHallPreBookingAdminGH');
        Route::get('/get-room-dataDftcHallAdminGH','getRoomDataDftcHallAdminGH');
        Route::get('/get-room-data-editAdminGH','getRoomGuestHouseEditAdminGH');
        Route::get('/get-room-data-editStaffHouseAdminGH','getRoomStaffHouseEditAdminGH');
        Route::get('/get-room-dataEditDftcRoomAdminGH','getRoomDftcRoomEditAdminGH');
        Route::get('/get-room-dataEditDftcHallAdminGH', 'getRoomDftcHallEditAdminGH');
    });
    Route::controller(AdminGHBookingController::class)->group(function(){
        Route::get('/get-guestHousePreBooking-detailsAdminGH', 'getGuestHousePreBookingDetailsAdminGH');
        Route::get('/get-staffHousePreBooking-detailsAdminGH','getStaffHousePreBookingDetailsAdminGH');
        Route::get('/get-dftcRoomPreBooking-detailsAdminGH', 'getDftcRoomPreBookingDetailsAdminGH');
        Route::get('/get-dftcHallPreBooking-detailsAdminGH', 'getDftcRoomPreBookingDetailsAdminGH');
        Route::post('/adminGHBookingGuestHouse', 'storeGuestHouseBookingAdminGH');
        Route::post('/adminGHnBookingStaffHouse', 'storeStaffHouseBookingAdminGH');
        Route::post('/adminGHBookingDftc','storeDftcRoomBookingAdminGH');
        Route::post('/adminGHBookingDftcHall','storeDftcHallBookingAdminGH');
        Route::post('/adminGHEditBookingGuestHouse','storeEditGuestHouseBookingAdminGH');
        Route::post('/adminGHEditBookingStaffHouse','storeEditStaffHouseBookingAdminGH');
        Route::post('/adminGHEditBookingDftcRoom','storeEditDftcRoomBookingAdminGH');
        Route::post('/adminGHEditBookingDftcHall','storeEditDftcHallBookingAdminGH');
        Route::get('/guestHousePendingBookingRefresh', 'getGuestHousePendingBookings');
    });
    Route::controller(AdminGHFunctionController::class)->group(function(){
        Route::get('/adminGH/view-dashboard', 'goToDashboardAdminGH');
        Route::get('/adminGH/view-rooms', 'goToRooms');
        Route::post('/adminGHUpdateRoom','editRoomAdminGH');
        Route::post('/adminGHDeleteRoom','deleteRoomAdminGH');
        Route::get('/adminGH/create-room', 'goToAddRoomAdminGH');
        Route::post('/adminGH/add-room-adminGH','addRoomAdminGH');
        Route::get('/adminGH/view-ongoing-guesthouse-pre-reservations', 'viewGuestHouseBookingAdminGH');
        Route::get('adminGH/view-pending-guesthouse-pre-reservations', 'viewGuestHousePendingBookingAdminGH');
        Route::post('/adminGH/adminGHStatusClientBooking', 'updateGuestHouseBookingStatusAdminGH');
        Route::get('/adminGH/view-guesthouse-history', 'goToGuestHouseBookingHistoryAdminGH');
        Route::get('/adminGH/view-canceled-pre-reservations', 'goToCanceledBookingsAdminGH');
        Route::get('/adminGH/view-rejected-pre-reservations', 'goToRejectedBookingsAdminGH');
        Route::get('/adminGH/view-account','goToAccountAdminGH');
        Route::post('/adminGH/adminGHEditAccount','editAdminGHAccount');
        Route::post('/adminGHCheckClientBooking','updateCheckOut');
    });
    Route::controller(AdminGHPreReservationController::class)->group(function(){
        Route::get('/adminGH/view-my-ongoing-guesthouse-pre-reservations', 'goToAdminGhPreReservation');
        Route::post('/adminGHCancelBookingGuestHouse', 'cancelGuestHouseBookingsAdminGH');
        Route::get('/adminGH/view-my-ongoing-staffhouse-pre-reservations', 'goToAdminGhPreReservationStaffHouse');
        Route::post('/adminGHCancelBookingStaffHouse','cancelStaffHouseBookingsAdminGH');
        Route::get('/adminGH/view-my-ongoing-DFTC-pre-reservations', 'goToAdminGHDftcReservation');
        Route::post('/adminGHCancelBookingDftc','cancelDftcBookingsAdminGH');
        Route::get('/adminGH/view-my-guesthouse-history', 'goToAdminGuestHouseHistory');
        Route::get('/adminGH/view-my-staffhouse-history', 'goToAdminStaffHouseHistory');
        Route::get('/adminGH/view-my-DFTC-history', 'goToAdminGHDftcHistory');
        Route::get('/adminGH/view-my-guesthouse-canceled-pre-reservations', 'goToAdminGHCanceledBookingsGuestHouse');
        Route::get('/adminGH/view-my-guesthouse-rejected-pre-reservations', 'goToAdminGHRejectedBookingsGuestHouse');
        Route::get('/adminGH/view-my-staffhouse-canceled-pre-reservations', 'goToAdminGHCanceledBookingsStaffHouse');
        Route::get('/adminGH/view-my-staffhouse-rejected-pre-reservations' , 'goToAdminGHRejectedBookingsStaffHouse');
        Route::get('/adminGH/view-my-DFTC-canceled-pre-reservations', 'goToAdminGHCanceledBookingsDftc');
        Route::get('/adminGH/view-my-DFTC-rejected-pre-reservations', 'goToAdminGHRejectedBookingsDftc');
    });
    Route::controller(AdminGHPdfController::class)->group(function(){
        Route::post('/adminGH/adminGHStaffHouseBookingPdf-form', 'generateGuestHousePdfAdminGH');
        Route::post('/adminGH/AdminGHStaffHouseBookingPdf-form' , 'generateStaffHousePdfAdminGH');
        Route::post('/adminGH/adminGHDftcBookingPdf-form', 'generateDftcBookingAdminGH');
    });
});
Route::group(['middleware' => 'LoginCheckAdminSH'], function () {
    Route::controller(AdminSHMainController::class)->group(function(){
        Route::get('adminSH/','index');
        Route::get('/adminSH/view-home' , 'goToHome');
        Route::get('/adminSH/view-guesthouse-rooms' , 'goToGuestHouseRoomsAdminSH');
        Route::get('/adminSH/view-staffhouse-rooms','goToStaffHouseRoomsAdminSH');
        Route::get('/adminSH/view-DFTC-rooms', 'goToDftcRoomsAdminSH');
        Route::get('/adminSH/view-DFTC-halls', 'goToDftcHallsAdminSH');
        Route::get('/adminSH/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBookingAdminSH');
        Route::post('/adminSH/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBookingAdminSH');
        Route::get('/get-room-dataGuestHouseAdminSH','getRoomDataGuestHouseAdminSH');
        Route::get('/adminSH/view-staffhouse-pre-reservation-form','goToStaffHousePreBookingAdminSH');
        Route::post('/adminSH/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBookingAdminSH');
        Route::get('/get-room-dataStaffHouseAdminSH', 'getRoomDataStaffHouseAdminSH');
        Route::get('/adminSH/view-DFTC-room-pre-reservation-form', 'goToDftcRoomPreBookingAdminSH');
        Route::post('/adminSH/view-DFTC-room-pre-reservation-form', 'goToDftcRoomPreBookingAdminSH');
        Route::get('/get-room-dataDftcRoomAdminSH', 'getRoomDataDftcRoomAdminSH');
        Route::get('/adminSH/view-DFTC-hall-pre-reservation-form', 'goToDftcHallPreBookingAdminSH');
        Route::post('/adminSH/view-DFTC-hall-pre-reservation-form', 'goToDftcHallPreBookingAdminSH');
        Route::get('/get-room-dataDftcHallAdminSH', 'getRoomDataDftcHallAdminSH');
        Route::get('/get-room-data-editAdminSH','getRoomGuestHouseEditAdminSH');
        Route::get('/get-room-data-editStaffHouseAdminSH', 'getRoomStaffHouseEditAdminSH');
        Route::get('/get-room-dataEditDftcRoomAdminSH','getRoomDftcRoomEditAdminSH');
        Route::get('/get-room-dataEditDftcHallAdminSH', 'getRoomDftcHallEditAdminSH');
        Route::get('/logoutAdminSH', 'logoutAdminSH');
    });
    Route::controller(AdminSHBookingController::class)->group(function(){
        Route::get('/get-guestHousePreBooking-detailsAdminSH', 'getGuestHousePreBookingDetailsAdminSH');
        Route::get('/get-staffHousePreBooking-detailsAdminSH','getStaffHousePreBookingDetailsAdminSH');
        Route::get('/get-dftcRoomPreBooking-detailsAdminSH','getDftcRoomPreBookingDetailsAdminSH');
        Route::get('/get-dftcHallPreBooking-detailsAdminSH', 'getDftcRoomPreBookingDetailsAdminSH');
        Route::post('/adminSHBookingGuestHouse','storeGuestHouseBookingAdminSH');
        Route::post('/adminSHBookingStaffHouse','storeStaffHouseBookingAdminSH');
        Route::post('/adminSHBookingDftc','storeDftcRoomBookingAdminSH');
        Route::post('/adminSHBookingDftcHall', 'storeDftcHallBookingAdminSH');
        Route::post('/adminSHEditBookingGuestHouse','storeEditGuestHouseBookingAdminSH');
        Route::post('/adminSHEditBookingStaffHouse','storeEditStaffHouseBookingAdminSH');
        Route::post('/adminSHEditBookingDftcRoom', 'storeEditDftcRoomBookingAdminSH');
        Route::post('/adminSHEditBookingDftcHall', 'storeEditDftcHallBookingAdminSH');
        Route::get('/staffHousePendingBookingRefresh', 'getStaffHousePendingBookings');
        Route::get('/getStaffHouseBookingDetailsAdminSH', 'getStaffHouseBookingDetailsAdminSH');
    });
    Route::controller(AdminSHFunctionController::class)->group(function(){
        Route::get('adminSH/view-dashboard', 'goToDashboardAdminSH');
        Route::post('/adminSH/add-room-adminSH', 'addRoomAdminSH');
        Route::get('/adminSH/view-rooms', 'goToRooms');
        Route::get('/adminSH/create-room', 'goToAddRoomAdminSH');
        Route::post('adminSHUpdateRoom', 'editRoomAdminSH');
        Route::post('/adminSHDeleteRoom','deleteRoomAdminSH');
        Route::get('/adminSH/view-ongoing-staffhouse-pre-reservations','viewStaffHouseBookingAdminSH');
        Route::get('/adminSH/view-pending-staffhouse-pre-reservations', 'viewStaffHousePendingBookingAdminSH');
        Route::post('/adminSH/adminSHStatusClientBooking','updateStaffHouseBookingStatusAdminSH');
        Route::get('/adminSH/view-staffhouse-history','goToStaffHouseBookingHistoryAdminSH');
        Route::get('/adminSH/view-canceled-pre-reservations','goToCanceledBookingsAdminSH');
        Route::get('/adminSH/view-rejected-pre-reservations','goToRejectedBookingsAdminSH');
        Route::get('/adminSH/view-account','goToAccountAdminSH');
        Route::post('/adminSH/adminSHEditAccount', 'editAdminSHAccount');
        Route::post('adminSHCheckClientBooking','updateCheckOut');
    });
    Route::controller(AdminSHPrereservationController::class)->group(function(){
        Route::get('/adminSH/view-my-ongoing-guesthouse-pre-reservations','goToAdminSHGuestHousePreReservation');
        Route::post('/AdminSHCancelBookingGuestHouse', 'cancelGuestHouseBookingsAdminSH');
        Route::get('/adminSH/view-my-ongoing-staffhouse-pre-reservations', 'goToPreReservationStaffHouseAdminSH');
        Route::post('/adminSHCancelBookingStaffHouse', 'cancelStaffHouseBookingsAdminSH');
        Route::get('/adminSH/view-my-ongoing-DFTC-pre-reservations','goToDftcReservationAdminSH');
        Route::post('/adminSHCancelBookingDftc', 'cancelDftcBookingsAdminSH');
        Route::get('/adminSH/view-my-guesthouse-history', 'goToAdminSHGuestHouseHistory');
        Route::get('/adminSH/view-my-staffhouse-history','goToAdminSHStaffHouseHistory');
        Route::get('/adminSH/view-my-DFTC-history','goToAdminSHDftcHistory');
        Route::get('/adminSH/view-my-guesthouse-canceled-pre-reservations', 'goToAdminSHCanceledBookingsGuestHouse');
        Route::get('/adminSH/view-my-guesthouse-rejected-pre-reservations', 'goToAdminSHRejectedBookingsGuestHouse');
        Route::get('/adminSH/view-my-staffhouse-canceled-pre-reservations', 'goToAdminSHCanceledBookingsStaffHouse');
        Route::get('/adminSH/view-my-staffhouse-rejected-pre-reservations', 'goToAdminSHRejectedBookingsStaffHouse');
        Route::get('/adminSH/view-my-DFTC-canceled-pre-reservations', 'goToAdminSHCanceledBookingsDftc');
        Route::get('/adminSH/view-my-DFTC-rejected-pre-reservations', 'goToAdminSHRejectedBookingsDftc');
    });
    Route::controller(AdminSHPdfController::class)->group(function(){
        Route::post('/adminSH/adminSHGuestHouseBookingPdf-form', 'generateGuestHousePdfAdminGH');
        Route::post('/adminSH/AdminSHStaffHouseBookingPdf-form', 'generateStaffHousePdfAdminSH');
        Route::post('/adminSH/adminSHDftcBookingPdf-form','generateDftcBookingAdminSH');
    });
});
Route::group(['middleware' => 'LoginCheckAdminDftc'], function () {
    Route::controller(AdminDFTCMainController::class)->group(function(){
        Route::get('adminDftc/', 'index');
        Route::get('adminDFTC/view-home', 'goToHome');
        Route::get('/adminDFTC/view-guesthouse-rooms', 'goToGuestHouseRoomsAdminDftc');
        Route::get('/adminDFTC/view-staffhouse-rooms','goToStaffHouseRoomsAdminDftc');
        Route::get('/adminDFTC/view-DFTC-rooms', 'goToDftcRoomsAdminDftc');
        Route::get('/adminDFTC/view-DFTC-halls','goToDftcHallsAdminDftc');
        Route::get('/adminDFTC/view-guesthouse-pre-reservation-form','goToGuestHousePreBookingAdminDftc');
        Route::post('/adminDFTC/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBookingAdminDftc');
        Route::get('/get-room-dataGuestHouseAdminDftc','getRoomDataGuestHouseAdminDftc');
        Route::get('/adminDFTC/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBookingAdminDftc');
        Route::post('/adminDFTC/view-staffhouse-pre-reservation-form','goToStaffHousePreBookingAdminDftc');
        Route::get('/get-room-dataStaffHouseAdminDftc','getRoomDataStaffHouseAdminDftc');
        Route::get('/adminDFTC/view-DFTC-room-pre-reservation-form', 'goToDftcRoomPreBookingAdminDftc');
        Route::post('/adminDFTC/view-DFTC-room-pre-reservation-form', 'goToDftcRoomPreBookingAdminDftc');
        Route::get('/get-room-dataDftcRoomAdminDftc','getRoomDataDftcRoomAdminDftc', '');
        Route::get('/adminDFTC/view-DFTC-hall-pre-reservation-form', 'goToDftcHallPreBookingAdminDftc');
        Route::post('/adminDFTC/view-DFTC-hall-pre-reservation-form','goToDftcHallPreBookingAdminDftc');
        Route::get('/get-room-dataDftcHallAdminDftc','getRoomDataDftcHallAdminDftc');
        Route::get('/get-room-data-editAdminDftc','getRoomGuestHouseEditAdminDftc');
        Route::get('/get-room-data-editStaffHouseAdminDftc','getRoomStaffHouseEditAdminDftc');
        Route::get('/get-room-dataEditDftcRoomAdminDftc','getRoomDftcRoomEditAdminDftc');
        Route::get('/get-room-dataEditDftcHallAdminDftc','getRoomDftcHallEditAdminDftc');
        Route::get('/logoutAdminDftc','logoutAdminDftc');
    });
    Route::controller(AdminDFTCBookingController::class)->group(function(){
        Route::get('/get-guestHousePreBooking-detailsAdminDftc', 'getGuestHousePreBookingDetailsAdminDftc');
        Route::get('/get-staffHousePreBooking-detailsAdminDftc', 'getStaffHousePreBookingDetailsAdminDftc');
        Route::get('/get-dftcRoomPreBooking-detailsAdminDftc','getDftcRoomPreBookingDetailsAdminDftc');
        Route::get('/get-dftcHallPreBooking-detailsAdminDftc', 'getDftcRoomPreBookingDetailsAdminDftc');
        Route::post('/adminDftcBookingGuestHouse', 'storeGuestHouseBookingAdminDftc');
        Route::post('/adminDftcBookingStaffHouse','storeStaffHouseBookingAdminDftc');
        Route::post('/adminDftcBookingDftc','storeDftcRoomBookingAdminDftc');
        Route::post('/adminDftcBookingDftcHall','storeDftcHallBookingAdminDftc');
        Route::post('/adminDftcEditBookingGuestHouse', 'storeEditGuestHouseBookingAdminDftc');
        Route::post('/adminDftcEditBookingStaffHouse','storeEditStaffHouseBookingAdminDftc');
        Route::post('/adminDftcEditBookingDftcRoom','storeEditDftcRoomBookingAdminDftc');
        Route::post('/adminDftcEditBookingDftcHall', 'storeEditDftcHallBookingAdminDftc');
        Route::get('/dftcPendingBookingRefresh', 'getDFTCPendingBookings');
    });
    Route::controller(AdminDFTCFunctionController::class)->group(function(){
        Route::get('/adminDFTC/view-dashboard', 'goToDashboardAdminDftc');
        Route::get('/adminDFTC/view-rooms', 'goToRoomsDftc');
        Route::post('/adminDftcUpdateRoom', 'editRoomAdminDftc');
        Route::post('/adminDftcDeleteRoom', 'deleteRoomAdminDftc');
        Route::get('/adminDFTC/create-room', 'goToAddRoomAdminDftc');
        Route::post('/adminDFTC/add-room-adminDftc', 'addRoomAdminAdminDftc');
        Route::get('/adminDFTC/view-ongoing-DFTC-pre-reservations', 'viewDftcBookingAdminDftc');
        Route::get('/adminDFTC/view-pending-DFTC-pre-reservations', 'viewDftcPendingBookingAdminDftc');
        Route::post('/adminDFTC/adminDftcStatusClientBooking', 'updateDftcBookingStatusAdminDftc');
        Route::get('/adminDFTC/view-DFTC-history', 'viewDftcBookingHistoryAdminDftc');
        Route::get('/adminDFTC/view-canceled-pre-reservations', 'goToCanceledBookingsAdminDftc');
        Route::get('/adminDFTC/view-rejected-pre-reservations', 'goToRejectedBookingsAdminDftc');
        Route::get('/adminDFTC/view-account', 'goToAccountAdminDftc');
        Route::post('/adminDFTC/adminDftcEditAccount', 'editAdminDftcAccount');
        Route::post('/adminDftcCheckClientBooking', 'updateCheckOut');
    });
    Route::controller(AdminDFTCPreReservationController::class)->group(function(){
        Route::get('/adminDFTC/view-my-ongoing-guesthouse-pre-reservations', 'goToAdminDftcPreReservation');
        Route::post('/AdminDftcCancelBookingGuestHouse','cancelGuestHouseBookingsAdminDftc');
        Route::get('/adminDFTC/view-my-ongoing-staffhouse-pre-reservations', 'goToPreReservationStaffHouseAdminDftc');
        Route::post('/adminDftcCancelBookingStaffHouse','cancelStaffHouseBookingsAdminDftc');
        Route::get('/adminDFTC/view-my-ongoing-DFTC-pre-reservations', 'goToDftcReservationAdminDftc');
        Route::post('/adminDftcCancelBookingDftc','cancelDftcBookingsAdminDftc');
        Route::get('/adminDFTC/view-my-guesthouse-history', 'goToAdminDftcGuestHouseHistory');
        Route::get('/adminDFTC/view-my-staffhouse-history', 'goToAdminDftcStaffHouseHistory');
        Route::get('/adminDFTC/view-my-DFTC-history', 'goToAdminDftcDftcHistory');
        Route::get('/adminDFTC/view-my-guesthouse-canceled-pre-reservations', 'goToAdminDftcCanceledBookingsGuestHouse');
        Route::get('/adminDFTC/view-my-guesthouse-rejected-pre-reservations', 'goToAdminDftcRejectedBookingsGuestHouse');
        Route::get('/adminDFTC/view-my-staffhouse-canceled-pre-reservations', 'goToAdminDftcCanceledBookingsStaffHouse');
        Route::get('/adminDFTC/view-my-staffhouse-rejected-pre-reservations', 'goToAdminDftcRejectedBookingsStaffHouse');
        Route::get('/adminDFTC/view-my-DFTC-canceled-pre-reservations', 'goToAdminDftcCanceledBookingsDftc');
        Route::get('/adminDFTC/view-my-DFTC-rejected-pre-reservations', 'goToAdminDftcRejectedBookingsDftc');
    });
    Route::controller(AdminDFTCPdfController::class)->group(function(){
        Route::post('/adminDFTC/adminDftcGuestHouseBookingPdf-form', 'generateGuestHousePdfAdminDftc');
        Route::post('/adminDFTC/AdminDftcStaffHouseBookingPdf-form', 'generateStaffHousePdfAdminDftc');
        Route::post('/adminDFTC/adminDftcDftcBookingPdf-form','generateDftcBookingAdminDftc');
    });
});
Route::group(['middleware' => 'LoginCheckCustomer'], function () {
    Route::controller(ClientFunctionController::class)->group(function(){
        Route::get('client/', 'index');
        Route::get('/logoutCustomer', 'logoutCustomer');
        Route::get('/client/view-guesthouse-prereservations', 'goToGuestHouseReservation');
        Route::get('/get-room-data-editClient', 'getRoomDataEditGuestHouseClient');
        Route::get('/client/view-staffhouse-prereservations', 'goToStaffHouseReservation');
        Route::get('/get-room-data-editStaffHouseClient' , 'getRoomDataEditStaffHouseClient');
        Route::get('/client/view-DFTC-prereservations', 'goToDftcReservation');
        Route::get('/get-room-dataEditDftcRoomClient' , 'getRoomDataEditDftcClient');
        Route::get('/get-room-dataEditDftcHallClient', 'getRoomDataEditDftcHallClient');
        Route::get('/client/view-guesthouse-history' , 'goToGuestHouseHistoryClient');
        Route::get('/client/view-staffhouse-history' , 'goToStaffHouseHistoryClient');
        Route::get('/client/view-DFTC-history' , 'goToDftcHistoryClient');
        Route::get('/client/view-guesthouse-canceled-preservations' , 'goToGuestHouseCanceledBookings');
        Route::get('/client/view-guesthouse-rejected-preservations' , 'goToGuestHouseRejectedBookings');
        Route::get('/client/view-staffhouse-canceled-preservations' , 'goToStaffHouseCanceledBookings');
        Route::get('/client/view-staffhouse-rejected-preservations' , 'goToStaffHouseRejectedBookings');
        Route::get('/client/view-DFTC-canceled-preservations' , 'goToDftcCanceledBookings');
        Route::get('/client/view-DFTC-rejected-preservations' , 'goToDftcRejectedBookings');
        Route::get('/client/view-account','goToViewAccount');
        Route::post('/clientEditAccount', 'editAccountClient');
        Route::post('/clientDeactivateAccount', 'deactivateAccount');
        Route::post('/clientActivateAccount', 'activateAccount');
    });
    Route::controller(ClientBookingController::class)->group(function(){
        Route::post('/clientBookingGuestHouse', 'storeGuestHouseBooking');
        Route::post('/clientBookingStaffHouse', 'storeStaffHouseBooking');
        Route::post('/clientBookingDftc', 'storeDftcBooking');
        Route::post('/clientBookingDftcHall', 'storeDftcHallBooking');
        Route::get('/get-guestHousePreBooking-detailsClient' , 'getGuestHousePreBookingDetailsClient');
        Route::get('/get-staffHousePreBooking-detailsClient' , 'getStaffHousePreBookingDetailsClient');
        Route::get('/get-dftcRoomPreBooking-detailsClient' , 'getDftcRoomPreBookingDetailsClient');
        Route::get('/get-dftcHallPreBooking-detailsClient' , 'getDftcRoomPreBookingDetailsClient');
        Route::post('/clientEditGuestHouseBooking' , 'storeEditGuestHouseBookingClient');
        Route::post('/clientDeleteGuestHouseBooking' , 'deleteGuestHouseBookingClient');
        Route::post('/ClientCancelBookingGuestHouse', 'cancelGuestHouseBookingClient');
        Route::post('/clientStaffHouseBookingEdit', 'storeEditStaffHouseBookingClient');
        Route::post('/ClientCancelBookingStaffHouse', 'cancelStaffHouseBookingClient');
        Route::post('/ClientEditBookingDftcRoom', 'storeEditDftcRoomBookingClient');
        Route::post('/clientEditBookingDftcHall' , 'storeEditDftcHallBookingClient');
        Route::post('/clientCancelBookingDftc' , 'cancelDftcBookingClient');
     });
    Route::controller(ClientMainController::class)->group(function(){
        Route::get('/client/view-home', 'goToHome');
        Route::get('/client/view-dashboard', 'goToDashboard');
        Route::get('/client/view-guesthouse-ratings', 'goToRatingsGuestHouse');
        Route::get('/client/view-staffhouse-ratings', 'goToRatingsStaffHouse');
        Route::get('/client/view-guesthouse-rooms', 'goToGuestHouseRooms');
        Route::get('/client/view-staffhouse-rooms', 'goToStaffHouseRooms');
        Route::get('/client/view-dftc-ratings','goToRatingsDftc');
        Route::get('/client/view-DFTC-rooms', 'goToDftcRooms');
        Route::get('/client/view-DFTC-halls', 'goToDftcHalls');
        Route::get('/client/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBooking');
        Route::get('/client/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBooking');
        Route::get('/client/view-DFTC-room-pre-reservation-form', 'goToDftcPreBooking');
        Route::get('/client/view-DFTC-hall-pre-reservation-form' , 'goToDftcPreBookingHall');
        Route::post('/client/view-guesthouse-pre-reservation-form', 'goToGuestHousePreBooking');
        Route::post('/client/view-staffhouse-pre-reservation-form', 'goToStaffHousePreBooking');
        Route::post('/client/view-DFTC-room-pre-reservation-form', 'goToDftcPreBooking');
        Route::post('/client/view-DFTC-hall-pre-reservation-form', 'goToDftcPreBookingHall');
        Route::get('/get-room-data', 'getRoomData');
        Route::get('/get-room-dataStaffHouse', 'getRoomDataStaffHouseBook');
        Route::get('/get-room-dataDftc', 'getRoomDataDftcBook');
        Route::get('/get-room-dataDftcHall', 'getRoomDataDftcHallBook');
    });
    Route::controller(ClientPdfController::class)->group(function(){
        Route::post('/client/clientGuestHouseBookingPdf-form', 'generateClientGuestHouseBookingForm');
        Route::post('/client/clientStaffHouseBookingPdf-form', 'generateClientStaffHouseBookingForm');
        Route::post('/client/clientDftcBookingPdf-form', 'generateClientDftcBookingClient');
    });
    Route::controller(ClientRatingController::class)->group(function(){
        Route::post('/clientRatingGuestHouseBooking', 'setRatingGuestHouse');
        Route::post('/clientRatingStaffHouseBooking', 'setRatingStaffHouse');
        Route::post('/clientRatingDftcBooking', 'setRatingDftc');
    });
});
