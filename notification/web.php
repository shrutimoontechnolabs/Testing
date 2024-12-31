<?php 
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InoutController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\YajraController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\EventLogController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('auth.login');
})->name('authlogin');

Route::middleware(['auth', 'verified', 'preventBackHistory','IsUserValid:Admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::get('/update-password', [ProfileController::class, 'show'])->name('update-password.show');
    Route::post('/update-password', [ProfileController::class, 'updatepassword'])->name('update-password.updatepassword');

    Route::get('/users/add', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');

    // Route::get('/dashboard',[UserController::class, 'alluser'])->name('dashboard');

    Route::controller(YajraController::class)->group(function(){
        Route::get('/users',  'index')->name('users.index');
        Route::get('users/{id}/edit', [YajraController::class, 'edit'])->name('users.edit');
        Route::delete('/users/{id}', [YajraController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/update',  'update')->name('users.update');
    });
    
    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles/add', 'create')->name('role.create');
        Route::post('/roles/add', 'store')->name('role.store');
        Route::get('/roles',  'index')->name('roles.index');
        Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
        Route::post('/roles/update',  'update')->name('roles.update');
    });
   
    //Calender
    Route::get('/full_calender',[FullCalenderController::class, 'full_calender'])->name('calender');
    Route::post('/full_calender/action',[FullCalenderController::class, 'action'])->name('action');
    
    Route::controller(FaqController::class)->group(function () {
        Route::get('/faqs/add', 'create')->name('faq.create');
        Route::post('/faqs/add', 'store')->name('faq.store');
        Route::get('/faqs',  'index')->name('faqs.index');
        Route::get('faqs/{id}/edit', [FaqController::class, 'edit'])->name('faqs.edit');
        Route::delete('/faqs/{id}', [FaqController::class, 'destroy'])->name('faqs.destroy');
        Route::post('/faqs/update',  'update')->name('faqs.update');
        Route::get('/faqs/shows', [FaqController::class, 'showFaqs'])->name('faqs.show');

    });

    Route::controller(CmsController::class)->group(function () {
        Route::get('/cms/add', 'create')->name('cms.create');
        Route::post('/cms/add', 'store')->name('cms.store');
        Route::get('/cmss',  'index')->name('cmss.index');
        Route::get('cmss/{id}/edit', [CmsController::class, 'edit'])->name('cmss.edit');
        Route::delete('/cmss/{id}', [FaqController::class, 'destroy'])->name('cmss.destroy');
        Route::post('/cmss/update',  'update')->name('cmss.update');

    });

  
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contacts/add', 'create')->name('contact.create');
        Route::post('/contacts/add', 'store')->name('contact.store');
        Route::get('/contacts', 'index')->name('contacts.index');
        Route::get('/contacts/{id}/edit', 'edit')->name('contacts.edit');
        Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
        Route::post('/contacts/update', 'update')->name('contacts.update');
        Route::post('/import-contacts', [ContactController::class, 'import'])->name('contacts.import');
    });

    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks/add', 'create')->name('task.create');
        Route::post('/tasks/add', 'store')->name('task.store');
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/{id}/edit', 'edit')->name('tasks.edit');
        Route::delete('/tasks/{id}', 'destroy')->name('tasks.destroy');
        Route::post('/tasks/{id}/update', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('tasks/{id}/view', [TaskController::class, 'showadmin'])->name('tasks.showadmin');


    });
    


    Route::post('/select', [SelectController::class, 'findName'])->name('select');
    Route::get('select-Assigne', function () { return view('addtask'); });


    //Holiday
    Route::controller(HolidayController::class)->group(function () {
        Route::get('/holidays', [HolidayController::class, 'getHolidaysForYear'])->name('holidays.index');
        Route::post('/holidays/store', [HolidayController::class, 'store'])->name('holidays.store');
        Route::get('/holidays/add', 'create')->name('holiday.create');
    });

    
});

Route::middleware(['auth', 'verified', 'preventBackHistory'])->group(function () {

    Route::get('/userdashboard', [InoutController::class, 'userDashboard'])->name('user.userdashboard');


    
    Route::controller(LeaveController::class)->group(function(){
        Route::get('/leaves/add', 'create')->name('leave.create');
        Route::post('/leaves/add', 'store')->name('leave.store');
        Route::get('/leaves',  'index')->name('leaves.index');
        Route::get('leaves/{id}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
        Route::delete('/leaves/{id}', [LeaveController::class, 'destroy'])->name('leaves.destroy');
        Route::post('/leaves/update',  'update')->name('leaves.update');
        Route::get('/leaves/manage', [LeaveController::class, 'adminIndex'])->name('leaves.adminIndex');
        Route::post('/leaves/{id}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
        Route::post('/leaves/{id}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
        

    });

    Route::controller(InoutController::class)->group(function () {
        Route::get('/inout/add', 'create')->name('inout.create');
        Route::post('/clock-in', [InoutController::class, 'clockIn'])->name('inout.clockIn');
        Route::post('/clock-out', [InoutController::class, 'clockOut'])->name('inout.clockOut');
    });

    
    
    Route::get('/user/tasks', [TaskController::class, 'userTasks'])->name('user.usertasks');
    Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::post('/user/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('user.updateTaskStatus');
    Route::post('/tasks/{task}/comments', [TaskController::class, 'storeComment'])->name('task.comments.store');
    Route::get('/tasks/{task}/comments', [TaskController::class, 'fetch'])->name('task.comments.fetch');

 });

 Route::get('/generateCsv', [LeaveController::class, 'generateCsv'])->name('download.csv');

 Route::post('/track-event', [EventLogController::class, 'logEvent']);
 

 Route::middleware(['auth'])->group(function () {
    // In web.php (routes file)
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications');

    // Mark notification as read
    Route::post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});