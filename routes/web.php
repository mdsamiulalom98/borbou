<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MaritalStatusController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\ComplexionController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\FamilyValueController;
use App\Http\Controllers\Admin\ReligiousValueController;
use App\Http\Controllers\Admin\FoodHabitController;
use App\Http\Controllers\Admin\DrinkingHabitController;
use App\Http\Controllers\Admin\SmokeHabitController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\WorkingController;
use App\Http\Controllers\Admin\HeightController;
use App\Http\Controllers\Admin\ProfileByController;
use App\Http\Controllers\Admin\SuccessController;
use App\Http\Controllers\Admin\ResultGradeController;
use App\Http\Controllers\Admin\CreatePageController;
use App\Http\Controllers\Admin\MemberManageController;
// frontend controllers
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Controllers\FrontEnd\MemberController;
use App\Http\Controllers\FrontEnd\DownloadController;

Route::get('/cc', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return "config cleared";
});
Route::get('/model', function () {
    Artisan::call('make:model PaymentDetails -m');
    return "model created";
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    return "model migrated";
});

// frontend routes
Route::group(['namespace' => 'FrontEnd'], function () {

    Route::get('/', [FrontEndController::class, 'home'])->name('home');
    Route::get('/adding', [FrontEndController::class, 'adding'])->name('adding');
    Route::get('/load-more', [FrontEndController::class, 'loadMorePosts'])->name('member.loadmore');
    Route::get('/search', [FrontEndController::class, 'searchPage'])->name('searchPage');
    Route::get('/member-details/{id}', [FrontEndController::class, 'singleDetails'])->name('member.details');
    Route::get('/page/{slug}', [FrontEndController::class, 'page'])->name('page.show');
    Route::get('/contact', [FrontEndController::class, 'contact'])->name('contact');
    Route::post('/contact-save', [FrontEndController::class, 'contactStore'])->name('contactinfosave');
    Route::get('/payment-success', [FrontEndController::class, 'payment_success'])->name('payment_success');
    Route::get('/payment-cancel', [FrontEndController::class, 'payment_cancel'])->name('payment_cancel');
    Route::get('livesearch', [FrontEndController::class, 'livesearch'])->name('livesearch');

    // register & login
    Route::get('/member/registration', [FrontEndController::class, 'register'])->name('member.register');
    Route::post('/member/register-post', [MemberController::class, 'register'])->name('member_register');
    Route::get('/member/register-missing', [FrontEndController::class, 'registermissingpage'])->name('member.registermissing');
    Route::post('/member/register-missing-post', [MemberController::class, 'registermissingstore'])->name('member_registermissing');
    Route::get('/member/verify', [MemberController::class, 'memberVerifyForm'])->name('verify_form');
    Route::post('member/verify-submit', [MemberController::class, 'memberVerify'])->name('verify_submit');
    Route::get('/member/login', [FrontEndController::class, 'login'])->name('member.login');
    Route::post('/member/login-post', [MemberController::class, 'login'])->name('member_login');

    Route::post('/resend/code/', [MemberController::class, 'resendcode'])->name('resendcode');
    Route::get('member/forgetpassword', [MemberController::class, 'forgotpassword'])->name('member.forgotpass');
    Route::post('member/forgetsubmit', [MemberController::class, 'forgotsubmit'])->name('member.forgotsubmit');

    Route::get('member/passwordreset', [MemberController::class, 'passresetpage'])->name('member.passresetpage');
    Route::post('member/passresetverify', [MemberController::class, 'passResetVerify'])->name('member.passresetverify');

    Route::get('/physical-datas', [MemberController::class, 'transferData']);
    Route::post('/add-to-wishlist', [DownloadController::class, 'add_to_wishlist'])->name('add_to_wishlist');
    Route::post('/wishlist-remove', [DownloadController::class, 'wishlist_remove'])->name('wishlist_remove');
    Route::get('/wishlist', [DownloadController::class, 'wishlist'])->name('wishlist');
    Route::get('/wishlist-count', [DownloadController::class, 'wishlist_count'])->name('wishlist.count');


    Route::get('member/download', [MemberController::class, 'download'])->name('member.download');
    Route::any('member/download-pdf', [MemberController::class, 'download_pdf'])->name('member.download_pdf');
    Route::post('member/delete-pdf', [MemberController::class, 'delete_pdf'])->name('member.delete_pdf');
    Route::get('member/photos', [MemberController::class, 'photo_load'])->name('photos.load');

    // message routes
    Route::post('member/conversation/create', [MemberController::class, 'conversation_create'])->name('member.conversation.create');
    Route::post('member/message/update', [MemberController::class, 'message_update'])->name('member.message.update');
    Route::get('member/message/reload', [MemberController::class, 'message_reload'])->name('member.message.reload');
    Route::get('member/message/header', [MemberController::class, 'message_header'])->name('member.message.header');
    Route::post('member/message/active', [MemberController::class, 'message_active'])->name('member.message.active');
    Route::post('member/message/remove-session', [MemberController::class, 'remove_session'])->name('member.remove.session');

});

