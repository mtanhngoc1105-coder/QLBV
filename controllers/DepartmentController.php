namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() { return view('departments.index', ['departments' => Department::all()]); }

    public function create() { return view('departments.create'); }

    public function store(Request $request) {
        $data = $request->validate(['name' => 'required|string|max:255','description'=>'nullable|string']);
        Department::create($data);
        return redirect()->route('departments.index')->with('success','Thêm khoa thành công');
    }

    public function edit(Department $department) { return view('departments.edit', compact('department')); }

    public function update(Request $request, Department $department) {
        $data = $request->validate(['name' => 'required|string|max:255','description'=>'nullable|string']);
        $department->update($data);
        return redirect()->route('departments.index')->with('success','Cập nhật thành công');
    }

    public function destroy(Department $department) {
        $department->delete();
        return back()->with('success','Xóa khoa thành công');
    }
}
