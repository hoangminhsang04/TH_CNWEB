<?php
namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu từ bảng issues, bao gồm thông tin từ bảng computers
        $issues = Issue::with('computer')->paginate(10); // Phân trang 10 bản ghi mỗi trang

        // Trả về view và truyền dữ liệu
        return view('issues.index', compact('issues'));
    }
    public function create()
    {
        $computers = Computer::all(); 

        return view('issues.create', compact('computers'));
    }
    public function store(Request $request)
    {
        Issue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Thêm thành công!');
    }
    public function edit($id)
    {
        $issue = Issue::findOrFail($id);
        $computers = Computer::all();
        return view('issues.edit', compact('issue', 'computers'));
    }
    public function update(Request $request, $id) {
        // Kiểm tra dữ liệu đầu vào (validation)
        // $request->validate([
        //     'title' => 'required',
        //     'student_id' => 'required',
        //     'program' => 'required',
        //     'supervisor' => 'required',
        //     'submission_date' => 'nullable|date',
        //     'defense_date' => 'nullable|date',
        // ]);
    
        // Tìm đối tượng Thesis cần cập nhật
        $issue = Issue::find($id);
        
        // Cập nhật thông tin
        $issue->update($request->all());
    
        // Điều hướng trở lại trang index với thông báo thành công
        return redirect()->route('issues.index')->with('success', 'Cập nhật thành công');
    }
    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Xóa thành công!');
    }
}