Auth::routes();

// Member Validity Check ======

Route::group(['namespace' => 'frontEnd', 'prefix' => 'member', 'middleware' => ['member']], function () {
    // all protected routes here
    Route::get('/logout', [MemberController::class, 'logout'])->name('member.logout');
    Route::get('/profile-edit', [MemberController::class, 'editProfile'])->name('member.editprofile');
    Route::post('/profile-update', [MemberController::class, 'updateProfile'])->name('member.updateprofile');
    Route::get('/delete-image-one/{id}', [MemberController::class, 'deleteImageOne'])->name('member.delete.imageone');
    Route::get('/delete-image-two/{id}', [MemberController::class, 'deleteImageTwo'])->name('member.delete.imagetwo');
    Route::get('/delete-image-three/{id}', [MemberController::class, 'deleteImageThree'])->name('member.delete.imagethree');

    Route::get('/partner-expectation', [MemberController::class, 'partnerExpectation'])->name('member.partnerexp');
    Route::post('/partner-expectation-save', [MemberController::class, 'partnerExpectationStore'])->name('member.partnerexpsave');
    Route::post('/member_publish', [MemberController::class, 'member_publish'])->name('member.member_publish');
    Route::post('/make-premium', [MemberController::class, 'make_premium'])->name('member.make_premium');

    Route::get('/partner-expectation-edit', [MemberController::class, 'partnerExpectationEdit'])->name('member.partnerexpedit');
    Route::post('/partner-expectation-update', [MemberController::class, 'partnerExpectationUpdate'])->name('member.partnerexpupdate');

    Route::get('/payment-confirm', [DownloadController::class, 'payment_confirm'])->name('download.payment.confirm');
    Route::get('/download', [DownloadController::class, 'download'])->name('biodata.download');
    Route::post('biodata-info', [DownloadController::class, 'biodata_details'])->name('biodata.download.page');
    Route::get('wishlist', [MemberController::class, 'wishlist'])->name('member.wishlist');
    // messages
    Route::get('messages', [MemberController::class, 'message_page'])->name('member.messages');
    Route::get('conversation/{id}', [MemberController::class, 'conversation'])->name('member.conversation');
});

// ajax routes
Route::get('navigation-change', [FrontEndController::class, 'navigation_change'])->name('navigation.change');
Route::get('/ajax-education-degree', [MemberController::class, 'getDegrees']);
Route::get('/ajax-location-district', [MemberController::class, 'getDistricts']);
Route::get('/ajax-location-upazila', [MemberController::class, 'getUpazilas']);

// unathenticate route
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('locked', [DashboardController::class, 'locked'])->name('locked');
    Route::post('unlocked', [DashboardController::class, 'unlocked'])->name('unlocked');
});

