<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function Archive(Request $request, $username)
    {
        // $user = User::where('username', '=', $username)->get();
        $user = User::with('article')->where('username', '=', $username)->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        // $itemCollection = collect($items);
        $itemCollection = collect($user[0]->article->reverse());

        // Define how many items we want to be visible in each page
        $perPage = 10;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        $PaginatedArticles = $paginatedItems;


        return view('public.user.archive', compact(['user', 'PaginatedArticles']));
    }

    public function Manage(Request $request)
    {
        if ($request->has('rule')) {
            if ($request['rule'] == 'admin') {
                $users = User::where('rule', 'admin')->paginate(15);
            }
            if ($request['rule'] == 'member') {
                $users = User::where('rule', 'member')->paginate(15);
            }
        } else {
            $users = User::paginate(15);
        }
        return view('admin.user.manage', compact('users'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('Home'));
    }

    public function Profile()
    {
        $user = User::where('id', '=', Auth::id())->get();
        return view('admin.profile.edit', compact('user'));
    }

    public function Update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:30',
        ]);
        $user = User::find(Auth::id());
        $user->name = $request['name'];
        $user->update();
        return redirect(route("Profile"));
    }

    public function Lock(Request $request, $id)
    {
        $user = User::find($id);
        $user->state = 0;
        $user->update();
        return redirect(route("Users > Manage"));
    }

    public function Unlock(Request $request, $id)
    {
        $user = User::find($id);
        $user->state = 1;
        $user->update();
        return redirect(route("Users > Manage"));
    }

    public function Delete(Request $request, $id)
    {
        if (Auth::user()->rule == 'admin' && Auth::user()->id != $id) {
            User::find($id)->delete();
        } else {
            return abort(403, 'Unallowed action.');
        }
        return view('admin.user.manage', compact('users'));
    }
}
