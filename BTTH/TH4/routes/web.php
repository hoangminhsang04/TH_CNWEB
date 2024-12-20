<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

// Route để hiển thị danh sách tất cả các issues
Route::get('/', [IssueController::class, 'index'])->name('issues.index');

// Route để hiển thị form thêm mới issue
Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');

// Route để xử lý việc lưu issue mới vào cơ sở dữ liệu
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

// Route để hiển thị form sửa một issue cụ thể
Route::get('/issues/{id}/edit', [IssueController::class, 'edit'])->name('issues.edit');

// Route để xử lý việc cập nhật dữ liệu của issue trong cơ sở dữ liệu
Route::put('/issues/{id}', [IssueController::class, 'update'])->name('issues.update');

// Route để xử lý việc xóa một issue cụ thể
Route::delete('/issues/{id}', [IssueController::class, 'destroy'])->name('issues.destroy');