// auth route
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'lock'], 'prefix' => 'admin'], function () {
    // order route
    Route::get('download', [MemberManageController::class, 'download'])->name('downloads.index');

    // member route
    Route::get('member', [MemberManageController::class, 'index'])->name('members.index');
    Route::get('member/manage', [MemberManageController::class, 'index'])->name('members.index');
    Route::get('member/new', [MemberManageController::class, 'new_member'])->name('members.new');
    Route::get('member/old', [MemberManageController::class, 'old_member'])->name('members.old');
    Route::get('member/{id}/edit', [MemberManageController::class, 'edit'])->name('members.edit');
    Route::post('member/update', [MemberManageController::class, 'update'])->name('members.update');
    Route::post('member/inactive', [MemberManageController::class, 'inactive'])->name('members.inactive');
    Route::post('member/active', [MemberManageController::class, 'active'])->name('members.active');
    Route::post('member/adminlog', [MemberManageController::class, 'adminlog'])->name('members.adminlog');
    Route::get('member/profile', [MemberManageController::class, 'profile'])->name('members.profile');
    Route::get('member/birthday', [MemberManageController::class, 'birthday'])->name('members.birthday');
    Route::get('member/birthday-today', [MemberManageController::class, 'todaybirthday'])->name('members.birthdaytoday');

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changepassword'])->name('change_password');
    Route::post('new-password', [DashboardController::class, 'newpassword'])->name('new_password');

    // users route
    Route::get('users/manage', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/save', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/active', [UserController::class, 'active'])->name('users.active');
    Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    // roles
    Route::get('roles/manage', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // permissions
    Route::get('permission/manage', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/{id}/show', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/save', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // settings route
    Route::get('settings/manage', [GeneralSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [GeneralSettingController::class, 'create'])->name('settings.create');
    Route::post('settings/save', [GeneralSettingController::class, 'store'])->name('settings.store');
    Route::get('settings/{id}/edit', [GeneralSettingController::class, 'edit'])->name('settings.edit');
    Route::post('settings/update', [GeneralSettingController::class, 'update'])->name('settings.update');
    Route::post('settings/inactive', [GeneralSettingController::class, 'inactive'])->name('settings.inactive');
    Route::post('settings/active', [GeneralSettingController::class, 'active'])->name('settings.active');
    Route::post('settings/destroy', [GeneralSettingController::class, 'destroy'])->name('settings.destroy');

    // settings route
    Route::get('social-media/manage', [SocialMediaController::class, 'index'])->name('socialmedias.index');
    Route::get('social-media/create', [SocialMediaController::class, 'create'])->name('socialmedias.create');
    Route::post('social-media/save', [SocialMediaController::class, 'store'])->name('socialmedias.store');
    Route::get('social-media/{id}/edit', [SocialMediaController::class, 'edit'])->name('socialmedias.edit');
    Route::post('social-media/update', [SocialMediaController::class, 'update'])->name('socialmedias.update');
    Route::post('social-media/inactive', [SocialMediaController::class, 'inactive'])->name('socialmedias.inactive');
    Route::post('social-media/active', [SocialMediaController::class, 'active'])->name('socialmedias.active');
    Route::post('social-media/destroy', [SocialMediaController::class, 'destroy'])->name('socialmedias.destroy');

    // settings route
    Route::get('contact/manage', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::post('contact/save', [ContactController::class, 'store'])->name('contact.store');
    Route::get('contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('contact/update', [ContactController::class, 'update'])->name('contact.update');
    Route::post('contact/inactive', [ContactController::class, 'inactive'])->name('contact.inactive');
    Route::post('contact/active', [ContactController::class, 'active'])->name('contact.active');
    Route::post('contact/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');

    // marital status route
    Route::get('maritalstatus/manage', [MaritalStatusController::class, 'index'])->name('maritalstatus.index');
    Route::get('maritalstatus/create', [MaritalStatusController::class, 'create'])->name('maritalstatus.create');
    Route::post('maritalstatus/save', [MaritalStatusController::class, 'store'])->name('maritalstatus.store');
    Route::get('maritalstatus/{id}/edit', [MaritalStatusController::class, 'edit'])->name('maritalstatus.edit');
    Route::post('maritalstatus/update', [MaritalStatusController::class, 'update'])->name('maritalstatus.update');
    Route::post('maritalstatus/inactive', [MaritalStatusController::class, 'inactive'])->name('maritalstatus.inactive');
    Route::post('maritalstatus/active', [MaritalStatusController::class, 'active'])->name('maritalstatus.active');
    Route::post('maritalstatus/destroy', [MaritalStatusController::class, 'destroy'])->name('maritalstatus.destroy');

    // religion route
    Route::get('religion/manage', [ReligionController::class, 'index'])->name('religion.index');
    Route::get('religion/create', [ReligionController::class, 'create'])->name('religion.create');
    Route::post('religion/save', [ReligionController::class, 'store'])->name('religion.store');
    Route::get('religion/{id}/edit', [ReligionController::class, 'edit'])->name('religion.edit');
    Route::post('religion/update', [ReligionController::class, 'update'])->name('religion.update');
    Route::post('religion/inactive', [ReligionController::class, 'inactive'])->name('religion.inactive');
    Route::post('religion/active', [ReligionController::class, 'active'])->name('religion.active');
    Route::post('religion/destroy', [ReligionController::class, 'destroy'])->name('religion.destroy');

    // profession route
    Route::get('profession/manage', [ProfessionController::class, 'index'])->name('profession.index');
    Route::get('profession/create', [ProfessionController::class, 'create'])->name('profession.create');
    Route::post('profession/save', [ProfessionController::class, 'store'])->name('profession.store');
    Route::get('profession/{id}/edit', [ProfessionController::class, 'edit'])->name('profession.edit');
    Route::post('profession/update', [ProfessionController::class, 'update'])->name('profession.update');
    Route::post('profession/inactive', [ProfessionController::class, 'inactive'])->name('profession.inactive');
    Route::post('profession/active', [ProfessionController::class, 'active'])->name('profession.active');
    Route::post('profession/destroy', [ProfessionController::class, 'destroy'])->name('profession.destroy');

    // complexion route
    Route::get('complexion/manage', [ComplexionController::class, 'index'])->name('complexion.index');
    Route::get('complexion/create', [ComplexionController::class, 'create'])->name('complexion.create');
    Route::post('complexion/save', [ComplexionController::class, 'store'])->name('complexion.store');
    Route::get('complexion/{id}/edit', [ComplexionController::class, 'edit'])->name('complexion.edit');
    Route::post('complexion/update', [ComplexionController::class, 'update'])->name('complexion.update');
    Route::post('complexion/inactive', [ComplexionController::class, 'inactive'])->name('complexion.inactive');
    Route::post('complexion/active', [ComplexionController::class, 'active'])->name('complexion.active');
    Route::post('complexion/destroy', [ComplexionController::class, 'destroy'])->name('complexion.destroy');

    // blood group route
    Route::get('bloodgroup/manage', [BloodGroupController::class, 'index'])->name('bloodgroup.index');
    Route::get('bloodgroup/create', [BloodGroupController::class, 'create'])->name('bloodgroup.create');
    Route::post('bloodgroup/save', [BloodGroupController::class, 'store'])->name('bloodgroup.store');
    Route::get('bloodgroup/{id}/edit', [BloodGroupController::class, 'edit'])->name('bloodgroup.edit');
    Route::post('bloodgroup/update', [BloodGroupController::class, 'update'])->name('bloodgroup.update');
    Route::post('bloodgroup/inactive', [BloodGroupController::class, 'inactive'])->name('bloodgroup.inactive');
    Route::post('bloodgroup/active', [BloodGroupController::class, 'active'])->name('bloodgroup.active');
    Route::post('bloodgroup/destroy', [BloodGroupController::class, 'destroy'])->name('bloodgroup.destroy');



    // religious value route
    Route::get('religiousvalue/manage', [ReligiousValueController::class, 'index'])->name('religiousvalue.index');
    Route::get('religiousvalue/create', [ReligiousValueController::class, 'create'])->name('religiousvalue.create');
    Route::post('religiousvalue/save', [ReligiousValueController::class, 'store'])->name('religiousvalue.store');
    Route::get('religiousvalue/{id}/edit', [ReligiousValueController::class, 'edit'])->name('religiousvalue.edit');
    Route::post('religiousvalue/update', [ReligiousValueController::class, 'update'])->name('religiousvalue.update');
    Route::post('religiousvalue/inactive', [ReligiousValueController::class, 'inactive'])->name('religiousvalue.inactive');
    Route::post('religiousvalue/active', [ReligiousValueController::class, 'active'])->name('religiousvalue.active');
    Route::post('religiousvalue/destroy', [ReligiousValueController::class, 'destroy'])->name('religiousvalue.destroy');

    // country route
    Route::get('country/manage', [CountryController::class, 'index'])->name('country.index');
    Route::get('country/create', [CountryController::class, 'create'])->name('country.create');
    Route::post('country/save', [CountryController::class, 'store'])->name('country.store');
    Route::get('country/{id}/edit', [CountryController::class, 'edit'])->name('country.edit');
    Route::post('country/update', [CountryController::class, 'update'])->name('country.update');
    Route::post('country/inactive', [CountryController::class, 'inactive'])->name('country.inactive');
    Route::post('country/active', [CountryController::class, 'active'])->name('country.active');
    Route::post('country/destroy', [CountryController::class, 'destroy'])->name('country.destroy');

    // degree route
    Route::get('degree/manage', [DegreeController::class, 'index'])->name('degree.index');
    Route::get('degree/education', [DegreeController::class, 'parent'])->name('degree.parent');
    Route::get('degree/create', [DegreeController::class, 'create'])->name('degree.create');
    Route::post('degree/save', [DegreeController::class, 'store'])->name('degree.store');
    Route::get('degree/{id}/edit', [DegreeController::class, 'edit'])->name('degree.edit');
    Route::post('degree/update', [DegreeController::class, 'update'])->name('degree.update');
    Route::post('degree/inactive', [DegreeController::class, 'inactive'])->name('degree.inactive');
    Route::post('degree/active', [DegreeController::class, 'active'])->name('degree.active');
    Route::post('degree/destroy', [DegreeController::class, 'destroy'])->name('degree.destroy');

    // location route
    Route::get('location', [LocationController::class, 'index'])->name('location.index');
    Route::get('location/create', [LocationController::class, 'create'])->name('location.create');
    Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
    Route::get('location/{id}/edit', [LocationController::class, 'edit'])->name('location.edit');
    Route::post('location/update', [LocationController::class, 'update'])->name('location.update');
    Route::get('location/division', [LocationController::class, 'division'])->name('location.divisions');
    Route::post('location/assign-division', [LocationController::class, 'assign_division'])->name('location.assign_division');
    Route::get('location/district', [LocationController::class, 'district'])->name('location.districts');
    Route::post('location/assign-district', [LocationController::class, 'assign_district'])->name('location.assign_district');
    // Route::get('location/district', [LocationController::class,'district'])->name('location.district');

    // working route
    Route::get('working/manage', [WorkingController::class, 'index'])->name('working.index');
    Route::get('working/create', [WorkingController::class, 'create'])->name('working.create');
    Route::post('working/save', [WorkingController::class, 'store'])->name('working.store');
    Route::get('working/{id}/edit', [WorkingController::class, 'edit'])->name('working.edit');
    Route::post('working/update', [WorkingController::class, 'update'])->name('working.update');
    Route::post('working/inactive', [WorkingController::class, 'inactive'])->name('working.inactive');
    Route::post('working/active', [WorkingController::class, 'active'])->name('working.active');
    Route::post('working/destroy', [WorkingController::class, 'destroy'])->name('working.destroy');

    // Route::get('working/slugify', [WorkingController::class, 'slugify'])->name('working.slugify');

    // height route
    Route::get('profileby/manage', [ProfileByController::class, 'index'])->name('profileby.index');
    Route::get('profileby/create', [ProfileByController::class, 'create'])->name('profileby.create');
    Route::post('profileby/save', [ProfileByController::class, 'store'])->name('profileby.store');
    Route::get('profileby/{id}/edit', [ProfileByController::class, 'edit'])->name('profileby.edit');
    Route::post('profileby/update', [ProfileByController::class, 'update'])->name('profileby.update');
    Route::post('profileby/inactive', [ProfileByController::class, 'inactive'])->name('profileby.inactive');
    Route::post('profileby/active', [ProfileByController::class, 'active'])->name('profileby.active');
    Route::post('profileby/destroy', [ProfileByController::class, 'destroy'])->name('profileby.destroy');

    // Route::get('profileby/slugify', [ProfileByController::class, 'slugify'])->name('working.slugify');

    // success route
    Route::get('success/manage', [SuccessController::class, 'index'])->name('success.index');
    Route::get('success/create', [SuccessController::class, 'create'])->name('success.create');
    Route::post('success/save', [SuccessController::class, 'store'])->name('success.store');
    Route::get('success/{id}/edit', [SuccessController::class, 'edit'])->name('success.edit');
    Route::post('success/update', [SuccessController::class, 'update'])->name('success.update');
    Route::post('success/inactive', [SuccessController::class, 'inactive'])->name('success.inactive');
    Route::post('success/active', [SuccessController::class, 'active'])->name('success.active');
    Route::post('success/destroy', [SuccessController::class, 'destroy'])->name('success.destroy');

    // success route
    Route::get('resultgrade/manage', [ResultGradeController::class, 'index'])->name('resultgrade.index');
    Route::get('resultgrade/create', [ResultGradeController::class, 'create'])->name('resultgrade.create');
    Route::post('resultgrade/save', [ResultGradeController::class, 'store'])->name('resultgrade.store');
    Route::get('resultgrade/{id}/edit', [ResultGradeController::class, 'edit'])->name('resultgrade.edit');
    Route::post('resultgrade/update', [ResultGradeController::class, 'update'])->name('resultgrade.update');
    Route::post('resultgrade/inactive', [ResultGradeController::class, 'inactive'])->name('resultgrade.inactive');
    Route::post('resultgrade/active', [ResultGradeController::class, 'active'])->name('resultgrade.active');
    Route::post('resultgrade/destroy', [ResultGradeController::class, 'destroy'])->name('resultgrade.destroy');

    // page route
    Route::get('page/manage', [CreatePageController::class, 'index'])->name('pages.index');
    Route::get('page/create', [CreatePageController::class, 'create'])->name('pages.create');
    Route::post('page/save', [CreatePageController::class, 'store'])->name('pages.store');
    Route::get('page/{id}/edit', [CreatePageController::class, 'edit'])->name('pages.edit');
    Route::post('page/update', [CreatePageController::class, 'update'])->name('pages.update');
    Route::post('page/inactive', [CreatePageController::class, 'inactive'])->name('pages.inactive');
    Route::post('page/active', [CreatePageController::class, 'active'])->name('pages.active');
    Route::post('page/destroy', [CreatePageController::class, 'destroy'])->name('pages.destroy');
});
