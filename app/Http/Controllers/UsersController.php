namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show()
    {
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    public function edit()
    {
        $user = User::find($id);
        return view('users.edit', [
            'user' => $user,
        ]);
    }
    
    public function update()
    {
        $user = User::find($id);
        $user->name=>$request->name;
        $user->email=>$request->email;
        $user->save();
        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    public function destroy()
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }
}